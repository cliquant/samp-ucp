<?php
error_reporting(0);
if(isset($_POST['username'])) {
$username = "roleplaylv"; 
$password = "@&W6miD*ubO4"; 
$host = "195.3.145.190"; 
$dbname = "roleplaylv"; 
try {
$DBH = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);
}
catch(PDOException $ex) 
{ 
   $msg = "Nesanāca savienoties ar datubāzi."; 
} 
$epasts = $_POST['username'];
$nick = $_POST['nick'];
$STH = $DBH->prepare("SELECT name, password, mail FROM accounts WHERE mail=? and name=?");
$STH->execute(array($epasts, $nick));
$rows = $STH->fetchAll();
$num_rows = count($rows);
if($num_rows == 1)
{ 
$STH->execute();
while ($row = $STH->fetch(PDO::FETCH_ASSOC)) 
{ 
   $dbname = $row['name'];
   $dbemail = $row['mail'];
   $dbpass = $row['password'];
} 
if($nick == $dbname && $epasts == $dbemail)
{ 
   $to      = $epasts;
   $subject = 'Paroles atjaunošana';
   $message = 'Parole: '.$dbpass.'';
   
   $headers .= "MIME-Version: 1.0\r\n";
   $headers .= "Content-type: text/html\r\n";
   $headers .= 'From: role@role.lv' . "\r\n" .
   'Reply-To: role@role.lv' . "\r\n" .
   'X-Mailer: PHP/' . phpversion();
   $mailresult = mail($to, $subject, $message, $headers);
   $DBH = null;
   ini_set('display_errors', 0);
   require('php/conf_global.php');	// Norādi pareizu ceļu uz šo failu un visam jadarbojas
   $db = new mysqli($INFO['sql_host'], $INFO['sql_user'], $INFO['sql_pass'], $INFO['sql_database']);
   $db->query(
   "INSERT INTO `".$INFO['sql_tbl_prefix']."ucp_logs`(`s_date`,`text`)
   VALUES (".time().",'[PWRecovery] Nosūtijām ".$nick." Tavu paroli uz e-pastu!')");
   mysqli_close($db);
}
}
}else {
	if ($_POST ['username'] != "") {
	$lol ="1";
	$DBH = null;
		}
		}
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
</head>
<style>
.container {
 margin-left: auto;
 margin-right: auto;
 margin-top:20px;
}

.panel-default {
 width:500px;
}

.form-group.last {
 margin-bottom:0px;
}
</style>
<body class="theme-default disable-mm-animation " style="background: url(assets/images/bg.png) repeat;">
<div class="test" style="margin-top:20px;">
<center><a href="index.php"><img src="assets/images/header.png"/></a></center>
</div>
<center>
<div class="container">
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading"> <strong class="">RPCP.LV - Paroles atjaunošana</strong>

                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" autocomplete="off" name="input" method="post" action="">
                        <div class="form-group">
						<?php
if($lol==1)
	{
		echo '<div class="alert alert-danger" role="alert">Notika problēma!</div>';
	}
?>
						<?php
if($num_rows == 1)
	{
		echo '<div class="alert alert-success" role="alert">Tava parole tika nosūtīta uz norādīto e-pastu. Vēstule atnāks tuvākajās minūtēs.</div>';
	}
		else
		{
		if($_POST['username']!="")
		echo '<div class="alert alert-danger" role="alert">Norādīto e-pastu neatradām datubāzē.</div>';
	}
?>
                            <label for="inputEmail3" class="col-sm-3 control-label">Lietotājvārds</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nick" id="inputEmail3" placeholder="Vārds_Uzvārds" required="">
                            </div>
							</div>
							<div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">E-Pasts</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="username" id="inputPassword3" placeholder="piemers@inbox.lv" required="">
                            </div>
                        </div>
                        <div class="form-group last">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-success btn-sm" style="float:left;">Sūtīt</button>
                                <button type="reset" class="btn btn-default btn-sm" style="float:left;">Reset</button>
                            </div>
                        </div>
                    </form>
					</div>
					<div class="panel-footer">Ievadi niku un e-pastu ar kuru tika reģistrēts profils un uz kuru nosūtīsies parole.</a>
                </div>
				</div>
    </div>
</div>
</center>
</body>
</html>