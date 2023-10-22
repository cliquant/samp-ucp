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
<html lang="en">
<?php 
if(isset($_COOKIE['user'])) 
{ 
    include("php/config.php");
	$username = $_COOKIE['user']; 
    $query = "SELECT admin,level,member FROM $usertable WHERE $namerow = '$username'";  
	$result=mysqli_query($connect,$query);
    while($row = mysqli_fetch_assoc($result)) 
    { 
		$admin = $row[$adminrow];
		$member = $row['member'];
		$level = $row['level'];
	}
	$supq="SELECT id FROM rcquest WHERE done=0";
    $suppres=mysqli_query($connect,$supq);
    $suprcount = mysqli_num_rows($suppres);
} 
else
{	
    header('location: index.php');
	mysqli_close($connect);
	exit();
}
?>
<head>
  <title>Role.LV UCP</title>
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
				  <a class='navbar-brand' href=''>ROLE <small>UCP</small></a>
				</div>
                        <div class='collapse navbar-collapse' id="bs-example-navbar-collapse-1">
                            <ul class='nav navbar-nav'>
                                <li>
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
<?php
if(isset($_GET['send'])) 
{
	if(isset($_POST['firstname']))
	{
		$cq="SELECT who FROM ucporg WHERE who='$username' AND done=0";
        $req=mysqli_query($connect,$cq);
        $countq = mysqli_num_rows($req);
		if($countq == 0)
		{
			if($member == 0){
				if($level > 2){
				    $firstname = $_POST['firstname'];
            	    $lastname = $_POST['lastname'];
            	    $mail = $_POST['email'];
            	    $age = $_POST['age'];
            	    $number = $_POST['number'];
            	    $lives = $_POST['lives'];
            	    $code = $_POST['code'];
            	    $lastjob = $_POST['lastjob'];
				    $job = $_POST['job'];
				    $aducation = $_POST['aducation'];
				    $latv = $_POST['latv'];
				    $eng = $_POST['eng'];
				    $rus = $_POST['rus'];
				    $another = $_POST['another'];
				    $pase = $_POST['pase'];
				    $lic = $_POST['lic'];
				    $contact = $_POST['contact'];
				    $org = $_POST['org'];
				    $motivation = $_POST['motivation'];
			        if($org == 1 || $org == 2 || $org == 5 || $org == 6 || $org == 13 || $org == 14 || $org == 15 || $org == 19 || $org == 22 || $org == 25)
					{
						$gosql = "INSERT INTO ucporg (`name`, `lastname`, `mail`, `age`, `number`, `lives`, `code`, `lastjob`, `job`, `aducation`, `latv`, `eng`, `rus`, `another`, `pase`, `lic`, `contact`, `org`, `time`, `done`, `who`, `motivation`)
		    	    	VALUES ('".$firstname."', '".$lastname."', '".$mail."', '".$age."', '".$number."', '".$lives."', '".$code."', '".$lastjob."', '".$job."', '".$aducation."', '".$latv."', '".$eng."', '".$rus."', '".$another."', '".$pase."', '".$lic."', '".$contact."', '".$org."', '".time()."', '0', '".$username."', '".$motivation."')";
        		   	 	mysqli_query($connect, $gosql);
				    	$done = "1";
				    	if($org == 1){
					    	$what = "Dome";
				    	}
			        	else if($org == 2){
					    	$what = "SAPD";
				    	}
				    	else if($org == 5){
					    	$what = "Veselības Ministrija";
				    	}
				    	else if($org == 6){
					    	$what = "CSDD";
				    	}
				    	else if($org == 13){
					    	$what = "Armija";
				    	}
				    	else if($org == 14){
					    	$what = "Drift Club";
				    	}
						else if($org == 15){
					    	$what = "San Andreas Central Bank";
				    	}
				    	else if($org == 19){
					    	$what = "San Andreas News";
				    	}
				    	else if($org == 22){
					    	$what = "Sanitex";
				    	}
						else if($org == 25){
					    	$what = "SA Transporting Services";
				    	}
				    	else{
					    	$what = "Unknown";
				    	}
						$chatype="bot";
						$memberskaitlis="1";
						ini_set('display_errors', 0);
        	            require('php/conf_global.php');
        	            $db = new mysqli($INFO['sql_host'], $INFO['sql_user'], $INFO['sql_pass'], $INFO['sql_database']);
        	            $db->query(
	    	            "INSERT INTO `".$INFO['sql_tbl_prefix']."ucp_logs`(`s_date`,`text`)
	   		            VALUES (".time().",'[ORGREQ] Spēlētājs ".$username." nosūtija pieteikumu uz ".$what."!')");
			            mysqli_close($db);
					}
					else{
						$message = "Hahahahaha, nice try.";
                        echo "<script type='text/javascript'>alert('$message'); window.history.replaceState('object', 'Title', 'task.php');</script>";
					}
				}
				else{
					$lvlerr = "1";
				}
			}
			else{
				$err = "1";
			}
		}
        else
		{
			$error = "1";
		}			
	}
}

if($lvlerr == 1)
{
?>
<div id="lvlerr" class="modal modal-alert modal-danger fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-times-circle"></i>
							</div>
							<div class="modal-title">Kļūda!</div>
							<div class="modal-body">
Lai pieteiktos nepieciešams 3 lvl.
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div><?php
}
if($done == 1)
{
	?>
<div id="done" class="modal modal-alert modal-success fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-check-circle"></i>
							</div>
							<div class="modal-title">Pieprasījums tika nosūtīts!</div>
							<div class="modal-body">
Gaidi, kad organizācijas līderis izskatīs Tavu pieteikumu.		
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div><?php
				}
				?>

<?php
if($error == 1)
{
?>
<div id="error" class="modal modal-alert modal-danger fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-times-circle"></i>
							</div>
							<div class="modal-title">Kļūda!</div>
							<div class="modal-body">
Jūs jau esat nosūtijis kādam no organizācijas līderiem pieteikumu. Gaidat, kad to izskatīs.	
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div><?php
				}
if($err == 1)
{
?>
<div id="err" class="modal modal-alert modal-danger fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-times-circle"></i>
							</div>
							<div class="modal-title">Kļūda!</div>
							<div class="modal-body">
Jūs nevarat pieteikties citā organizācijā kamēr atrodaties kādā.		
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div>
				<script>
				$(window).load(function(){
       $('#err').modal('show');
	   window.history.replaceState("object", "Title", "task.php");
	   });
	   </script>
				<?php
				}
				?>
<div class="panel" style="width:1000px; margin-left:auto; margin-right:auto;">
<div class="panel-body">
<form action="task.php?send" method="post" class="panel form-horizontal">
					<div class="panel-heading">
						<span class="panel-title">Pieteikums uz biedru.</span>
					</div>
					<center><p><b>Galvenās prasības pirms raksti pieteikumu.</b></p></center>
					<div class="col-sm-10">
					<p>1. Personai ir jāpārsniedz 18 gadi.</p>
					<p>2. Personai štatā ir jābūt nodzīvotiem vismaz 3 gadiem.</p>
					<p>3. Persona nedrīkst būt meklēšanās pēdējā gada laikā.</p>
					<p>4.Personai jābūt derīgi personapliecinoši dokumenti.</p>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">Vārds</label>
									<input type="text" name="firstname" class="form-control" placeholder="Vārds" required="">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">Uzvārds</label>
									<input type="text" name="lastname" class="form-control" placeholder="Uzvārds" required="">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">E-Pasta adrese</label>
									<input type="email" name="email" class="form-control" placeholder="Tava e-pasta adrese IG" required="">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">Vecums</label>
									<input type="number" name="age" class="form-control" placeholder="Personāža vecums" required="">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">Telefona numurs</label>
									<input type="number" name="number" class="form-control" placeholder="Personāža telefona numurs" required="">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">Deklarētā dzīvesvieta</label>
									<input type="text" name="lives" class="form-control" placeholder="Personāža dzīvesvietas adrese" required="">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">Personas kods</label>
									<input type="text" name="code" class="form-control" placeholder="Tava personāža personas kods" required="">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">Iepriekšejā darba vieta</label>
									<input type="text" name="lastjob" class="form-control" placeholder="Kur strādājāt pirms tam?" required="">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">Darba pieredze</label>
									<input type="text" name="job" class="form-control" placeholder="Esat strādājis šajā jomā?" required="">
								</div>
							</div>
						</div>
						<div class="row">
						<div class="form-group no-margin-hr">
									<label class="control-label">Izglītība</label>
						<textarea class="form-control" name="aducation" rows="3" placeholder="Pastāstiet par sava personāža izglītību. Kur mācijies utt." required=""></textarea>
						</div>
						</div>
						<div class="row">
						<div class="form-group no-margin-hr">
									<label class="control-label">Motivācijas vēstule</label>
						<textarea class="form-control" name="motivation" rows="3" placeholder="Šeit raksti, kas Tevi motivē pieteikties." required=""></textarea>
						</div>
						</div>
						<div class="row">
						    <div class="form-group">
								<label for="jq-validation-select" class="col-sm-3 control-label">Latviešu valoda</label>
								<div class="col-sm-9">
									<select class="form-control" id="latv" name="latv">
										<option value="">Izvēlies...</option>
											<option value="Perfekti">Perfekti</option>
											<option value="Daļēji">Daļēji</option>
											<option value="Neapgūts">Neesmu apguvis</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="jq-validation-select" class="col-sm-3 control-label">Angļu valoda</label>
								<div class="col-sm-9">
									<select class="form-control" id="eng" name="eng">
										<option value="">Izvēlies...</option>
											<option value="Perfekti">Perfekti</option>
											<option value="Daļēji">Daļēji</option>
											<option value="Neapgūts">Neesmu apguvis</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="jq-validation-select" class="col-sm-3 control-label">Krievu valoda</label>
								<div class="col-sm-9">
									<select class="form-control" id="rus" name="rus">
										<option value="">Izvēlies...</option>
											<option value="Perfekti">Perfekti</option>
											<option value="Daļēji">Daļēji</option>
											<option value="Neapgūts">Neesmu apguvis</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="jq-validation-select" class="col-sm-3 control-label">Papildus</label>
								<div class="col-sm-9">
									<input type="text" name="another" class="form-control" placeholder="Ievadiet citu valodu kādu zinat" required="">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">Pases bilde ( Būtu labi, ja būtu redzama informācija tikai jeb būtu apgraizīta bilde )</label>
									<input type="text" name="pase" class="form-control" placeholder="Ievadiet bildes linku, kur redzama jūsu pase" required="">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">Licenšu bilde ( Būtu labi, ja būtu redzama informācija tikai jeb būtu apgraizīta bilde )</label>
									<input type="text" name="lic" class="form-control" placeholder="Ievadiet bildes linku, kur redzama jūsu license" required="">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">(( Kontaktinformācija OOC - Skype / Foruma niks ))</label>
									<input type="text" name="contact" class="form-control" placeholder="" required="">
								</div>
							</div>
						</div>
						    <div class="form-group">
								<label for="jq-validation-select" class="col-sm-3 control-label">Izvēlies kuras organizācijas vadītājam vēlies nosūtīt pieteikumu.</label>
								<div class="col-sm-9">
									<select class="form-control" id="org" name="org">
										<option value="">Izvēlies...</option>
											<option value="1">Dome</option>
											<option value="2">SAPD</option>
											<option value="5">Veselības Ministrija</option>
											<option value="6">CSDD</option>
											<option value="13">Armija</option>
											<option value="14">Drift Club</option>
											<option value="15">San Andreas Central Bank</option>
											<option value="19">San Andreas News</option>
											<option value="22">Sanitex</option>
											<option value="25">SA Transporting Services</option>
									</select>
								</div>
							</div>
					</div>
					<div class="panel-footer text-right">
						<button type="submit" class="btn btn-primary">Sūtīt pieprasījumu</button>
					</div>
				</form>
</div>
</div>
<script type="text/javascript">
	init.push(function () {
	})
	window.PixelAdmin.start(init);
	<?php
	if($done == 1)
    {
		?>$(window).load(function(){
       $('#done').modal('show');
	   window.history.replaceState("object", "Title", "task.php");
	   });
           <?php
    }
	?>
	<?php
	if($error == 1)
    {
		?>$(window).load(function(){
       $('#error').modal('show');
	   window.history.replaceState("object", "Title", "task.php");
	   });
           <?php
    }
	?>
	<?php
	if($lvlerr == 1)
    {
		?>$(window).load(function(){
       $('#lvlerr').modal('show');
	   window.history.replaceState("object", "Title", "task.php");
	   });
           <?php
    }
	?>
</script>

<center><footer class="container-fluid text-center" style="width:1000px;margin-center:-15px;margin-top:-20px;">
  <p style="margin-left:800px;">© since 2020 · rpcp.lv</p>
</footer></center>
</body>
</html>