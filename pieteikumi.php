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
    $query = "SELECT admin,leader FROM $usertable WHERE $namerow = '$username'";  
	$result=mysqli_query($connect,$query);
    while($row = mysqli_fetch_assoc($result)) 
    { 
		$admin = $row[$adminrow];
		$leader = $row['leader'];
	}
	$supq="SELECT id FROM rcquest WHERE done=0";
    $suppres=mysqli_query($connect,$supq);
    $suprcount = mysqli_num_rows($suppres);
	$search="SELECT who FROM ucporg WHERE who='$username'";
	$wtf = mysqli_query($connect, $search);
	$rowcount = mysqli_num_rows($wtf);
} 
else
{	
    header('location: index.php');
	mysqli_close($connect);
	exit();
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
if(isset($_GET['ok']))
{
	$okid = $_GET['ok'];
	$query = "SELECT id,org,who,done FROM ucporg WHERE id='$okid'";
    $result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_assoc($result)) 
    {
		$id = $row['id'];
		$org = $row['org'];
		$whos = $row['who'];
		$dom = $row['done'];
	}
	if($org == $leader || $dom == 0)
	{
		$query = "SELECT online,member FROM accounts WHERE name='$whos'";
        $result = mysqli_query($connect, $query);
	    while($row = mysqli_fetch_assoc($result)) 
        {
		    $on = $row['online'];
			$mem = $row['member'];
		}
	    if($on == 0){
			if($mem == 0){
				if($org == 1){
					$skin = "98";
				}
			    else if($org == 2){
					$skin = "300";
				}
				else if($org == 5){
					$skin = "71";
				}
				else if($org == 6){
					$skin = "59";
				}
				else if($org == 13){
					$skin = "287";
				}
				else if($org == 14){
					$skin = "23";
				}
				else if($org == 15){
					$skin = "71";
				}
				else if($org == 19){
					$skin = "188";
				}
				else if($org == 22){
					$skin = "6";
				}
				else if($org == 25){
					$skin = "2";
				}
			    $canq = "UPDATE accounts SET member='$org', rank=1, loach='$skin' WHERE name='$whos'";
		        mysqli_query($connect,$canq);
		        $okq = "UPDATE ucporg SET done=1 WHERE id='$okid'";
		        mysqli_query($connect,$okq);
		        $done1 = "1";
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
				ini_set('display_errors', 0);
                require('php/conf_global.php');	// Norādi pareizu ceļu uz šo failu un visam jadarbojas
                $db = new mysqli($INFO['sql_host'], $INFO['sql_user'], $INFO['sql_pass'], $INFO['sql_database']);
                $db->query(
                "INSERT INTO `".$INFO['sql_tbl_prefix']."ucp_logs`(`s_date`,`text`)
	            VALUES (".time().",'[ORG] Līderis ".$username." izskatīja ".$whos." pieteikumu uz ".$what." pa biedru un pieņēma to!')");
                mysqli_close($db);
			}
			else{
				$err = "1";
			}
		}
		else{
			$error = "1";
		}
	}
}

if(isset($_GET['delete']))
{
	$delid = $_GET['delete'];
	$query = "SELECT org,who,done FROM ucporg WHERE id='$delid'";
    $result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_assoc($result)) 
    {
		$whos = $row['who'];
		$org = $row['org'];
		$dom = $row['done'];
	}
	if($org == $leader || $dom == 0)
	{
		$canq = "UPDATE ucporg SET done=2 WHERE id='$delid'";
		mysqli_query($connect,$canq);
		$done2 = "1";
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
		ini_set('display_errors', 0);
        require('php/conf_global.php');	// Norādi pareizu ceļu uz šo failu un visam jadarbojas
        $db = new mysqli($INFO['sql_host'], $INFO['sql_user'], $INFO['sql_pass'], $INFO['sql_database']);
        $db->query(
        "INSERT INTO `".$INFO['sql_tbl_prefix']."ucp_logs`(`s_date`,`text`)
	    VALUES (".time().",'[ORG] Līderis ".$username." izskatīja ".$whos." pieteikumu uz ".$what." pa biedru un noraidīja to!')");
        mysqli_close($db);
	}
}

if(isset($_GET['cancel']))
{
	$cancelid = $_GET['cancel'];
	$query = "SELECT id,who FROM ucporg WHERE id='$cancelid'";
    $result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_assoc($result)) 
    {
		$id = $row['id'];
		$who = $row['who'];
	}
	if($who == $username)
	{
		$canq = "UPDATE ucporg SET done=3 WHERE id='$cancelid'";
		mysqli_query($connect,$canq);
		$done = "1";
	}
}

