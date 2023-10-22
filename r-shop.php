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
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->

<?php 
if(isset($_COOKIE['user'])) 
{ 
    include("php/config.php"); 
	$username = $_COOKIE['user']; 
    $query = "SELECT admin,coin,online,jailtime FROM $usertable WHERE $namerow = '$username'";  
	$result=mysqli_query($connect,$query);
    while($row = mysqli_fetch_assoc($result)) 
    { 
		$admin = $row[$adminrow];
		$points = $row['coin'];
		$online = $row['online'];
		$jailtime = $row['jailtime'];
	}
	$supq="SELECT id FROM rcquest WHERE done=0";
    $suppres=mysqli_query($connect,$supq);
    $suprcount = mysqli_num_rows($suppres);
	$dbc = mysqli_connect($smsdb['host'], $smsdb['user'], $smsdb['pass'], $smsdb['db']);
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
	<script src="../assets/javascripts/bootstrap.min.js"></script>
	<script src="../assets/javascripts/pixel-admin.min.js"></script>
	<!--[if lt IE 9]>
		<script src="assets/javascripts/ie.min.js"></script>
	<![endif]-->

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
										<li class='dropdown-submenu'><a href='https://rpcp.itp.lv/ccpanel' target='_blank'>WebAdmin</a>
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
if(isset($_GET['money'])) 
{
	if($points >= 10)
	{
		if($online == 0)
		{
		    $points -= 10;
		    $cash = "1000";
		    $moneypoints = "UPDATE accounts SET coin='$points' WHERE $namerow = '$username'";
            mysqli_query($connect, $moneypoints);
            $qmoney = "UPDATE accounts SET cash =cash+'".$cash."' WHERE name = '$username'";
            mysqli_query($connect,$qmoney);
            $success = "1";
            function getUserIP()
    	    {
        	    $client  = @$_SERVER['HTTP_CLIENT_IP'];
        	    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        	    $remote  = $_SERVER['REMOTE_ADDR'];

        	    if(filter_var($client, FILTER_VALIDATE_IP))
        	    {
            	    $ip = $client;
			    }
        	    elseif(filter_var($forward, FILTER_VALIDATE_IP))
        	    {
            	    $ip = $forward;
        	    }
        	    else
        	    {
            	    $ip = $remote;
        	    }
        	    return $ip;
    	    }
		    $user_ip = getUserIP();
    	    $date = date("Y-m-d G:i");
            $qsql4 = "INSERT INTO shoplog (user,ip,date,what) VALUES ('".$username."','".$user_ip."','".$date."', 'Naudu' ) ";		
        	mysqli_query($dbc, $qsql4);
			ini_set('display_errors', 0);
        	require('php/conf_global.php');
        	$db = new mysqli($INFO['sql_host'], $INFO['sql_user'], $INFO['sql_pass'], $INFO['sql_database']);
        	$db->query(
	    	"INSERT INTO `".$INFO['sql_tbl_prefix']."ucp_logs`(`s_date`,`text`)
	   		VALUES (".time().",'[RCShop] Spēlētājs ".$username." iegādājās ".$cash." naudas par 10 RCoins!')");
			mysqli_close($db);
            mysqli_close($dbc);
		}
		else
		{
			$offmod = "1";
		}
	}
	else
	{
		$modal1 = "1";
	}
}
?>

<?php 
if(isset($_GET['exp'])) 
{
	if($points >= 5)
	{
		if($online == 0)
		{
		    $points -= 5;
		    $experience = "5";
		    $exppoints = "UPDATE accounts SET coin='$points' WHERE $namerow = '$username'";
            mysqli_query($connect, $exppoints);
            $qexp = "UPDATE accounts SET exp =exp+'".$experience."' WHERE name = '$username'";
            mysqli_query($connect,$qexp);
            $success = "1";
            function getUserIP()
    	    {
        	    $client  = @$_SERVER['HTTP_CLIENT_IP'];
        	    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        	    $remote  = $_SERVER['REMOTE_ADDR'];

        	    if(filter_var($client, FILTER_VALIDATE_IP))
        	    {
            	    $ip = $client;
			    }
        	    elseif(filter_var($forward, FILTER_VALIDATE_IP))
        	    {
            	    $ip = $forward;
        	    }
        	    else
        	    {
            	    $ip = $remote;
        	    }
        	    return $ip;
    	    }
		    $user_ip = getUserIP();
    	    $date = date("Y-m-d G:i");
            $qsql4 = "INSERT INTO shoplog (user,ip,date,what) VALUES ('".$username."','".$user_ip."','".$date."', 'Exp' ) ";		
        	mysqli_query($dbc, $qsql4);
			ini_set('display_errors', 0);
        	require('php/conf_global.php');
        	$db = new mysqli($INFO['sql_host'], $INFO['sql_user'], $INFO['sql_pass'], $INFO['sql_database']);
        	$db->query(
	    	"INSERT INTO `".$INFO['sql_tbl_prefix']."ucp_logs`(`s_date`,`text`)
	   		VALUES (".time().",'[RCShop] Spēlētājs ".$username." iegādājās ".$experience." EXP par 5 RCoins!')");
			mysqli_close($db);
            mysqli_close($dbc);		
		}
		else
		{
			$offmod = "1";
		}
	}
	else
	{
		$modal1 = "1";
	}
}
?>

<?php 
if(isset($_GET['unjail'])) 
{
	if($points >= 15)
	{
		if($online == 0)
		{
			if($jailtime > 0)
			{
				$points -= 15;
		    	$jailpoints = "UPDATE accounts SET coin='$points', jail=0, jailtime=0 WHERE $namerow = '$username'";
            	mysqli_query($connect, $jailpoints);
				$jx = "1552.704467";
				$jy = "-1675.532470";
				$jz = "16.195312";
				$jailpos = "UPDATE people SET x='$jx', y='$jy', z='$jz', interior=0, world=0 WHERE $namerow = '$username'";
            	mysqli_query($connect, $jailpos);
            	$success = "1";
            	function getUserIP()
    	    	{
        	    	$client  = @$_SERVER['HTTP_CLIENT_IP'];
        	    	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        	    	$remote  = $_SERVER['REMOTE_ADDR'];

        	    	if(filter_var($client, FILTER_VALIDATE_IP))
        	    	{
            	    	$ip = $client;
			    	}
        	    	elseif(filter_var($forward, FILTER_VALIDATE_IP))
        	    	{
            	    	$ip = $forward;
        	    	}
        	    	else
        	    	{
            	    	$ip = $remote;
        	    	}
        	    	return $ip;
    	    	}
		    	$user_ip = getUserIP();
    	    	$date = date("Y-m-d G:i");
            	$qsql4 = "INSERT INTO shoplog (user,ip,date,what) VALUES ('".$username."','".$user_ip."','".$date."', 'Unjail' ) ";		
        		mysqli_query($dbc, $qsql4);
				ini_set('display_errors', 0);
        	    require('php/conf_global.php');
        	    $db = new mysqli($INFO['sql_host'], $INFO['sql_user'], $INFO['sql_pass'], $INFO['sql_database']);
        	    $db->query(
	    	    "INSERT INTO `".$INFO['sql_tbl_prefix']."ucp_logs`(`s_date`,`text`)
	   		    VALUES (".time().",'[RCShop] Spēlētājs ".$username." iegādājās unjail par 15 RCoins!')");
			    mysqli_close($db);
            	mysqli_close($dbc);				
			}
            else
			{
				$modal2 = "1";
			}				
		}
		else
		{
			$offmod = "1";
		}
	}
	else
	{
		$modal1 = "1";
	}
}
?>

<?php 
if(isset($_GET['level'])) 
{
	if($points >= 25)
	{
		if($online == 0)
		{
		    $points -= 25;
		    $uplevel = "1";
		    $levpoint = "UPDATE accounts SET coin='$points' WHERE $namerow = '$username'";
            mysqli_query($connect, $levpoint);
            $qexp = "UPDATE accounts SET level =level+'".$uplevel."' WHERE name = '$username'";
            mysqli_query($connect,$qexp);
            $success = "1";
            function getUserIP()
    	    {
        	    $client  = @$_SERVER['HTTP_CLIENT_IP'];
        	    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        	    $remote  = $_SERVER['REMOTE_ADDR'];

        	    if(filter_var($client, FILTER_VALIDATE_IP))
        	    {
            	    $ip = $client;
			    }
        	    elseif(filter_var($forward, FILTER_VALIDATE_IP))
        	    {
            	    $ip = $forward;
        	    }
        	    else
        	    {
            	    $ip = $remote;
        	    }
        	    return $ip;
    	    }
		    $user_ip = getUserIP();
    	    $date = date("Y-m-d G:i");
            $qsql4 = "INSERT INTO shoplog (user,ip,date,what) VALUES ('".$username."','".$user_ip."','".$date."', 'Limeni' ) ";		
        	mysqli_query($dbc, $qsql4);
			ini_set('display_errors', 0);
        	require('php/conf_global.php');
        	$db = new mysqli($INFO['sql_host'], $INFO['sql_user'], $INFO['sql_pass'], $INFO['sql_database']);
        	$db->query(
	    	"INSERT INTO `".$INFO['sql_tbl_prefix']."ucp_logs`(`s_date`,`text`)
	   		VALUES (".time().",'[RCShop] Spēlētājs ".$username." iegādājās +".$uplevel." level par 25 RCoins!')");
			mysqli_close($db);
            mysqli_close($dbc);			
		}
		else
		{
			$offmod = "1";
		}
	}
	else
	{
		$modal1 = "1";
	}
}
?>

<?php 
if(isset($_GET['unban'])) 
{
	$bq = "SELECT * FROM bans WHERE name = '$username'";
	$br = mysqli_query($connect,$bq);
	$bancount = mysqli_num_rows($br);
	if($bancount > 0)
	{
		$banq = "SELECT unbandate FROM bans WHERE name = '$username' ORDER by id";
		$banres = mysqli_query($connect, $banq);
		while($bans = mysqli_fetch_assoc($banres)) 
    	{ 
			$l = $bans['unbandate'];
    	}
		$t = time();
		if($t < $l)
		{
		    if($points >= 90)
	        {
				$points -= 90;
		    	$jailpoints = "UPDATE accounts SET coin='$points' WHERE $namerow = '$username'";
            	mysqli_query($connect, $jailpoints);
				$bansql = "DELETE FROM bans WHERE name = '$username'";
                mysqli_query($connect, $bansql);
            	$success = "1";	
            	function getUserIP()
    	    	{
        	    	$client  = @$_SERVER['HTTP_CLIENT_IP'];
        	    	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        	    	$remote  = $_SERVER['REMOTE_ADDR'];

        	    	if(filter_var($client, FILTER_VALIDATE_IP))
        	    	{
            	    	$ip = $client;
			    	}
        	    	elseif(filter_var($forward, FILTER_VALIDATE_IP))
        	    	{
            	    	$ip = $forward;
        	    	}
        	    	else
        	    	{
            	    	$ip = $remote;
        	    	}
        	    	return $ip;
    	    	}
		    	$user_ip = getUserIP();
    	    	$date = date("Y-m-d G:i");
            	$qsql4 = "INSERT INTO shoplog (user,ip,date,what) VALUES ('".$username."','".$user_ip."','".$date."', 'Unban' ) ";		
        		mysqli_query($dbc, $qsql4);
				ini_set('display_errors', 0);
        	    require('php/conf_global.php');
        	    $db = new mysqli($INFO['sql_host'], $INFO['sql_user'], $INFO['sql_pass'], $INFO['sql_database']);
        	    $db->query(
	    	    "INSERT INTO `".$INFO['sql_tbl_prefix']."ucp_logs`(`s_date`,`text`)
	   		    VALUES (".time().",'[RCShop] Spēlētājs ".$username." iegādājās UNBAN par 90 RCoins!')");
			    mysqli_close($db);
            	mysqli_close($dbc);				
	        }
	        else
	        {
		        $modal1 = "1";
	        }
		}
		else
		{
			$modal3 = "1";
		}
	}
	else
    {
	    $modal3 = "1";
	}
}
?>
<div id="money" class="modal modal-alert modal-warning fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-warning"></i>
							</div>
							<div class="modal-title">Apstiprināt pirkumu</div>
							<div class="modal-body">
Vai tiešām vēlaties iegādāties 1000 Eiro par 10 RCoins?<br>
Nauda tiks pārskaitīta uz rokām.						
							</div>
							<div class="modal-footer">
							<a href="r-shop.php?money"><button type="button" class="btn btn-success" data-dismiss="modal">Jā</button></a>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Nē</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div>
<div id="exp" class="modal modal-alert modal-warning fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-warning"></i>
							</div>
							<div class="modal-title">Apstiprināt pirkumu</div>
							<div class="modal-body">
Vai tiešām vēlaties iegādāties +5 EXP par 5 RCoins?							
							</div>
							<div class="modal-footer">
							<a href="r-shop.php?exp"><button type="button" class="btn btn-success" data-dismiss="modal">Jā</button></a>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Nē</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div>
<div id="unjail" class="modal modal-alert modal-warning fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-warning"></i>
							</div>
							<div class="modal-title">Apstiprināt pirkumu</div>
							<div class="modal-body">
Vai tiešām vēlaties iegādāties unjail par 15 RCoins?							
							</div>
							<div class="modal-footer">
							<a href="r-shop.php?unjail"><button type="button" class="btn btn-success" data-dismiss="modal">Jā</button></a>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Nē</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div>
<div id="level" class="modal modal-alert modal-warning fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-warning"></i>
							</div>
							<div class="modal-title">Apstiprināt pirkumu</div>
							<div class="modal-body">
Vai tiešām vēlaties iegādāties +1 level par 25 RCoins?							
							</div>
							<div class="modal-footer">
							<a href="r-shop.php?level"><button type="button" class="btn btn-success" data-dismiss="modal">Jā</button></a>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Nē</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div>
<div id="unban" class="modal modal-alert modal-warning fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-warning"></i>
							</div>
							<div class="modal-title">Apstiprināt pirkumu</div>
							<div class="modal-body">
Vai tiešām vēlaties iegādāties unban par 90 RCoins?							
							</div>
							<div class="modal-footer">
							<a href="r-shop.php?unban"><button type="button" class="btn btn-success" data-dismiss="modal">Jā</button></a>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Nē</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div>
<?php
if($modal1 == 1)
{
?>
<div id="nomoney" class="modal modal-alert modal-danger fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-times-circle"></i>
							</div>
							<div class="modal-title">Kļūda!</div>
							<div class="modal-body">
Tev nav pietiekami daudz RCoins kontā!						
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
if($offmod == 1)
{
?>
<div id="offline" class="modal modal-alert modal-danger fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-times-circle"></i>
							</div>
							<div class="modal-title">Kļūda!</div>
							<div class="modal-body">
Lai iegādātos kaut ko ir nepieciešams iziet no servera!						
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
if($success == 1)
{
?>
<div id="success" class="modal modal-alert modal-success fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-check-circle"></i>
							</div>
							<div class="modal-title">Veiksmīgi!</div>
							<div class="modal-body">
Veiksmīgi esi nopircis sev kāroto lietu!						
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
if($modal2 == 1)
{
?>
<div id="dontjail" class="modal modal-alert modal-danger fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-times-circle"></i>
							</div>
							<div class="modal-title">Kļūda!</div>
							<div class="modal-body">
Jūsu personāžs nesēž cietumā!						
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
if($modal3 == 1)
{
?>
<div id="noban" class="modal modal-alert modal-danger fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-times-circle"></i>
							</div>
							<div class="modal-title">Kļūda!</div>
							<div class="modal-body">
Diemžēl tavam personāžam nav aktīvu banu!						
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div><?php
				}
				?>
<div class="vidus" style="width:1000px; margin-right:auto; margin-left:auto;">
<div class="panel" style="width:1000px; margin-left:auto; margin-right:auto;">
<div class="panel-body" style="margin-left:auto; margin-right:auto;">

<div class="col-sm-4 col-md-12" style="width:350px; float:right;">
						<div class="stat-panel">
							<div class="stat-cell bg-success valign-middle">
								<i class="fa fa-money bg-icon"></i>
								<span class="text-xlg"><span class="text-lg text-slim">$</span><strong><?php echo $points ?></strong></span><br>
								<span class="text-bg">Tavā kontā RCoins</span><br>
							</div>
						</div> 
					</div>
					<div class="panel panel-success" style="width:350px; float:left;">
					<div class="panel-heading">
						<span class="panel-title">Informācijai</span>
						<div class="panel-heading-controls">
							<div class="panel-heading-icon"><i class="fa fa-info-circle"></i></div>
						</div>
					</div>
					<div class="panel-body">
						<center><p>Iegūt RCoins var balsojot par mums.</p>
						<p><a href="rcoins.php"><button class="btn btn-xs btn-labeled btn-danger"><span class="btn-label icon fa fa-hand-o-right"></span>Spied lai nobalsotu</button></a></center></p>
					</div>
				</div>
<div class="panel colourable" style="width:960px; float:left;">
					<div class="panel-heading">
						<span class="panel-title">Veikals</span>
					</div>
					<div class="alert alert-page alert-info alert-dark">
						<strong>Ievēro!</strong> Lai iegādātos kaut ko veikalā jums vispirms ir jaiziet no servera!
					</div> <!-- / .alert -->
					<div class="panel-body">
						<center>
						<p><button class="btn btn-outline btn-labeled btn-primary" data-toggle="modal" data-target="#money" style="width:600px;"><span class="btn-label icon fa fa-money"></span>Nauda 1000 Eiro</button></p>
						<p><button class="btn btn-outline btn-labeled btn-primary" data-toggle="modal" data-target="#exp" style="width:600px;"><span class="btn-label icon fa fa-bolt"></span>EXP +5</button></p>
						<p><button class="btn btn-outline btn-labeled btn-primary" data-toggle="modal" data-target="#unjail" style="width:600px;"><span class="btn-label icon fa fa-user"></span>Unjail</button></p>
						<p><button class="btn btn-outline btn-labeled btn-primary" data-toggle="modal" data-target="#level" style="width:600px;"><span class="btn-label icon fa fa-level-up"></span>+1 Level</button></p>
						<p><button class="btn btn-outline btn-labeled btn-primary" data-toggle="modal" data-target="#unban" style="width:600px;"><span class="btn-label icon fa fa-unlock"></span>Unban</button></p>
                        </center>
				
				</div>

</div>

					<table class="table table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Spēlētājs</th>
								<th>Kad nopirka</th>
								<th>Ko nopirka</th>
							</tr>
						</thead>
						<tbody>
							<?php 
$orgq = "SELECT * FROM shoplog ORDER by id DESC LIMIT 5";
$orgres = mysqli_query($connect,$orgq);
while ($bans = mysqli_fetch_array($orgres))
{
do
{
echo "<tr class='gradeA'><td>".$bans['id']."</td><td>".$bans['user']."</td><td>".$bans['date']."</td><td>".$bans['what']."</td></tr>";
}
while ($bans = mysqli_fetch_array($orgres));
}
?>
						</tbody>
					</table>
				</div>
				</div>

</div>
</div>
</div>


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
	if($modal1 == 1)
    {
		?>$(window).load(function(){
       $('#nomoney').modal('show');
	   window.history.replaceState("object", "Title", "r-shop.php");
	   });
           <?php
    }
	?>
	<?php
	if($offmod == 1)
    {
		?>$(window).load(function(){
       $('#offline').modal('show');
	   window.history.replaceState("object", "Title", "r-shop.php");
	   });
           <?php
    }
	?>
	<?php
	if($success == 1)
    {
		?>$(window).load(function(){
       $('#success').modal('show');
	   window.history.replaceState("object", "Title", "r-shop.php");
	   });
           <?php
    }
	?>
	<?php
	if($modal2 == 1)
    {
		?>$(window).load(function(){
       $('#dontjail').modal('show');
	   window.history.replaceState("object", "Title", "r-shop.php");
	   });
           <?php
    }
	?>
	<?php
	if($modal3 == 1)
    {
		?>$(window).load(function(){
       $('#noban').modal('show');
	   window.history.replaceState("object", "Title", "r-shop.php");
	   });
           <?php
    }
	?>
</script>
<center><footer class="container-fluid text-center" style="width:1000px;margin-center:-15px;margin-top:0px;">
  <p style="margin-left:800px;">© since 2020 · rpcp.lv</p>
</footer></center>
</body>
</html>
<?php
mysqli_close($connect);
mysqli_close($dbc);
?>