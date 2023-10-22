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
include("php/config.php"); 
if(isset($_COOKIE['user'])) 
{ 
    $username = $_COOKIE['user']; 
	$query = "SELECT admin,vip FROM $usertable WHERE $namerow = '$username'";  
	$result=mysqli_query($connect,$query);
    while($row = mysqli_fetch_assoc($result)) 
    { 
		$admin = $row[$adminrow];
		$vip = $row['vip'];
	}
	$carsql = "SELECT id FROM cars WHERE owner = '$username'";
    $carlmao = mysqli_query($connect,$carsql);
	$carcount=mysqli_num_rows($carlmao);
    if($carcount > 0)
	{
		if(isset($_GET['car'])){ 
		$cid = substr($_GET['car'], 0, 3);
		$cid -= 100;
        $query = "SELECT fuel,cost,model,color,clock,paintjob,x,y,number,tehniska FROM cars WHERE owner = '$username' AND id = '$cid'";  
	    $result=mysqli_query($connect,$query);
		$isyourcar=mysqli_num_rows($result);
		if($isyourcar == 1){
        while($row = mysqli_fetch_assoc($result)) 
        { 
            $carf = $row['fuel'];
		    $cost = $row['cost'];
		    $vehImage = 'vehskin/';
		    $vehImage .= $row['model'];
		    $vehImage .= '.png';
		    $col1 = $row['color'];
		    $model = $row['model'];
			$lock = $row['clock'];
		    $paintj = $row['paintjob'];
			$x = $row['x'];
			$y = $row['y'];
			$cnumber = $row['number'];
			$ctehniska = $row['tehniska'];
		    switch ($model)
			{
		        case 400: $model = "Landstalker";
		        break; case 401: $model = "Bravura";
		        break; case 402: $model = "Buffalo";
		        break; case 403: $model = "Linerunner";
		        break; case 404: $model = "Perenniel";
		        break; case 405: $model = "Sentinel";
		        break; case 406: $model = "Dumper";
		        break; case 407: $model = "Firetruck";
		        break; case 408: $model = "Trashmaster";
		        break; case 409: $model = "Stretch";
		        break; case 410: $model = "Manana";
		        break; case 411: $model = "Infernus";
		        break; case 412: $model = "Voodoo";
		        break; case 413: $model = "Pony";
		        break; case 414: $model = "Mule";
		        break; case 415: $model = "Cheetah";
		        break; case 416: $model = "Ambulance";
		        break; case 417: $model = "Leviathan";
		        break; case 418: $model = "Moonbeam";
		        break; case 419: $model = "Esperanto";
		        break; case 420: $model = "Taxi";
		        break; case 421: $model = "Washington";
		        break; case 422: $model = "Bobcat";
		        break; case 423: $model = "Mr Whoopee";
		        break; case 424: $model = "BF Injection";
		        break; case 425: $model = "Hunter";
		        break; case 426: $model = "Premier";
		        break; case 427: $model = "Enforcer";
		        break; case 428: $model = "Securicar";
		        break; case 429: $model = "Banshee";
		        break; case 430: $model = "Predator";
		        break; case 431: $model = "Bus";
		        break; case 432: $model = "Rhino";
		        break; case 433: $model = "Barracks";
		        break; case 434: $model = "Hotknife";
		        break; case 435: $model = "Article Trailer";
		        break; case 436: $model = "Previon";
		        break; case 437: $model = "Coach";
		        break; case 438: $model = "Cabbie";
		        break; case 439: $model = "Stallion";
		        break; case 440: $model = "Rumpo";
		        break; case 441: $model = "RC Bandit";
		        break; case 442: $model = "Romero";
		        break; case 443: $model = "Packer";
		        break; case 444: $model = "Monster";
		        break; case 445: $model = "Admiral";
		        break; case 446: $model = "Squallo";
		        break; case 447: $model = "Seasparrow";
		        break; case 448: $model = "Pizzaboy";
		        break; case 449: $model = "Tram";
		        break; case 450: $model = "Article Trailer 2";
		        break; case 451: $model = "Turismo";
		        break; case 452: $model = "Speeder";
		        break; case 453: $model = "Reefer";
		        break; case 454: $model = "Tropic";
		        break; case 455: $model = "Flatbed";
		        break; case 456: $model = "Yankee";
		        break; case 457: $model = "Caddy";
		        break; case 458: $model = "Solair";
		        break; case 459: $model = "Berkley's RC Van";
		        break; case 460: $model = "Skimmer";
		        break; case 461: $model = "PCJ-600";
		        break; case 462: $model = "Faggio";
		        break; case 463: $model = "Freeway";
		        break; case 464: $model = "RC Baron";
		        break; case 465: $model = "RC Raider";
		        break; case 466: $model = "Glendale";
		        break; case 467: $model = "Oceanic";
		        break; case 468: $model = "Sanchez";
		        break; case 469: $model = "Sparrow";
		        break; case 470: $model = "Patriot";
		        break; case 471: $model = "Quad";
		        break; case 472: $model = "Coastguard";
		        break; case 473: $model = "Dinghy";
		        break; case 474: $model = "Hermes";
		        break; case 475: $model = "Sabre";
		        break; case 476: $model = "Rustler";
		        break; case 477: $model = "ZR-350";
		        break; case 478: $model = "Walton";
		        break; case 479: $model = "Regina";
		        break; case 480: $model = "Comet";
		        break; case 481: $model = "BMX";
		        break; case 482: $model = "Burrito";
		        break; case 483: $model = "Camper";
		        break; case 484: $model = "Marquis";
		        break; case 485: $model = "Baggage";
		        break; case 486: $model = "Dozer";
		        break; case 487: $model = "Maverick";
		        break; case 488: $model = "SAN News Maverick";
		        break; case 489: $model = "Rancher";
		        break; case 490: $model = "FBI Rancher";
		        break; case 491: $model = "Virgo";
		        break; case 492: $model = "Greenwood";
		        break; case 493: $model = "Jetmax";
		        break; case 494: $model = "Hotring Racer";
		        break; case 495: $model = "Sandking";
		        break; case 496: $model = "Blista Compact";
		        break; case 497: $model = "Police Maverick";
		        break; case 498: $model = "Boxville";
		        break; case 499: $model = "Benson";
		        break; case 500: $model = "Mesa";
		        break; case 501: $model = "RC Goblin";
		        break; case 502: $model = "Hotring Racer";
		        break; case 503: $model = "Hotring Racer";
		        break; case 504: $model = "Bloodring Banger";
		        break; case 505: $model = "Rancher";
		        break; case 506: $model = "Super GT";
		        break; case 507: $model = "Elegant";
		        break; case 508: $model = "Journey";
		        break; case 509: $model = "Bike";
		        break; case 510: $model = "Mountain Bike";
		        break; case 511: $model = "Beagle";
		        break; case 512: $model = "Cropduster";
		        break; case 513: $model = "Stuntplane";
		        break; case 514: $model = "Tanker";
		        break; case 515: $model = "Roadtrain";
		        break; case 516: $model = "Nebula";
		        break; case 517: $model = "Majestic";
		        break; case 518: $model = "Buccaneer";
		        break; case 519: $model = "Shamal";
		        break; case 520: $model = "Hydra";
		        break; case 521: $model = "FCR-900";
		        break; case 522: $model = "NRG-500";
		        break; case 523: $model = "HPV1000";
		        break; case 524: $model = "Cement Truck";
		        break; case 525: $model = "Towtruck";
		        break; case 526: $model = "Fortune";
		        break; case 527: $model = "Cadrona";
		        break; case 528: $model = "FBI Truck";
		        break; case 529: $model = "Willard";
		        break; case 530: $model = "Forklift";
		        break; case 531: $model = "Tractor";
		        break; case 532: $model = "Combine Harvester";
		        break; case 533: $model = "Feltzer";
		        break; case 534: $model = "Remington";
		        break; case 535: $model = "Slamvan";
		        break; case 536: $model = "Blade";
		        break; case 537: $model = "Freight";
		        break; case 538: $model = "Brownstreak";
		        break; case 539: $model = "Vortex";
		        break; case 540: $model = "Vincent";
		        break; case 541: $model = "Bullet";
		        break; case 542: $model = "Clover";
		        break; case 543: $model = "Sadler";
		        break; case 544: $model = "Firetruck LA";
		        break; case 545: $model = "Hustler";
		        break; case 546: $model = "Intruder";
		        break; case 547: $model = "Primo";
		        break; case 548: $model = "Cargobob";
		        break; case 549: $model = "Tampa";
		        break; case 550: $model = "Sunrise";
		        break; case 551: $model = "Merit";
		        break; case 552: $model = "Utility Van";
		        break; case 553: $model = "Nevada";
		        break; case 554: $model = "Yosemite";
		        break; case 555: $model = "Windsor";
		        break; case 556: $model = "Monster A";
		        break; case 557: $model = "Monster B";
		        break; case 558: $model = "Uranus";
		        break; case 559: $model = "Jester";
		        break; case 560: $model = "Sultan";
		        break; case 561: $model = "Stratum";
		        break; case 562: $model = "Elegy";
		        break; case 563: $model = "Raindance";
		        break; case 564: $model = "RC Tiger";
		        break; case 565: $model = "Flash";
		        break; case 566: $model = "Tahoma";
		        break; case 567: $model = "Savanna";
		        break; case 568: $model = "Bandito";
		        break; case 569: $model = "Freight Flat Trailer";
		        break; case 570: $model = "Streak Trailer";
		        break; case 571: $model = "Kart";
		        break; case 572: $model = "Mower";
		        break; case 573: $model = "Dune";
		        break; case 574: $model = "Sweeper";
		        break; case 575: $model = "Broadway";
		        break; case 576: $model = "Tornado";
		        break; case 577: $model = "AT400";
		        break; case 578: $model = "DFT-30";
		        break; case 579: $model = "Huntley";
		        break; case 580: $model = "Stafford";
		        break; case 581: $model = "BF-400";
		        break; case 582: $model = "Newsvan";
		        break; case 583: $model = "Tug";
		        break; case 584: $model = "Petrol Trailer";
		        break; case 585: $model = "Emperor";
		        break; case 586: $model = "Wayfarer";
		        break; case 587: $model = "Euros";
		        break; case 588: $model = "Hotdog";
		        break; case 589: $model = "Club";
		        break; case 590: $model = "Freight Box Trailer";
		        break; case 591: $model = "Article Trailer 3";
		        break; case 592: $model = "Andromada";
		        break; case 593: $model = "Dodo";
		        break; case 594: $model = "RC Cam";
		        break; case 595: $model = "Launch";
		        break; case 596: $model = "Police Car (LSPD)";
		        break; case 597: $model = "Police Car (SFPD)";
		        break; case 598: $model = "Police Car (LVPD)";
		        break; case 599: $model = "Police Ranger";
		        break; case 600: $model = "Picador";
		        break; case 601: $model = "S.W.A.T.";
		        break; case 602: $model = "Alpha";
		        break; case 603: $model = "Phoenix";
		        break; case 604: $model = "Glendale Shit";
		        break; case 605: $model = "Sadler Shit";
		        break; case 606: $model = "Baggage Trailer A";
		        break; case 607: $model = "Baggage Trailer B";
		        break; case 608: $model = "Tug Stairs Trailer";
		        break; case 609: $model = "Boxville";
		        break; case 610: $model = "Farm Trailer";
		        break; case 611: $model = "Utility Trailer";
		    }
        }
	    if($lock[0] > 0)
        {
            $vehstatus="<span class='label label-danger'>Aizslēgts</span>";
        }
        else if($lock[0] < 1)
        {
            $vehstatus="<span class='label label-success'>Atvērts</span>";
        }
	    if($paintj[0] == 0)
        {
            $vpj="<span class='label label-danger'>Nav</span>";
        }
        else if($paintj[0] > 0)
        {
            $vpj="<span class='label label-success'>Ir</span>";
        }
		}
		else{
			$break = 1;
		}
		}
		$supq="SELECT id FROM rcquest WHERE done=0";
        $suppres=mysqli_query($connect,$supq);
        $suprcount = mysqli_num_rows($suppres);
	}
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
if($carcount == 0)
{
	echo '<p><div class="alert alert-page alert-danger alert-dark" style="width:1000px; margin-left:auto; margin-right:auto;margin-top:5px;">
						<strong>INFO!</strong> Diemžēl Jums nepieder neviena automašīna!
					</div></p>';
}
if(!isset($_GET['car'])) 
{
$privateq = "SELECT id,model,heal,world FROM cars WHERE owner = '$username' ORDER BY id ASC";
$privateres = mysqli_query($connect,$privateq);
$orgcount = mysqli_num_rows($privateres);
if($orgcount > 0){
?>	
<div class="panel" style="width:1000px; margin-left:auto; margin-right:auto;">
<div class="panel-body">
<?php
$sa = 1;
while ($cinfo = mysqli_fetch_array($privateres))
{
do
{
	$hp = $cinfo['heal'];
	$carimg = 'vehskin/';
    $carimg .= $cinfo['model'];
    $carimg .= '.png';
	if($hp > 950){
		$stavoklis = "Ideāls";
	}
	else if($hp < 950 && $hp > 700){
		$stavoklis = "Labs";
	}
	else if($hp < 700 && $hp > 500){
		$stavoklis = "Normāls";
	}
	else{
		$stavoklis = "Slikts";
	}
	$world = $cinfo['world'];
	if($world == 0)
    {
        $garage="<span class='label label-danger'>Nav</span>";
    }
    else if($world > 0)
    {
        $garage="<span class='label label-success'>Ir</span>";
    }
	$qmath = $cinfo['id'] + 100;
	echo "<div class='dala' style='width:315px; display: inline-block;'>
            <div class='panel panel-info' style='width:300px;'>
			<div class='panel-heading'>
				<span class='panel-title'>#".$sa."</span>
					<div class='panel-heading-controls'>
						<div class='panel-heading-icon'><i class='fa fa-info'></i></div>
					</div>
				</div>
			<div class='panel-body'>
		    <center><div class='profileskin'><img src = ".$carimg." /></div></center><br>
			<ul class='list-group'>
			<li class='list-group-item no-border-hr'>
                Stāvoklis:
                <span class='badge'>".$stavoklis."</span>
            </li>
			<li class='list-group-item no-border-hr'>
                Novietota garažā:
                <span style='float:right;'>".$garage."</span>
            </li>
		    </ul>
				<p><center><a href='auto.php?car=".$qmath."".md5($cinfo['id'])."'><button class='btn'>Apskatīties</button></a></center></p>
			</div>
		    </div></div>";
	$sa++;
}
while ($cinfo = mysqli_fetch_array($privateres));
}
}
?>		
</div>
</div>
<?php
}
if(isset($_GET['car'])) 
{
if($break != 1){
	if($ctehniska == 1)
	{
		$teh = "Ir";
		$steh = "success";
	}
	else{
		$teh = "Nav";
		$steh = "danger";
	}
?>
<div class="panel" style="width:1000px; margin-left:auto; margin-right:auto;">
<div class="panel-body" style="margin-left:auto; margin-right:auto;">
    <div class="col-sm-8 text-left"> 
	<center><div class='profileskin' style="float:left;"><img src = '<?php echo "$vehImage" ?>' /></div></center>
	<div class='info' style="width:350px;float:right;">
<ul class='list-group'>
<li class='list-group-item'>
Modelis:
<span class='label label-info' style="float:right;"> <?php echo $model; ?></span>
</li>
<li class='list-group-item'>
Benzīns bākā:
<span class='label label-info' style="float:right;"><?php echo $carf ?> Litri</span>
</li>
<li class='list-group-item'>
Vērtība pārdodot valstij:
<span class='label label-info' style="float:right;"><?php echo $cost/2 ?> Eiro</span>
</li>
<li class='list-group-item'>
Transports:
<span style="float:right;"> <?php echo $vehstatus ?></span>
</li>
<li class='list-group-item'>
PaintJob:
<span style="float:right;"> <?php echo $vpj ?></span>
</li>
<li class='list-group-item'>
Krāsu ID:
<span class='label label-info' style="float:right;"><?php echo $col1 ?></span>
</li>
</ul>
    </div>
  </div>
  <div class='rightside' style="width:300px;float:right;">
  <div class="col-sm-4 col-md-12" style="width:300px;">
						<div class="stat-panel">
							<div class="stat-cell bg-info valign-middle">
								<i class="fa fa-road bg-icon"></i>
								<span class="text-xlg"><span class="text-lg text-slim"></span><strong><?php echo $cnumber ?></strong></span><br>
								<span class="text-bg">Numurzīme</span><br>
							</div>
						</div> 
					</div><br>
					<div class="col-sm-4 col-md-12" style="width:300px;">
						<div class="stat-panel">
							<div class="stat-cell bg-<?php echo $steh ?> valign-middle">
								<i class="fa fa-save bg-icon"></i>
								<span class="text-xlg"><span class="text-lg text-slim"></span><strong><?php echo $teh ?></strong></span><br>
								<span class="text-bg">Reģistrēta</span><br>
							</div>
						</div> 
					</div>
  </div>
</div>
<br>
<center><h4>Auto atrašanās vieta kartē</h4></center>
<br>
<center>
<div style="maregin-top:20px;background: url(map.php?x=<?php echo $x?>&y=<?php echo $y?>);background-position: center;background-repeat: no-repeat;background-size: 100% 100%;height:715px;width:800px;">
</center>
</div>
</div>
<?php
}
else{
	?>
	<div class="alert alert-danger alert-dark" style="width:1000px; margin-left:auto; margin-right:auto;">
							<strong>ERROR#404</strong> Neatradām neko!<p>Ja uzskati, ka šī ir kļūda tad ziņo administrācijai!</p>
						</div>
	<?php
}
}
?>
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
		</script>
<center><footer class="container-fluid text-center" style="width:1000px;margin-center:-15px;margin-top:-20px;">
  <p style="margin-left:800px;">© since 2020 · rpcp.lv</p>
</footer></center>
</body>
<?php
unset($connect);
mysqli_close($connect);
?>
</html>