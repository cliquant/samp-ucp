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
if($admin >= 6)
{
	?>
	
<?php
if(isset($_GET['ok']))
{
	$okid = $_GET['ok'];
	$query = "SELECT done FROM reg WHERE id='$okid' and done = 1 and admin = 0 ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($connect, $query);
	$rowcount = mysqli_num_rows($result);
	if($rowcount > 0){
		while($row = mysqli_fetch_assoc($result)) 
        {
		    $allok = $row['done'];
	    }
		if($allok == 1){
		    $sql_query="SELECT name,parole,mail,sex,skin,date,ip FROM reg WHERE id='".$okid."' ORDER BY id DESC LIMIT 1";
            $result_set=mysqli_query($connect,$sql_query);
	        while($rowing = mysqli_fetch_assoc($result_set)) 
            {
		        $niks = $rowing['name'];
				$parole = $rowing['parole'];
				$mail = $rowing['mail'];
				$sex = $rowing['sex'];
				$skin = $rowing['skin'];
				$date = $rowing['date'];
				$news = "1";
				$level = "1";
				$cash = "100";
				$exp = "5";
				$ip = $rowing['ip'];
				$news = "1";
				$satiety = "50";
				$rcoins = "0";
				$qq1 = "SELECT name FROM accounts WHERE name='$niks' ORDER BY id DESC LIMIT 1";
                $qqres = mysqli_query($connect, $qq1);
	            $qcount = mysqli_num_rows($qqres);
				if($qcount == 0){
				    $qsql4 = "INSERT INTO accounts (name,password,ip,mail,level,cash,exp,datareg,sex,model,news,satiety,coin) VALUES ('".$niks."','".$parole."','".$ip."','".$mail."','".$level."','".$cash."','".$exp."','".date("d.m.y",$date)."','".$sex."','".$skin."','".$news."','".$satiety."','".$rcoins."') ";		
        		    mysqli_query($connect, $qsql4);
				    $qsql1 = "UPDATE reg SET done = 2, admin=1 WHERE id = '".$okid."' ";
       		        mysqli_query($connect,$qsql1);
				    $done = "1";
					ini_set('display_errors', 0);
            	    require('php/conf_global.php');	// Norādi pareizu ceļu uz šo failu un visam jadarbojas
            	    $db = new mysqli($INFO['sql_host'], $INFO['sql_user'], $INFO['sql_pass'], $INFO['sql_database']);
           		    $db->query(
				    "INSERT INTO `".$INFO['sql_tbl_prefix']."ucp_logs`(`s_date`,`text`)
			        VALUES (".time().",'[REG] Admins ".$username." izskatīja ".$niks." reģistrācijas apelāciju un akceptēja to!')");
            	    mysqli_close($db);
				}
				else{
					$no = "1";
				}
	        }	
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
	$post = $_POST['comment'];
    $sql_query="SELECT done,name FROM reg WHERE id='".$delid."' and done = 1 and admin = 0 ORDER BY id DESC LIMIT 1";
    $result_set=mysqli_query($connect,$sql_query);
    $rowcount = mysqli_num_rows($result_set);
	if($rowcount > 0)
	{
		while($rowing = mysqli_fetch_assoc($result_set)) 
        {
		    $allok = $rowing['done'];
			$niks = $rowing['name'];
	    }
		if($allok == 1)
		{
			$qsql1 = "UPDATE reg SET done = 3, admin=1, comment = '".$post."' WHERE id = '".$delid."' ";
       		mysqli_query($connect,$qsql1);
			$done = "1";
			ini_set('display_errors', 0);
            require('php/conf_global.php');	// Norādi pareizu ceļu uz šo failu un visam jadarbojas
            $db = new mysqli($INFO['sql_host'], $INFO['sql_user'], $INFO['sql_pass'], $INFO['sql_database']);
            $db->query(
			"INSERT INTO `".$INFO['sql_tbl_prefix']."ucp_logs`(`s_date`,`text`)
		    VALUES (".time().",'[REG] Admins ".$username." izskatīja ".$niks." reģistrācijas apelāciju un noraidīja to!')");
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
				<div class="table-info" style="width:1000px; margin-left:auto; margin-right:auto;">
<?php
if(isset($_GET['open']))
{
	$aid = $_GET['open'];
	$query = "SELECT id,name,mail,sex,skin,national,why,rp,date,admin,comment FROM reg WHERE id = '$aid' ORDER BY id DESC LIMIT 1";
	$result=mysqli_query($connect,$query);
    while($row = mysqli_fetch_assoc($result)) 
    {
		$id = $row['id'];
		$name = $row['name'];
		$mail = $row['mail'];
		$sex = $row['sex'];
		$skinImage = 'skins/';
		$skinImage .= $row['skin'];
		$skinImage .= '.png';
		$national = $row['national'];
		$why = $row['why'];
		$rp = $row['rp'];
		$date = $row['date'];
		$admin = $row['admin'];
		$comment = $row['comment'];
	}
	if($sex == 1){
		$sex = "Vīrietis";
	}
	else if($sex == 2){
		$sex = "Sieviete";
	}
	?>
	<div class="row" style="width:1000px; margin-left:auto; margin-right:auto;">
            <div class="panel panel-default">
                <center><div class="panel-heading"> <strong class="" ><?php echo $name; ?> reģistrācijas apelācija</strong>
                </div>
                <div class="panel-body">
                        <div class="row">
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">Vārds_Uzvārds</label>
									<br><?php echo $name; ?>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">Atsūtija</label>
									<br><?php echo date("d.m.y h:i:s",$date); ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">Dzimums</label>
									<br><?php echo $sex; ?>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">Tautība</label>
									<br><?php echo $national; ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-16">
								<div class="form-group no-margin-hr">
									<center><label class="control-label">Izvēlētais skins</label>
									<br><img src = '<?php echo "$skinImage" ?>' /></center>
								</div>
							</div>
						</div>
						<div class="row">
						<div class="form-group no-margin-hr">
									<label class="control-label">Pastāstiet ar kādu mērķi vēlaties reģistrēt šo profilu</label>
						<br><?php echo $why; ?>
						</div>
						</div>
						<div class="row">
						<div class="form-group no-margin-hr">
									<label class="control-label">Izskaidrojiet pāris RP terminus kādus zinat kā, piemēram, DeathMatch(DM), Powergaming(PG), Metagaming(MG).</label>
						<br><?php echo $rp; ?>
						</div>
						</div>
						<br>
						<form class="form-horizontal" method="post" action="admin.php?delete=<?php echo $id; ?>">
							<div class="form-group no-margin-hr">
									<label class="control-label">Komentārs par apelāciju (Būtu labi, ja uzrakstītu gadījumā, kad tiek atteikts)</label>
						         <textarea class="form-control" name="comment" rows="3" placeholder="Ievadiet komentāru par apelāciju"></textarea>
						    </div>
							<br>
					        <span style="float:right;"><button class="btn btn-labeled btn-danger" type="submit"><span class="btn-label icon fa  fa-times-circle"></span>Atteikt</button></span>
							</form>
					        <span style="float:right;"><button class="btn btn-labeled btn-success" onClick="parent.location='admin.php?ok=<?php echo $id; ?>'"><span class="btn-label icon fa  fa-check"></span>Akceptēt</button></span>
						<span style="float:left;"><a href="admin.php"><button class="btn btn-labeled btn-primary"><span class="btn-label icon fa  fa-mail-reply-all"></span>Atpakaļ</button></a></span>
						</div>
						<div class="panel-footer">Ja ir kādas problēmas, ziņo administrācijai vai skype - julijs40</a>
                            </div>
                </div>
				</center>
            </div>
    </div>
	<?php
}
else{
        if($done == 1){
	        echo '<div class="alert alert-success" role="alert">Biļete izskatīta!</div>';
        }
		if($error == 1){
	        echo '<div class="alert alert-danger" role="alert">Biļete netika atrasta!</div>';
        }
		if($dont == 1){
	        echo '<div class="alert alert-danger" role="alert">Biļete jau ir izskatīta!</div>';
        }
		if($no == 1){
	        echo '<div class="alert alert-danger" role="alert">Šāds niks ko pieprasa jau pastāv profilu datubāzē! Iesakam Jums atteikt šo biļeti.</div>';
        }
	?>
				<div class="panel panel-info widget-support-tickets" id="dashboard-support-tickets">
					<div class="panel-heading">
						<span class="panel-title"><i class="panel-title-icon fa fa-group"></i> Reģistrācijas apelācijas biļetes</span>
					</div> <!-- / .panel-heading -->
					<div class="panel-body tab-content-padding">
						<!-- Panel padding, without vertical padding -->
						<div class="panel-padding no-padding-vr">
						
						<?php
$orgq = "SELECT * FROM reg WHERE done=1 and admin=0 ORDER by id DESC";
$orgres = mysqli_query($connect,$orgq);
$orgcount=mysqli_num_rows($orgres);
if($orgcount > 0){
    while ($bans = mysqli_fetch_array($orgres))
    {
        do
        {
            echo "
            <div class='ticket'>
            <span class='ticket-label'><a href='admin.php?open=".$bans['id']."'><button class='btn btn-labeled btn-primary'><span class='btn-label icon fa  fa-mail-forward'></span>Apskatīt apelāciju</button></a></span>
            <a class='ticket-title'>Biļete <b>#".$bans['id']."</b> | Spēlētājs ".$bans['name']." grib reģistrēties, lūdzu izskatiet!</a>
            <span class='ticket-info'>
            ".$bans['why']."</a><br> ".date("d.m.y h:i:sa",$bans['date'])."
            </span>
            </div>
            ";
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
	if($done == 1){
			?>$(window).load(function(){
	          window.history.replaceState("object", "Title", "admin.php");
	          });
           <?php
        }
		if($error == 1){
			?>$(window).load(function(){
	          window.history.replaceState("object", "Title", "admin.php");
	          });
           <?php
        }
		if($dont == 1){
			?>$(window).load(function(){
	          window.history.replaceState("object", "Title", "admin.php");
	          });
           <?php
        }
		if($no == 1){
			?>$(window).load(function(){
	          window.history.replaceState("object", "Title", "admin.php");
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
<?php
mysqli_close($connect);
?>