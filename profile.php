<?php
error_reporting(0);
session_start();
if(!isset($_COOKIE["user"])) {
	$_SESSION['timer'] = "1";
    header ("Location: index.php");
	exit();
}
?>
<!DOCTYPE html>
<?php
require "samp_query.php";

$serverIP = "195.3.145.36";
$serverPort = 7777;

try
{
    $rQuery = new QueryServer( $serverIP, $serverPort );

    $aInformation = $rQuery->GetInfo( );
	
    $rQuery->Close( );
}
catch (QueryServerException $pError)
{
}

if(isset($aInformation)){
	$percent = $aInformation['Players'];
}
?>
<html lang="en">
<?php 
include("php/config.php"); 
if(isset($_COOKIE['user'])) 
{ 
    $username = $_COOKIE['user']; 
    $query = "SELECT * FROM $usertable WHERE $namerow = '$username'";  
	$result=mysqli_query($connect,$query);
    while($row = mysqli_fetch_assoc($result)) 
    { 
        $name = $row[$namerow]; 
        $money = $row[$cashrow]; 
        $stundas = $row[$hourrow]; 
		$datareg = utf8_encode($row[$dataregrow]); 
		$admin = $row[$adminrow];
		$skinImage = 'skins/';
		$skinImage .= $row[$skinrow];
		$skinImage .= '.png';
		$bank = $row[$bankrow];
		$skin = $row[$skinrow];
		$number = $row[$numberrow];
		$mail = $row[$emailrow];
		$level = $row[$levelrow];
		$phone = explode(',', $row[$phonerow]);
		$secure = $row[$securerow];
		$code = $row[$coderow];
		$member = $row[$organisator];
		$memq = "SELECT name FROM fraction WHERE id='$member'";
	    $membq = mysqli_query($connect, $memq);
        $members = mysqli_fetch_array($membq);
		$jobs = $row[$jobrow];
		switch ($jobs) 
		{
    		case 1: $jobname = "Picas piegādātājs";
		    break; case 2: $jobname = "Taksists";
		    break; case 3: $jobname = "Produktu piegādātājs";
		    break; case 4: $jobname = "Degvielas ekspeditators";
		    break; case 5: $jobname = "Mehāniķis";
		    break; case 6: $jobname = "Saldējuma pārdevējs";
		    break; case 7: $jobname = "Tālbraucējs";
		    break; case 8: $jobname = "Vilciena vadītājs";
		    break; case 9: $jobname = "Pilots";
		    break; case 10: $jobname = "Kurjers";
		    break; case 0: $jobname = "Bezdarbnieks";
		}
		if($secure == 0)
        {
            $accstatus="<strong><span class='label label-danger'>Izslēgta</span></strong>";
        }
        else if($secure == 1)
        {
            $accstatus="<strong><span class='label label-success'>Ieslēgta</span></strong>";
        }
		$secq = "SELECT * FROM accounts WHERE security = 1";  
	    $secres=mysqli_query($connect,$secq);
		$secpep = mysqli_num_rows($secres);
		$bq = "SELECT * FROM bans WHERE name = '$username'";
		$br = mysqli_query($connect,$bq);
		$bancount = mysqli_num_rows($br);
		if($bancount > 0)
		{
			$banq = "SELECT * FROM bans WHERE name = '$username' ORDER by id";
		    $banres = mysqli_query($connect, $banq);
			while($bans = mysqli_fetch_assoc($banres)) 
    	    { 
        		$bananme = $bans['name'];
            	$banwho = $bans['whobanned'];
				$banip = $bans['ip'];
				$bandate = $bans['bandate'];
				$bantime = $bans['time'];
				$bansreason = $bans['reason'];
				$l = $bans['unbandate'];
    		}
			$t = time();
			if($t < $l)
			{
				$aktivs = "1";
			}
	    }
		
    }
	if($code > 0)
	{
	    if(isset($_GET['send']))
        {
		    $kods = "SELECT * FROM accounts WHERE name='$username'";
    	    $codres = mysqli_query($connect,$kods);
    	    if (!$kods) {
    	    echo 'MySQL Error: ' . mysqli_error();
        	    exit;
    	    }
    	    while($lol = mysqli_fetch_assoc($codres)) 
    	    { 
        	    $mailer = $lol['mail'];
        	    $codding = $lol['code'];
    	    }
    	    if ($codding > 0)
    	    {
	    	    if($username == $_COOKIE['user'])
	    	    { 
		    	    $to      = $mailer;
		    	    $subject = 'Profila atbloķēšanas kods';
		    	    $message = 'Kods: '.$codding.'';
		    	    $headers = 'From: <rpcp@itap.lv>' . "\r\n" .
		    	    'Reply-To: rpcp@rpcp.itp.lv' . "\r\n" .
		    	    'Content-Type: text/html; charset=ISO-8859-1' . "\r\n" .
		    	    'X-Mailer: PHP/' . phpversion();
		    	    mail($to, $subject, $message, $headers);
				    $modal = "1";
					ini_set('display_errors', 0);
                    require('php/conf_global.php');	// Norādi pareizu ceļu uz šo failu un visam jadarbojas
                    $db = new mysqli($INFO['sql_host'], $INFO['sql_user'], $INFO['sql_pass'], $INFO['sql_database']);
                    $db->query(
                    "INSERT INTO `".$INFO['sql_tbl_prefix']."ucp_logs`(`s_date`,`text`)
	                VALUES (".time().",'[PROFILECODE] Nosūtijām ".$username." Tavu kodu uz e-pastu!')");
                    mysqli_close($db);
	    	    }
				else
		        {
			        $modal = "2";
		        }
    	    }
        }
    }
	$query = "SELECT * FROM people WHERE $namerow = '$username'";  
	$result=mysqli_query($connect,$query);
    while($row = mysqli_fetch_assoc($result)) 
    { 
        $x = $row['x'];
        $y = $row['y'];		
	}
	$bq = "SELECT * FROM people WHERE name = '$username'";
	$br = mysqli_query($connect,$bq);
	$peoplecount = mysqli_num_rows($br);
	$supq="SELECT id FROM rcquest WHERE done=0";
    $suppres=mysqli_query($connect,$supq);
    $suprcount = mysqli_num_rows($suppres);
	mysqli_close($connect);
} 
else header('location: index.php'); 
?>
<head>
  <title>RPCP.LV UCP</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">
	<link href="assets/stylesheets/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/stylesheets/pixel-admin.min.css" rel="stylesheet" type="text/css">
	<link href="assets/stylesheets/widgets.min.css" rel="stylesheet" type="text/css">
	<link href="assets/stylesheets/rtl.min.css" rel="stylesheet" type="text/css">
	<link href="assets/stylesheets/themes.min.css" rel="stylesheet" type="text/css">
    <script src="../circles.min.js"></script>
	<script src="../assets/javascripts/bootstrap.min.js"></script>
	<script src="../assets/javascripts/pixel-admin.min.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->
<script src="assets/javascripts/bootstrap.min.js"></script>
<script src="assets/javascripts/pixel-admin.min.js"></script>
  <style>
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
	  background: #fff;
    }
    .row.content {height: 450px}
    .sidenav {
      padding-top: 20px;
      background-color: #fff;
      height: 100%;
    }
    footer {
      background-color: #368CCF;
      color: white;
      padding: 15px;
    }
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
	div.test:hover {
		background: #f2f2f2;
		background: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#f0f0f0));
		background: -moz-linear-gradient(top,  #f2f2f2,  #f0f0f0);
	}
	 .navbar-default .navbar-nav > .active{
		color: #fff;
	   background: #4284ff;
	 }
	 .navbar-default .navbar-nav > .active > a, 
	 .navbar-default .navbar-nav > .active > a:hover, 
	 .navbar-default .navbar-nav > .active > a:focus{
		  color: #fff;
		  background: #4284ff;
	 }
	 .navbar-default .navbar-nav > .dropdown-toggle:active, .open .dropdown-toggle {
		 background:#4284ff !important; color:#fff !important;
	}
  </style>
</head>
<body class="theme-default disable-mm-animation " style="background: url(assets/images/bg.png) repeat;">
<script>var init = [];</script>
<center><a href=''><img src="assets/images/head.png" style="width:1000px;height:227px;"/></a></center>
<center><nav class="navbar navbar-default"  style="width:1000px;margin-left:0px;margin-top:2px;">
			<div class="container-fluid">
				 <div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				  <a class='navbar-brand' href=''>RPCP <small>UCP</small></a>
				</div>
                        <div class='collapse navbar-collapse' id="bs-example-navbar-collapse-1">
                            <ul class='nav navbar-nav'>
                                <li class="active">
                                    <a href="profile.php">Personāžs</a>
                                </li>
                                <li class='dropdown'>
                                    <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                                        Īpašumi
                                        <b class='caret'></b>
                                    </a>
                                    <ul class='dropdown-menu'>
										<li class="dropdown-submenu"><a href="auto.php">Auto</a>
										</li>
                                        <li>
                                            <a href='house.php'>Māja</a>
                                        </li>
										<li>
                                            <a href='garage.php'>Garāža</a>
                                        </li>
                                    </ul>
                                </li>
								<li class='dropdown'>
                                    <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                                        Organizācijas
                                        <b class='caret'></b>
                                    </a>
                                    <ul class='dropdown-menu'>
										<li class="dropdown-submenu"><a href="leaders.php">Saraksts</a>
										</li>
                                        <li>
                                            <a href='org.php'>Panelis</a>
                                        </li>
										<li>
                                            <a href='task.php'>Pieteikties</a>
                                        </li>
										<li>
                                            <a href='pieteikumi.php'>Pieteikumi</a>
                                        </li>
                                    </ul>
                                </li>
								<li class='dropdown'>
                                    <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                                        Statistika
                                        <b class='caret'></b>
                                    </a>
                                    <ul class='dropdown-menu'>
										<li class="dropdown-submenu"><a href="pbtop.php">PaintBall</a>
										</li>
										<li>
                                            <a href='winpb.php'>PaintBall nedēļas uzvarētāji</a>
                                        </li>
                                        <li>
                                            <a href='lvltop.php'>Līmeņu</a>
                                        </li>
                                    </ul>
                                </li>
								<li class='dropdown'>
                                    <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                                        Sodīto saraksti
                                        <b class='caret'></b>
                                    </a>
                                    <ul class='dropdown-menu'>
										<li class="dropdown-submenu"><a href="banlist.php">Banlist</a>
										</li>
                                        <li>
                                            <a href='web_log.php'>WebAdmin Logs</a>
                                        </li>
                                    </ul>
                                </li>
								<li class='dropdown'>
                                    <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                                        RCoins
                                        <b class='caret'></b>
                                    </a>
                                    <ul class='dropdown-menu'>
										<li class="dropdown-submenu"><a href="rcoins.php">Balsošana</a>
										</li>
                                        <li>
                                            <a href='r-shop.php'>Veikals</a>
                                        </li>
										<li>
                                            <a href='rsend.php'>Pārsūtīšana</a>
                                        </li>
										<li>
                                            <a href='rclog.php'>Pieprasījumu saraksts</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class='nav navbar-nav navbar-right'>
                                <li class='divider-vertical'></li>
								<?php
                                if($admin > 0)								
								{
								echo "<li class='dropdown'>
                                    <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                                        Admin Panelis
                                        <b class='caret'></b>
                                    </a>
                                    <ul class='dropdown-menu'>
										<li class='dropdown-submenu'><a href='https://rpcp.itp.lv/ucp' target='_blank'>WebAdmin</a>
										</li>
										<li class='dropdown-submenu'><a href='ip.php'>IP Tool</a>
										</li>
										<li class='dropdown-submenu'><a href='support.php'>Support <span class='label label-primary' style='padding:2px;'>".$suprcount."</span></a>
                                    </ul>
                                </li>";
								}
								?>
								   <li style="margin-left:10px;margin-right:-5px;">
									<button type="button" onClick="parent.location='logout.php'" class="btn btn-danger navbar-btn"><i class='icon-off'></i> Iziet</button>
								</li>
							</ul>
                        </div>
			</div>
	</nav>	
</center>
  <p><center><div class="alert alert-page alert-success alert-dark" style="width:1000px; margin-top:-5px;">
						<strong>Atceries!</strong> Pie mums iespējams arī atjaunot paroli caur e-pastu un uzlikt profila aizsardzību, ja esi norādījis nepareizu e-pastu iespējams ir to nomainīt pie administratoriem.
					</div></center></p>
  
<?php
if($secure == 0)
{
	echo '<p><div class="alert alert-page alert-info alert-dark" style="width:1000px; margin-left:auto; margin-right:auto;margin-top:5px;">
						<strong>INFO!</strong> Redzams, ka jūs neesat nodrošinājis savu profilu ar aizsardzību ko piedāvājam, sīkāka info atrodama forumā. Lai ieslēgtu profila aizsardzību dodaties serverī un rakstat /main>Uzstādijumi>Profila drošība. Šobrīd aizsardzību lieto '.$secpep.' cilvēki.
					</div></p>';
}
?>

<?php
if($code > 0)
{
	echo '<p><div class="alert alert-page alert-danger alert-dark" style="width:1000px; margin-left:auto; margin-right:auto;margin-top:5px;">
						<strong>Uzmanību!</strong> Kāds ir mēģinājis ieiet jūsu profilā ar citu IP adresi, tapēc uzspied pogu "Nosūtīt kodu uz e-pastu" un dodies uz e-pastu norādīto profilā pēc kā dodies IG ievadi kodu ko atsūtīs e-pastā, ja serveris prasīs ievadīt kodu.
					</div></p>
					<p><center><a href="profile.php?send"><button type="button" name="send" class="btn btn-danger navbar-btn"><i class="icon-off"></i> Nosūtīt kodu uz e-pastu</button></a></center></form></p>';
}
?>
<div id="uidemo-modals-alerts-success" class="modal modal-alert modal-success fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-check-circle"></i>
							</div>
							<div class="modal-title">Veiksmīgi!</div>
							<div class="modal-body">Vēstule ar kodu tika aizsūtīta uz e-pastu, kas ir norādīts personāžam.</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div>
				<!-- Danger -->
				<div id="uidemo-modals-alerts-danger" class="modal modal-alert modal-danger fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-times-circle"></i>
							</div>
							<div class="modal-title">Kļūda!</div>
							<div class="modal-body">Kaut kas nenotika kā vajadzētu.</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div> <!-- / .modal -->
				<!-- / Danger -->
<?php
if($aktivs > 0)
{
	?>
<!-- Info -->
				<div id="uidemo-modals-alerts-info" class="modal modal-alert modal-info fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-info-circle"></i>
							</div>
							<div class="modal-title">Bans!</div>
							<div class="modal-body">
							<li class='list-group-item no-border-hr'>
                            Niks:
                            <span class='badge'> <?php echo $bananme ?></span>
                            </li>
							<li class='list-group-item no-border-hr'>
                            Admins:
                            <span class='badge'> <?php echo $banwho ?></span>
                            </li>
							<li class='list-group-item no-border-hr'>
                            IP:
                            <span class='badge'> <?php echo $banip ?></span>
                            </li>
							<li class='list-group-item no-border-hr'>
                            Saņemšanas brīdis:
                            <span class='badge'> <?php echo $bandate ?></span>
                            </li>
							<li class='list-group-item no-border-hr'>
                            Ilgums:
                            <span class='badge'> <?php echo $bantime ?> dienas</span>
                            </li>
							<li class='list-group-item no-border-hr'>
                            Iemesls:
                            <span class='badge'> <?php echo $bansreason ?></span>
                            </li>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div> <!-- / .modal -->
				<?php
				}
				?>

<div class="vidus" style="width:1000px; margin-right:auto; margin-left:auto;">
<div class='col-md-3'>
	<div class="stat-panel text-center" style="width:200px; float:left;">
		<div class="stat-row">
			<div class="stat-cell bg-dark-gray padding-sm text-xs text-semibold">
				<i class="fa  fa-tasks"></i>&nbsp;&nbsp;Serveris
			</div>
		</div> 
				<script>
					init.push(function () {
						// Easy Pie Charts
						var easyPieChartDefaults = {
							animate: 2000,
							scaleColor: false,
							lineWidth: 6,
							lineCap: 'square',
							size: 90,
							trackColor: '#e5e5e5'
						}
						$('#easy-pie-chart-2').easyPieChart($.extend({}, easyPieChartDefaults, {
							barColor: PixelAdmin.settings.consts.COLORS[1]
						}));
					});
				</script>
  <div class="pie-chart" data-percent="<?php echo $percent; ?>" id="easy-pie-chart-2" style="margin-top:5px;">
	<div class="pie-chart-label"><?php echo $percent; ?>/100</div>
</div>
<ul class="list-group" style="margin-top:5px;margin-bottom:-5px;">
	<li class="list-group-item no-border-hr">RPCP ROLEPLAY 0.3.7</li>
	<li class="list-group-item no-border-hr">195.3.145.36:7777</li>
	</ul>				
		</div>
		<!-- / Monis -->
		<?php
		if($peoplecount > 0)
		{
			?>
		<div class="panel panel-info" style="float:left; width:200px;">
					<div class="panel-heading">
						<span class="panel-title">Atrašanās vieta</span>
						<div class="panel-heading-controls">
							<div class="panel-heading-icon"><i class="fa fa-inbox"></i></div>
						</div>
					</div>
					<div class="panel-body">
						Šeit varat apskatīt personāža atrašanās vietu kartē.
						<p><center><button class="btn" data-toggle="modal" data-target="#modal-sizes-2">Apskatīties</button></center></p>
					</div>
					</div>
 			</div>
		<?php
		}
	    else
		{
			?>
			<div class="panel panel-info" style="float:left; width:200px;">
					<div class="panel-heading">
						<span class="panel-title">Atrašanās vieta</span>
						<div class="panel-heading-controls">
							<div class="panel-heading-icon"><i class="fa fa-inbox"></i></div>
						</div>
					</div>
					<div class="panel-body">
						Nevaram uzrādīt! Ieej no sākuma serverī.
					</div>
					</div>
 			</div>
			
        <?php
		}
		?>
			<!--Atrasanas vieta-->
<div id="modal-sizes-2" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h4 class="modal-title">Personāža atrašanās vieta</h4>
							</div>
						    <div class="modal-body">
							<center><div style="maregin-top:20px;background: url(map.php?x=<?php echo $x?>&y=<?php echo $y?>);background-position: center;background-repeat: no-repeat;background-size: 100% 100%;height:715px;width:800px;"></center></div>
							</div>
						</div>
					</div> 
				</div>
<?php
if($aktivs > 0)
{
	?>
<div class="panel panel-danger" style="float:right; width:210px;">
					<div class="panel-heading">
						<span class="panel-title">BAN INFO</span>
						<div class="panel-heading-controls">
							<div class="panel-heading-icon"><i class="fa fa-inbox"></i></div>
						</div>
					</div>
					<div class="panel-body">
						Esam pamanījuši, ka jūsu personāžs ir banots. Spied uz pogas lai uzzinātu sīkāk.
						<p><center><button class="btn btn-xs btn-labeled btn-danger" data-toggle="modal" data-target="#uidemo-modals-alerts-info"><span class="btn-label icon fa fa-hand-o-right"></span>Vairāk..</button></center></p>
					</div>
					</div>
<?php
}
?>
<div class="panel" style="width:500px; margin-left:auto; margin-right:auto;">
<div class="panel-body" style="margin-left:auto; margin-right:auto;">
    <div class="col-sm-8 text-left">
	<?php
	if($skin > 299){
		?>
		<p><div class='profileskin'><strong><span class='label label-danger'> Diemžēl Jūsu skins ir modots un nespējam parādīt to!</span></strong></div></p>
		<?php
	}
    else{
		?>
		<div class='profileskin' style="margin-left:80px; margin-right:auto;"><img src = '<?php echo "$skinImage" ?>' /></div>
		<?php
	}
	?>
	<div class='info' style="width:450px; margin-left:-10px; margin-right:auto;">
<ul class='list-group'>
<li class='list-group-item no-border-hr'>
Vārds, uzvārds:
<span class='badge'> <?php echo str_replace("_"," ",$name); ?></span>
</li>
<li class='list-group-item no-border-hr'>
Tavs e-pasts:
<span class='badge'> <?php
 $mail_segments = explode("@", $mail);
 $mail_segments[0] = substr($mail_segments[0],0, 3) . str_repeat("*", strlen($mail_segments[0])-3) . substr($mail_segments[0],-1);
 $final_email = implode("@", $mail_segments);

 echo $final_email ?></span>
</li>
<?php
if($admin > 0)
{
   echo'<li class="list-group-item no-border-hr">
   Administratora līmenis:
   <span class="badge"> '.$admin.' LVL</span>
   </li>';
}
?>
<li class='list-group-item no-border-hr'>
Tavs līmenis:
<span class='badge'> <?php echo $level ?> LVL</span>
</li>
<li class='list-group-item no-border-hr'>
Reģistrācijas datums:
<span class='badge'> <?php echo $datareg ?></span>
</li>
<li class='list-group-item no-border-hr'>
Nospēlētās stundas serverī:
<span class='badge'> <?php echo $stundas ?> h</span>
</li>
<li class='list-group-item no-border-hr'>
Nauda kontā:
<span class='badge'> <?php echo $bank ?> $</span>
</li>
<li class='list-group-item no-border-hr'>
Nauda kabatā:
<span class='badge'> <?php echo $money ?> $</span>
</li>
<li class='list-group-item no-border-hr'>
Telefona numurs:
<span class='badge'> <?php echo $phone[1] ?> </span>
</li>
<?php
if($members > 0)
{
    echo'<li class="list-group-item no-border-hr">
    Organizācija:
    <span class="badge"> '.$members[0].' </span>
    </li>';
}
else
{
	echo'<li class="list-group-item no-border-hr">
    Organizācija:
    <span class="badge"> Neesi nevienā </span>
    </li>';
}
?>
<li class='list-group-item no-border-hr'>
Darbs:
<span class='badge'> <?php echo $jobname ?></span>
</li>
<li class='list-group-item no-border-hr'>
Profila drošība:
<span style="float:right;"> <?php echo $accstatus ?> </span>
</li>
</ul>
    </div>
  </div>
</div>
</div>
</div>
<script type="text/javascript">
	init.push(function () {
	})
	window.PixelAdmin.start(init);
	<?php
	if($modal == 1)
    {
		?>$(window).load(function(){
       $('#uidemo-modals-alerts-success').modal('show');
	   window.history.replaceState("object", "Title", "profile.php");
	   });
           <?php
    }
	if($modal == 2)
    {
		?>$(window).load(function(){
       $('#uidemo-modals-alerts-danger').modal('show');
	   window.history.replaceState("object", "Title", "profile.php");
	   });
           <?php
    }
	?>
</script>

<center><footer class="container-fluid text-center" style="width:1000px;margin-center:-15px;margin-top:-20px;">
  <p style="margin-left:800px;">© since 2015 · rpcp.itp.lv</p>
</footer></center>

</body>
</html>