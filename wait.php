<?php
error_reporting(0);
session_start();
?>
<html>
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
.panel-default {
 width:1000px;
}
</style>
<body class="theme-default disable-mm-animation " style="background: url(assets/images/bg.png) repeat;">
<div class="test" style="margin-top:20px;">
<center><a href="wait.php"><img src="assets/images/header.png"/></a></center>
</div>
<?php
if(isset($_SESSION['waitname'])){
	include("php/config.php");
	$name = $_SESSION['waitname'];
	$query = "SELECT id,mail,sex,skin,national,why,rp,date,done,admin,comment FROM reg WHERE name = '$name' ORDER BY id DESC LIMIT 1";
	$result=mysqli_query($connect,$query);
    while($row = mysqli_fetch_assoc($result)) 
    {
		$id = $row['id'];
		$mail = $row['mail'];
		$sex = $row['sex'];
		$skinImage = 'https://rpcp.itp.lv/skins/';
		$skinImage .= $row['skin'];
		$skinImage .= '.png';
		$national = $row['national'];
		$why = $row['why'];
		$rp = $row['rp'];
		$date = $row['date'];
		$done = $row['done'];
		$admin = $row['admin'];
		$comment = $row['comment'];
	}
	if($sex == 1){
		$sex = "Vīrietis";
	}
	else if($sex == 2){
		$sex = "Sieviete";
	}
	$ch1="SELECT id FROM reg WHERE done = 1";
    $res1=mysqli_query($connect,$ch1);
    $resco=mysqli_num_rows($res1);
	?>
<center>
<div class="container">
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading"> <strong class="" >RPCP.LV - Reģistrēšanās procesā</strong>
                </div>
                <div class="panel-body">
				<?php
                    if($done == 1){
	                    echo '<div class="alert alert-info" role="alert">Jūsu reģistrēšanās apelācija gaida, kad tiks izskatīta. Kopumā reģistrācijas apelācijas, kuras gaida savu izskatīšanu ir - <b>'.$resco.'</b><br>Tavas apelācijas numurs ir <b>#'.$id.'</b>, tapēc ja ir kādi jautājumi tad norādi šo numuru!<br>Atjaunojat ik pa laikam lapu lai uzzinātu rezultātus!</div>';
                    }
				?>
				<?php
                    if($done == 2){
	                    echo '<div class="alert alert-success" role="alert">Jūsu reģistrācijas pieteikumu apstiprināja un tagad varat mierīgi doties serverī un ielogojaties UCP no jauna lai pilnvērtīgi to lietotu!</div>';
                    }
				?>
				<?php
                    if($done == 3){
	                    echo '<div class="alert alert-danger" role="alert">Diemžēl Jūsu reģistrešanās apelācija tika atteikta! Iesakam Jums veidot jaunu jeb piereģistrēties mēgināt vēl.</div>';
						echo '<div class="alert alert-info" role="alert">Administratora komentārs: '.$comment.'</div>';
                    }
				?>
                        <div class="row">
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">Vārds_Uzvārds</label>
									<br><?php echo $name; ?>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">E-pasts</label>
									<br><?php echo $mail; ?>
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
					<a href=""><button class="btn btn-labeled btn-primary"><span class="btn-label icon fa  fa-refresh"></span>Atjaunot lapu</button></a>
					<span style="float:left;"><a href="https://rpcp.itp.lv/"><button class="btn btn-labeled btn-primary"><span class="btn-label icon fa  fa-comment-o"></span>Forums</button></a></span>
					<span style="float:right;"><button class="btn btn-success" onClick="parent.location='logout.php'">Atpakaļ uz sākumu</button></span>
                </div>
                <div class="panel-footer">Ja ir kādas problēmas, ziņo administrācijai vai skype - julijs40</a>
                </div>
            </div>
    </div>
</div>
</center>
<?php
}
else{
    ?>
<meta http-equiv="refresh" content="0; url=logout.php" />
<div class="alert alert-danger" role="alert"><center><b>Notikusi kļūda! Sessija beigusies, ielogojies no jauna!</b></center></div>
<?php
}
mysqli_close($connect);
?>
</body>
<script>
<?php
	if(isset($_GET['send']))
    {
		?>$(window).load(function(){
	   window.history.replaceState("object", "Title", "register.php");
	   });
           <?php
    }
	?>
</script>
</html>