if($leader > 0){
	$ledq="SELECT org FROM ucporg WHERE org='$leader' AND done=0";
	$leddone = mysqli_query($connect, $ledq);
	$ledcount = mysqli_num_rows($leddone);
}
else{
	$ledcount =  "N/A";
}

if($done2 == 1)
{
?>
<div id="done" class="modal modal-alert modal-success fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-check-circle"></i>
							</div>
							<div class="modal-title">Pieteikums noraidīts!</div>
							<div class="modal-body">
Jūs atteicāt pieņemt spēlētāju.
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div>
				<script>
				$(window).load(function(){
       $('#done').modal('show');
	   window.history.replaceState("object", "Title", "pieteikumi.php");
	   });
	   </script>
				<?php
}

if($done1 == 1)
{
?>
<div id="done" class="modal modal-alert modal-success fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-check-circle"></i>
							</div>
							<div class="modal-title">Pieteikums pieņemts!</div>
							<div class="modal-body">
Spēlētājs tika pieņemts Jūsu organizācijā!	
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div>
				<script>
				$(window).load(function(){
       $('#done').modal('show');
	   window.history.replaceState("object", "Title", "pieteikumi.php");
	   });
	   </script>
				<?php
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
							<div class="modal-title">Pieteikums atcelts!</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div>
				<script>
				$(window).load(function(){
       $('#done').modal('show');
	   window.history.replaceState("object", "Title", "pieteikumi.php");
	   });
	   </script>
				<?php
}
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
				</div>
				<script>
				$(window).load(function(){
       $('#error').modal('show');
	   window.history.replaceState("object", "Title", "pieteikumi.php");
	   });
	   </script>
				<?php
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
Spēlētājs atrodas jau kādā organizācijām, tapēc diemžēl nevaram akceptēt.		
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
	   window.history.replaceState("object", "Title", "pieteikumi.php");
	   });
	   </script>
				<?php
				}
				?>
