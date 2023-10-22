<?php
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
    $query = "SELECT admin,online,coin FROM $usertable WHERE $namerow = '$username'";  
	$result=mysqli_query($connect,$query);
    while($row = mysqli_fetch_assoc($result)) 
    { 
		$admin = $row[$adminrow];
		$points = $row['coin'];
		$online = $row['online'];
	}
	$supq="SELECT id FROM rcquest WHERE done=0";
    $suppres=mysqli_query($connect,$supq);
    $suprcount = mysqli_num_rows($suppres);
	$mylink = mysqli_connect($smsdb['host'], $smsdb['user'], $smsdb['pass'], $smsdb['db']); 
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
 <div class="lol" style="width:1000px; margin-right:auto; margin-left:auto;">
 <div class="panel" style="width:1000px; margin-left:auto; margin-right:auto;">
<div class="panel-body" style="margin-left:auto; margin-right:auto;">
<div class="note note-info">
							<h4 class="note-title">Ievēro!</h4>
							Nobalsot varat reizi 24 stundās. Par katru balsi jūs iegūstat 1 RCoin.
						</div>

<div class="col-sm-4 col-md-12" style="width:250px; float:right;">
						<div class="stat-panel">
							<div class="stat-cell bg-success valign-middle">
								<i class="fa fa-money bg-icon"></i>
								<span class="text-xlg"><span class="text-lg text-slim">$</span><strong><?php echo $points ?></strong></span><br>
								<span class="text-bg">RCoins</span><br>
							</div>
						</div> 
					</div>
<center><div class="panel panel-info panel-dark" style="width:250px;">
					<div class="panel-heading">
						<script src=//wos.lv/v.php?40079></script>
						<div class="panel-heading-controls">
							<div class="panel-heading-icon"><i class="fa fa-inbox"></i></div>
						</div>
					</div>
					<div class="panel-body">
<?php
if($online == 0){
    $date = date("Y-m-d G:i");
    $time_needed = "1440";
	$from_time = strtotime($date);
	$check = "SELECT * FROM users WHERE account = '".$username."'";
    $result2 = mysqli_query($mylink, $check);
    $row2 = mysqli_fetch_row($result2); 
    $count2 = mysqli_num_rows($result2);
    if($count2 == 1)
    {
	    $voted_ip = $row2[2]; 
        $voted_date = $row2[3]; 
        $voted_id = $row2[0]; 
        $voted_account = $row2[1]; 
        $to_time = strtotime($voted_date);     	
        if (round(abs($to_time - $from_time) / 60,2) > $time_needed) 
		{
			print "<a href='https://rpcp.itp.lv/hz.php' target='_blank'><button type='button'class='btn btn-success navbar-btn'><i class='icon-off'></i></button></a>"; 
		}
		else{
			$timeToCount = $to_time + "86000";
			echo "<div class='alert alert-danger'>
				Jūs jau esat nobalsojis. <br> Nākamreiz varēsiet nobalsot ".date('d.m.y h:i:s',$timeToCount)."
				</div>";
		}
	}
	else{
			print "<a href='https://rpcp.itp.lv/hz.php' target='_blank'><button type='button'class='btn btn-success navbar-btn'><i class='icon-off'></i> Nobalsot par serveri</button></a>"; 
	}
	
}
else{
	echo "<div class='alert alert-warning'>
		Jūs esat online, lūgums iziet no servera un pēc tam pārlādējiet lapu lai varētu balsot!
	</div>";
}
?> 
					</div>
				</div>				
                </div> </center>
				<center><div class="panel" style="margin-right:auto; margin-left:auto;">
						<ul class="nav nav-tabs nav-justified">

							<li class="active">
								<a href="#uidemo-tabs-default-demo-home" data-toggle="tab">Pēdējie balsotāji</a>
							</li>
							<li class="">
								<a href="#uidemo-tabs-default-demo-profile" data-toggle="tab">TOP 10</a>
							</li>
						</ul>

						<div class="tab-content tab-content-bordered">
							<div class="tab-pane fade active in" id="uidemo-tabs-default-demo-home">
								<p>
								<table class='table table-bordered' align='center' width='750' cellspacing='0' cellpadding='0'>
    <tr>
    <td width='500' align='center'><strong>Spēlētājs</strong></td>
	<td width='500' align='center'><strong>Kad nobalsoja</strong></td>
  </tr>
								<?php 
								$orgq = "SELECT * FROM users ORDER by date DESC LIMIT 10";
	$orgres = mysqli_query($mylink,$orgq);
	while ($bans = mysqli_fetch_array($orgres))
	{
	do
	{
		echo "<tr align='center'><td>".$bans['account']."</td><td>".$bans['date']."</td>";
	}
    while ($bans = mysqli_fetch_array($orgres));
    } 
	?></p></table>
							</div> <!-- / .tab-pane -->
							<div class="tab-pane fade" id="uidemo-tabs-default-demo-profile">
								<p>
								<table class='table table-bordered' align='center' width='750' cellspacing='0' cellpadding='0'>
    <tr>
    <td width='500' align='center'><strong>Spēlētājs</strong></td>
	<td width='500' align='center'><strong>Cik kopumā nobalsojis</strong></td>
  </tr>
								<?php 
								$topq = "SELECT * FROM points ORDER by reward_points DESC LIMIT 10";
	$topres = mysqli_query($mylink,$topq);
	while ($top = mysqli_fetch_array($topres))
	{
	do
	{
		echo "<tr align='center'><td>".$top['account']."</td><td>".$top['reward_points']."</td>";
	}
    while ($top = mysqli_fetch_array($topres));
    } 
	?></p></table>				
							</div> <!-- / .tab-pane -->
						</div> <!-- / .tab-content -->
				</div></center>


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
	
	$(window).load(function(){
       $('#banner').show();
	   });
</script>

<center><footer class="container-fluid text-center" style="width:1000px;margin-center:-15px;margin-top:-20px;">
  <p style="margin-left:800px;">© since 2020 · rpcp.lv</p>
</footer></center>
</body>
</html>
<?php
mysqli_close($mylink);
mysqli_close($connect);
?>