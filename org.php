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
include("php/config.php"); 
if(isset($_COOKIE['user'])) 
{ 
    $username = $_COOKIE['user'];
	$peoplesql = "SELECT member FROM accounts WHERE name='$username'";
    $poeplelmao = mysqli_query($connect,$peoplesql);
	$prow = mysqli_fetch_assoc($poeplelmao);
	$biedrs = $prow['member'];
    if($biedrs > 0)
	{
        $query = "SELECT * FROM $usertable WHERE $namerow = '$username'";  
	    $result=mysqli_query($connect,$query);
        while($row = mysqli_fetch_assoc($result)) 
        { 
            $ledorg = $row[$org];
		    $member = $row[$organisator];
			$admin = $row[$adminrow];
        }
	    $memq = "SELECT name FROM fraction WHERE id='$member'";
	    $membq = mysqli_query($connect, $memq);
        $members = mysqli_fetch_array($membq);
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

if(isset($_GET['edit']))
{
	$query="SELECT leader FROM accounts WHERE name='$username'";
    $result=mysqli_query($connect,$query);
	while($row = mysqli_fetch_assoc($result)) 
    {
		$omg = $row['leader'];
	}
    $sql_query="SELECT * FROM accounts WHERE id=".$_GET['edit'];
    $result_set=mysqli_query($connect,$sql_query);
    $fetched_row=mysqli_fetch_array($result_set);
    $lid = $fetched_row['leader'];
    $mem = $fetched_row['member'];
	if($omg != $mem)
	{
		?>
  <script type="text/javascript">
  window.location.href='org.php';
  </script>
  <?php
		exit();
	}
    if ( $lid > 0 )
    {
		?>
  <script type="text/javascript">
  window.location.href='org.php';
  </script>
  <?php
		exit();
    }
    $sql_query = "UPDATE accounts SET member='0',rank='0',loach='0' WHERE id=".$_GET['edit'];
	if(mysqli_query($connect,$sql_query))
    {
	    $modal = "1";
    }
}
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
if($member == 0)
{
	?><p><div class="alert alert-page alert-danger alert-dark" style="width:1000px; margin-left:auto; margin-right:auto;margin-top:5px;">
						<strong>INFO!</strong> Diemžēl jūsu personāžs neatrodas nevienā organizācijā.
					</div></p>
	<?php
}
?>
<script>
					init.push(function () {
						$('#bans').dataTable();
						$('#bans_wrapper .table-caption').text('Organizācijas panelis (<?php echo $members[0] ?>)');
						$('#bans_wrapper .dataTables_filter input').attr('placeholder', 'Meklēt...');
					});
					
				</script>
<div id="uidemo-modals-alerts-danger" class="modal modal-alert modal-danger fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-times-circle"></i>
							</div>
							<div class="modal-title">Kļūda!</div>
							<div class="modal-body">Organizācijas līderi var izmest tikai administrators!</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div>
				<div id="uidemo-modals-alerts-success" class="modal modal-alert modal-success fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-check-circle"></i>
							</div>
							<div class="modal-title">Veiksmīgi!</div>
							<div class="modal-body">Jūs izmetāt organizācijas biedru.</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div>
				<?php
				if($ledorg > 0)
				{
					?>
				<div class="panel" style="width:1000px; margin-left:auto; margin-right:auto;">
				<div class="alert alert-page alert-success alert-dark">
						<strong>Ievēro!</strong> Ja biedra online statuss ir "Online" jeb biedrs atrodas serverī tad biedra izmešana no organizācijas var nenostrādāt! Visslabāk ir izmest biedru, ja statuss rādas "Offline".
					</div>
					<div class="panel-body">
						<div class="table-info">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="bans">
								<thead>
									<tr>
									    <th>#</th>
										<th>Biedrs</th>
										<th>Ranks</th>
										<th>Statuss</th>
										<th>Izmest?</th>
									</tr>
								</thead>
								<tbody>
								<?php 
$orgq = "SELECT id,name,online,rank FROM accounts WHERE member='$ledorg' ORDER by rank DESC";
$orgres = mysqli_query($connect,$orgq);
while ($bans = mysqli_fetch_array($orgres))
{
do
{
if($bans['rank'] > 9)
{
	break;
}
$a = $bans['online'];
if ( $a > 0 )
{
	$a = "Online";
}
else
{
	$a = "Offline";
}
$b++;
    echo "<tr class='gradeA'><td>".$b."</td><td>".$bans['name']."</td><td>".$bans['rank']."</td><td>".$a."</td><td><center><a href='org.php?edit=".$bans['id']."'><button class='btn btn-xs btn-labeled btn-danger'><span class='btn-label icon fa fa-times'></span>Izmest no organizācijas</button></a></center></td></tr>";
}
while ($bans = mysqli_fetch_array($orgres));
}
?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
		  <?php }
				else if($member > 0)
				{
                    ?>
					<div class="panel" style="width:1000px; margin-left:auto; margin-right:auto;">
				<div class="alert alert-page alert-info alert-dark">
						<strong>INFO!</strong> Šeit vari aplūkot savas organizācijas kurā tu atrodies biedru sarakstu.
					</div>
					<div class="panel-body">
						<div class="table-info">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="bans">
								<thead>
									<tr>
									    <th>#</th>
										<th>Biedrs</th>
										<th>Ranks</th>
										<th>Statuss</th>
									</tr>
								</thead>
								<tbody>
								<?php 
$orgq = "SELECT id,name,online,rank FROM accounts WHERE member='$biedrs' ORDER by rank DESC";
$orgres = mysqli_query($connect,$orgq);
while ($bans = mysqli_fetch_array($orgres))
{
do
{
if($bans['rank'] > 9)
{
	break;
}
$a = $bans['online'];
if ( $a > 0 )
{
	$a = "Online";
}
else
{
	$a = "Offline";
}
$b++;
    echo "<tr class='gradeA'><td>".$b."</td><td>".$bans['name']."</td><td>".$bans['rank']."</td><td>".$a."</td></tr>";
}
while ($bans = mysqli_fetch_array($orgres));
}
?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<?php
				}
				?>
			</div>
<script type="text/javascript">
	init.push(function () {
	})
	window.PixelAdmin.start(init);
</script>
</div>
</div>
</div>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#bans').dataTable( {
					"aaSorting": [],
					"pageLength": 10
					
				} );
			} );
			window.history.replaceState("object", "Title", "org.php");
			
			<?php
	if($modal == 1)
    {
		?>$(window).load(function(){
       $('#uidemo-modals-alerts-success').modal('show');}); <?php
    }
	?>
		</script>
<center><footer class="container-fluid text-center" style="width:1000px;margin-center:-15px;margin-top:-20px;">
  <p style="margin-left:800px;">© since 2020 · rpcp.lv</p>
</footer></center>
</body>
</html>
<?php
mysqli_close($connect);
?>