<div class="panel" style="width:1000px; margin-left:auto; margin-right:auto;">
<div class="panel-body">
	<center>
						<ul class="nav nav-tabs nav-tabs-simple nav-justified" style="margin-top: 20px">
							<li class="active">
								<a href="#mypieteikums" data-toggle="tab">Mani pieteikumi <span class="label label-success"><?php echo $rowcount; ?></span></a>
							</li>
							<li>
								<a href="#orgpieteikums" data-toggle="tab">Organizācijas pieteikumi <span class="badge badge-info"><?php echo $ledcount; ?></span></a>
							</li>
						</ul>
						<div class="tab-content tab-content-bordered">
							<div class="tab-pane fade active in" id="mypieteikums">
							<?php
							if($rowcount > 0)
							{
								?>
					            <table class="table">
						        <thead>
							    <tr>
								    <th>#</th>
								    <th>Datums</th>
								    <th>Organizācija uz kuru pieteicies</th>
								    <th>Statuss</th>
									<th>Opcija</th>
							    </tr>
						        </thead>
						     <tbody class="valign-middle">
							 <?php 
							 $orgq = "SELECT id,time,org,done FROM ucporg WHERE who = '$username' ORDER BY id DESC";
							 $orgres = mysqli_query($connect,$orgq);
							 while ($bans = mysqli_fetch_array($orgres))
							 {
							 do
							 {
								 $org = $bans['org'];
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
								 $info = $bans['done'];
								 if($info == 0){
									 $done = "Gaida apstiprinājumu";
								 }
								 else if($info == 1){
									 $done = "Apstiprināts";
								 }
								 else if($info == 2){
									 $done = "Atteikts";
								 }
								 else if($info == 3){
									 $done = "Atcelts";
								 }
								 if($info == 0)
								 {
	    							 echo "<tr><td>".$bans['id']."</td><td>".date("d.m.y h:i:s",$bans['time'])."</td><td>".$what."</td><td>".$done."</td><td><a href='pieteikumi.php?cancel=".$bans['id']."'><button class='btn btn-xs btn-labeled btn-danger'><span class='btn-label icon fa fa-times'></span>Atcelt</button></a></span></td></tr>";
    							 }
								 if($info > 0){
									 echo "<tr><td>".$bans['id']."</td><td>".date("d.m.y h:i:s",$bans['time'])."</td><td>".$what."</td><td>".$done."</td><td><b><i>Nav pieejama</i></b></td></tr>";
								 }
							 }
							 while ($bans = mysqli_fetch_array($orgres));
							 }
							 ?>
						     </tbody>
					         </table>
							<?php
							}
							else{
							?>
							<div class="none" style="margin-right:auto; margin-left:auto; margin-top:auto; margin-bottom:auto;"><b><i> Tev nav rakstīti pieteikumi. </b></i></div>
							<?php
							}
							?>
				        </div>
							<div class="tab-pane fade" id="orgpieteikums">
                            <?php
                            if($leader == 0){
								?>
								<div class="none" style="margin-right:auto; margin-left:auto; margin-top:auto; margin-bottom:auto;"><b><i> Tu neesi nevienas organizācijas līderis! </b></i></div>
						   <?php
							}
							else if($ledcount == 0){
								?>
								<div class="none" style="margin-right:auto; margin-left:auto; margin-top:auto; margin-bottom:auto;"><b><i> Nav aktīvu pieteikumu! </b></i></div>
						   <?php
							}
							else
							{
								?>
								<table class="table">
						        <thead>
							    <tr>
								    <th>#</th>
								    <th>Kas atsūtija?</th>
								    <th>Kad atsūtija</th>
								    <th>Statuss</th>
									<th>Opcija</th>
							    </tr>
						        </thead>
						        <tbody class="valign-middle">
								<?php
								$sss = "0";
								$orgq = "SELECT * FROM ucporg WHERE org = '$leader' AND done='$sss' ORDER BY id DESC";
							    $orgres = mysqli_query($connect,$orgq);
							    while ($bans = mysqli_fetch_array($orgres))
							    {
							    do
							    {
									?>
									<tr>
									    <td><?php echo $bans['id']; ?></td>
										<td><?php echo $bans['who']; ?></td>
										<td><?php echo date("d.m.y h:i:s",$bans['time']); ?></td>
										<td>Gaida apstiprinājumu</td>
										<td><button class="btn" data-toggle="modal" data-target="#modal-sizes-<?php echo $bans['id']; ?>">Apskatīt pieteikumu</button></td>
										<div id="modal-sizes-<?php echo $bans['id']; ?>" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
													<h4 class="modal-title"><?php echo $bans['who']; ?> pieteikums</h4>
												</div>
												    <div class="modal-body">
													    <center><p><b>Galvenās prasības.</b></p></center>
														<div class="row">
													    <center>
													    <p>1. Personai ir jāpārsniedz 18 gadi.</p>
													    <p>2. Personai štatā ir jābūt nodzīvotiem vismaz 3 gadiem.</p>
													    <p>3. Persona nedrīkst būt meklēšanās pēdējā gada laikā.</p>
													    <p>4.Personai jābūt derīgi personapliecinoši dokumenti.</p>
														</center>
														</div>
														<div class="row">
														<div class="col-sm-2">
															<div class="form-group no-margin-hr">
																<p><label class="control-label">Vārds Uzvārds:</label></p>
																<?php echo $bans['who']; ?>
															</div>
														</div>
														<div class="col-sm-2">
															<div class="form-group no-margin-hr">
																<p><label class="control-label">Vecums:</label></p>
																<?php echo $bans['age']; ?>
															</div>
														</div>
														<div class="col-sm-3">
															<div class="form-group no-margin-hr">
																<p><label class="control-label">E-Pasts:</label></p>
																<?php echo $bans['mail']; ?>
															</div>
														</div>
														<div class="col-sm-2">
															<div class="form-group no-margin-hr">
																<p><label class="control-label">Telefona numurs:</label></p>
																<?php echo $bans['number']; ?>
															</div>
														</div>
														<div class="col-sm-3">
															<div class="form-group no-margin-hr">
																<p><label class="control-label">Dzīves vieta:</label></p>
																<?php echo $bans['lives']; ?>
															</div>
														</div>
													    </div>
														<div class="row">
														<div class="col-sm-4">
														<div class="form-group no-margin-hr">
																<p><label class="control-label">Personas kods:</label></p>
																<?php echo $bans['code']; ?>
															</div>
														</div>
														<div class="col-sm-4">
														<div class="form-group no-margin-hr">
																<p><label class="control-label">Iepriekšējā darbavieta:</label></p>
																<?php echo $bans['lastjob']; ?>
															</div>
														</div>
														<div class="col-sm-4">
														<div class="form-group no-margin-hr">
																<p><label class="control-label">Darba pieredze:</label></p>
																<?php echo $bans['job']; ?>
															</div>
														</div>
														</div>
														<div class="row">
														<div class="col-sm-12">
														<div class="form-group no-margin-hr">
																<p><label class="control-label">Izglītība:</label></p>
																<?php echo $bans['aducation']; ?>
															</div>
														</div>
														</div>
														<div class="row">
														<div class="col-sm-12">
														<div class="form-group no-margin-hr">
																<p><label class="control-label">Motivācijas vēstule:</label></p>
																<?php echo $bans['motivation']; ?>
															</div>
														</div>
														</div>
														<div class="row">
														<div class="col-sm-3">
														<div class="form-group no-margin-hr">
																<p><label class="control-label">Latviešu valoda:</label></p>
																<?php echo $bans['latv']; ?>
															</div>
														</div>
														<div class="col-sm-3">
														<div class="form-group no-margin-hr">
																<p><label class="control-label">Angļu valoda:</label></p>
																<?php echo $bans['eng']; ?>
															</div>
														</div>
														<div class="col-sm-3">
														<div class="form-group no-margin-hr">
																<p><label class="control-label">Krievu valoda:</label></p>
																<?php echo $bans['rus']; ?>
															</div>
														</div>
														<div class="col-sm-3">
														<div class="form-group no-margin-hr">
																<p><label class="control-label">Cita valoda:</label></p>
																<?php echo $bans['another']; ?>
															</div>
														</div>
														</div>
														<div class="row">
														<div class="col-sm-4">
														<div class="form-group no-margin-hr">
																<p><label class="control-label">Pases bilde:</label></p>
																<?php echo $bans['pase']; ?>
															</div>
														</div>
														<div class="col-sm-4">
														<div class="form-group no-margin-hr">
																<p><label class="control-label">Licenšu bilde:</label></p>
																<?php echo $bans['lic']; ?>
															</div>
														</div>
														<div class="col-sm-4">
														<div class="form-group no-margin-hr">
																<p><label class="control-label">Kontaktinformācija:</label></p>
																<?php echo $bans['contact']; ?>
															</div>
														</div>
														</div>
														<div class="row">
														<a href="pieteikumi.php?ok=<?php echo $bans['id']; ?>"><button class="btn btn-xs btn-labeled btn-success"><span class="btn-label icon fa fa-check"></span>Pieņemt</button></a><a href="pieteikumi.php?delete=<?php echo $bans['id']; ?>"><button class="btn btn-xs btn-labeled btn-danger"><span class="btn-label icon fa fa-times"></span>Atteikt</button></a></span>
														</div>
												    </div>
												</div> <!-- / .modal-content -->
											</div> <!-- / .modal-dialog -->
										</div>
									<?php
							    }
							    while ($bans = mysqli_fetch_array($orgres));
								}
							?>
							</tbody>
							</table>
							<?php
							}
							 ?>
							</div> <!-- / .tab-pane -->
						</div>
	</center>
</div>
</div>
<script type="text/javascript">
	init.push(function () {
	})
	window.PixelAdmin.start(init);
</script>

<center><footer class="container-fluid text-center" style="width:1000px;margin-center:-15px;margin-top:-20px;">
  <p style="margin-left:800px;">© since 2020 · rpcp.lv</p>
</footer></center>
</body>
</html>