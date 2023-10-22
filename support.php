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
    $query = "SELECT admin FROM $usertable WHERE $namerow = '$username'";  
	$result=mysqli_query($connect,$query);
    while($row = mysqli_fetch_assoc($result)) 
    { 
		$admin = $row[$adminrow];
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
										<li class='dropdown-submenu'><a href='http://ucp.role.lv/ccpanel' target='_blank'>WebAdmin</a>
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
if($admin >= 6)
{
	?>
	
<?php
if(isset($_GET['ok']))
{
	$okid = $_GET['ok'];
	$query = "SELECT uz,rc FROM rcquest WHERE id='$okid'";
    $result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_assoc($result)) 
    {
		$uz = $row['uz'];
		$rcoins = $row['rc'];
	}
    $sql_query="SELECT online FROM accounts WHERE name='".$uz."'";
    $result_set=mysqli_query($connect,$sql_query);
    $rowcount = mysqli_num_rows($result_set);
	while($rowing = mysqli_fetch_assoc($result_set)) 
    {
		$onle = $rowing['online'];
	}
	if($onle == 0)
	{
		if($rowcount == 1)
		{
			$qsql6 = "UPDATE accounts SET coin =coin+'".$rcoins."' WHERE name = '".$uz."' ";
       		mysqli_query($connect,$qsql6);
			$delq = "UPDATE rcquest SET done=1 WHERE id='$okid'";
			mysqli_query($connect,$delq);
			$done = "1";
			ini_set('display_errors', 0);
        	require('php/conf_global.php');
        	$db = new mysqli($INFO['sql_host'], $INFO['sql_user'], $INFO['sql_pass'], $INFO['sql_database']);
        	$db->query(
	    	"INSERT INTO `".$INFO['sql_tbl_prefix']."ucp_logs`(`s_date`,`text`)
	   		VALUES (".time().",'[RCSupport] Admins ".$username." akceptēja RCoins parsūtīšanu uz ".$uz."!')");
			mysqli_close($db);
		}
		else{
			$dont = "1";
		}
	}
	else{
		$error = "1";
	}
}
?>
<!-- Atstarpe -->
<?php
if(isset($_GET['ban']))
{
	$okid = $_GET['ban'];
	$query = "SELECT no,uz,rc FROM rcquest WHERE id='$okid'";
    $result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_assoc($result)) 
    {
		$no = $row['no'];
		$uz = $row['uz'];
		$rcoins = $row['rc'];
	}
    $sql_query="SELECT id,online FROM accounts WHERE name='".$no."'";
    $result_set=mysqli_query($connect,$sql_query);
    $rowcount = mysqli_num_rows($result_set);
	while($rowing = mysqli_fetch_assoc($result_set)) 
    {
		$onle = $rowing['online'];
		$id = $rowing['id'];
	}
	if($onle == 0)
	{
		if($rowcount == 1)
		{
			$qsql6 = "UPDATE accounts SET coin =coin+'".$rcoins."' WHERE name = '".$no."' ";
       		mysqli_query($connect,$qsql6);
			$delq = "UPDATE rcquest SET done=2 WHERE id='$okid'";
			mysqli_query($connect,$delq);
			$rcbansql = "INSERT INTO rcbans (niks, admin, playerid)
            VALUES ('$no', '$username', '$id')";
			mysqli_query($connect,$rcbansql);
			$banned = "1";
			ini_set('display_errors', 0);
        	require('php/conf_global.php');
        	$db = new mysqli($INFO['sql_host'], $INFO['sql_user'], $INFO['sql_pass'], $INFO['sql_database']);
        	$db->query(
	    	"INSERT INTO `".$INFO['sql_tbl_prefix']."ucp_logs`(`s_date`,`text`)
	   		VALUES (".time().",'[RCSupport] Admins ".$username." iedeva liegumu ".$no." uz RCoins pārsūtīšanu!')");
			mysqli_close($db);
		}
		else{
			$dont = "1";
		}
	}
	else{
		$error = "1";
	}
}
?>
<!-- Info table -->
<?php
if(isset($_GET['delete']))
{
	$delid = $_GET['delete'];
	$query = "SELECT no,rc FROM rcquest WHERE id='$delid'";
    $result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_assoc($result)) 
    {
		$no = $row['no'];
		$rcoins = $row['rc'];
	}
    $sql_query="SELECT online FROM accounts WHERE name='".$no."'";
    $result_set=mysqli_query($connect,$sql_query);
    $rowcount = mysqli_num_rows($result_set);
	while($rowing = mysqli_fetch_assoc($result_set)) 
    {
		$onle = $rowing['online'];
	}
	if($onle == 0)
	{
		if($rowcount == 1)
		{
			$qsql1 = "UPDATE accounts SET coin =coin+'".$rcoins."' WHERE name = '".$no."' ";
       		mysqli_query($connect,$qsql1);
			$delq = "UPDATE rcquest SET done=2 WHERE id='$delid'";
			mysqli_query($connect,$delq);
			$done1 = "1";
			ini_set('display_errors', 0);
        	require('php/conf_global.php');
        	$db = new mysqli($INFO['sql_host'], $INFO['sql_user'], $INFO['sql_pass'], $INFO['sql_database']);
        	$db->query(
	    	"INSERT INTO `".$INFO['sql_tbl_prefix']."ucp_logs`(`s_date`,`text`)
	   		VALUES (".time().",'[RCSupport] Admins ".$username." noraidīja ".$no." pieprasījumu pārskaitīt RCoins!')");
			mysqli_close($db);
		}
		else{
			$dont = "1";
		}
	}
	else{
		$error = "1";
	}
}
?>
<!-- yolo -->
<?php
if($dont == 1)
{
?>
<div id="dont" class="modal modal-alert modal-danger fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-times-circle"></i>
							</div>
							<div class="modal-title">Kļūda!</div>
							<div class="modal-body">
Netika atrasts tāds spēlētājs.		
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
Spēlētājs ir online!		
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
if($banned == 1)
{
?>
<div id="bans" class="modal modal-alert modal-success fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-times-circle"></i>
							</div>
							<div class="modal-title">Veiksmīgi!</div>
							<div class="modal-body">
	Spēlētājam uzlikts liegums pārsūtīt RCoins un pieprasījums tika automātiski noraidīts!
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
if($done == 1)
{
?>
<div id="done" class="modal modal-alert modal-success fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-check-circle"></i>
							</div>
							<div class="modal-title">Biļete izskatīta!</div>
							<div class="modal-body">
RCoins tika veiksmīgi pārskaitīti personai!		
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
if($done1 == 1)
{
?>
<div id="done1" class="modal modal-alert modal-success fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-check-circle"></i>
							</div>
							<div class="modal-title">Biļete izskatīta!</div>
							<div class="modal-body">
RCoins tika veiksmīgi atgriezti pieprasītājam!		
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div><?php
				}
				?>
				<div class="table-info" style="width:1000px; margin-left:auto; margin-right:auto;">
				<div class="panel panel-success widget-support-tickets" id="dashboard-support-tickets">
					<div class="panel-heading">
						<span class="panel-title"><i class="panel-title-icon fa fa-bullhorn"></i>Support Biļetes</span>
						<a href="admin.php"><button class='btn btn-xs btn-labeled btn-info'><span class='btn-label icon fa fa-check'></span>Pāriet uz reģistrāciju apelāciju lapu</button></a>
					</div> <!-- / .panel-heading -->
					<div class="panel-body tab-content-padding">
						<!-- Panel padding, without vertical padding -->
						<div class="panel-padding no-padding-vr">
						
						<?php
						$s1 = "0";
$orgq = "SELECT * FROM rcquest WHERE done='".$s1."' ORDER by id DESC";
$orgres = mysqli_query($connect,$orgq);
$orgcount = mysqli_num_rows($orgres);
if($orgcount > 0){
	$sa = 1;
    while ($bans = mysqli_fetch_array($orgres))
    {
        do
        {
			$ipq = "SELECT name FROM accounts WHERE ip='".$bans['ip']."'";
			$ipres = mysqli_query($connect,$ipq);
			$ipcount = mysqli_num_rows($ipres);
			if($ipcount > 0){
				?>
				<div id="modal-sizes-<?php echo $sa; ?>" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">Personas ar sūtītāja IP</h4>
							</div>
							<div class="modal-body"><?php
							while ($iprow = mysqli_fetch_array($ipres))
    						{
        		            do
        		            {
							echo "".$iprow['name']."<br>";
							}
				            while ($iprow = mysqli_fetch_array($ipres));
				            }
							?>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div>
				<?php
			}
			else{
				?>
				<div id="modal-sizes-<?php echo $sa; ?>" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">Personas ar sūtītāja IP</h4>
							</div>
							<div class="modal-body">Diemžēl netika nekas atrasts!
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div>
				<?php
			}
            echo "
            <div class='ticket'>
            <span class='ticket-label'><a href='support.php?ok=".$bans['id']."'><button class='btn btn-xs btn-labeled btn-success'><span class='btn-label icon fa fa-check'></span>Pieņemt</button></a><br><a href='support.php?delete=".$bans['id']."'><button class='btn btn-xs btn-labeled btn-danger'><span class='btn-label icon fa fa-times'></span>Atteikt</button></a><br><button class='btn' data-toggle='modal' data-target='#modal-sizes-".$sa."'>Salīdzināt IP</button></span>
            <a class='ticket-title'>Spēlētājs ".$bans['no']." grib nosūtīt ".$bans['rc']." RCoins ".$bans['uz']."</a>
            <span class='ticket-info'>
            ".$bans['mess']."</a><br> ".date("d.m.y h:i:sa",$bans['date'])." <br><a href='support.php?ban=".$bans['id']."'><button class='btn btn-xs btn-labeled btn-primary'><span class='btn-label icon fa fa-legal'></span>Uzlikt liegumu</button></a>
            </span>
            </div>
            ";
			$sa++;
        }
        while ($bans = mysqli_fetch_array($orgres));
    }	
}
else{
	echo '<div class="alert alert-page alert-info alert-dark" style="width:960px; margin-top:-5px;">
		<strong>UPS!</strong> <i>Jaunu pierasījumu nav</i>
			</div>';
}
?>
						
					</div>
				</div>
				
				</div>
<?php
}
else{
	?><p><div class="alert alert-page alert-danger alert-dark" style="width:1000px; margin-left:auto; margin-right:auto;margin-top:5px;">
						<strong>INFO!</strong> Nav pietiekams admina līmenis!
					</div></p>
	<?php
}
?>
				</div>
				<!-- / Info table -->
				<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->
<script src="assets/javascripts/bootstrap.min.js"></script>
<script src="assets/javascripts/pixel-admin.min.js"></script>

<script type="text/javascript">
	init.push(function () {
	})
	window.PixelAdmin.start(init);
	<?php
	if($dont == 1)
    {
		?>$(window).load(function(){
       $('#dont').modal('show');
	   window.history.replaceState("object", "Title", "support.php");
	   });
           <?php
    }
	?>
	<?php
	if($banned == 1)
    {
		?>$(window).load(function(){
       $('#bans').modal('show');
	   window.history.replaceState("object", "Title", "support.php");
	   });
           <?php
    }
	?>
	<?php
	if($done == 1)
    {
		?>$(window).load(function(){
       $('#done').modal('show');
	   window.history.replaceState("object", "Title", "support.php");
	   });
           <?php
    }
	?>
	<?php
	if($done1 == 1)
    {
		?>$(window).load(function(){
       $('#done1').modal('show');
	   window.history.replaceState("object", "Title", "support.php");
	   });
           <?php
    }
	?>
	<?php
	if($error == 1)
    {
		?>$(window).load(function(){
       $('#error').modal('show');
	   window.history.replaceState("object", "Title", "support.php");
	   });
           <?php
    }
	?>
</script>

<center><footer class="container-fluid text-center" style="width:1000px;margin-center:-15px;margin-top:-20px;">
  <p style="margin-left:800px;">© since 2015 · role.lv</p>
</footer></center>
</body>
</html>
<?php
mysqli_close($connect);
?>