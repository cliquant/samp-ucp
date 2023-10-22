<html lang="en-US">
<?php
error_reporting(0);
$servername = "RPCP.LV";
$username = "rpcp";
$password = "";
$dbname = "role";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT id FROM accounts"); 
$stmt->execute();
$rows = $stmt->fetchAll();
$num_rows = count($rows);
//Profilu saskaitīšana.
$house = $conn->prepare("SELECT id FROM house"); 
$house->execute();
$houserows = $house->fetchAll();
$numhouse = count($houserows);
//Māju saskaitīšana
$bizz = $conn->prepare("SELECT id FROM bizz"); 
$bizz->execute();
$bizzrows = $bizz->fetchAll();
$numbizz = count($bizzrows);
//Biznesu saskaitīšana.
$conn = null;
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
<div class="bg" color="black">
<?php
require "samp_query.php";

$serverIP = "rp.role.lv";
$serverPort = 7777;

try
{
    $rQuery = new QueryServer( $serverIP, $serverPort );

    $aInformation = $rQuery->GetInfo( );
	
    $rQuery->Close( );
}
catch (QueryServerException $pError)
{
    echo '<ul style="width:299px; height:210px" class="list-group">
  <li class="list-group-item"><center>SAMP Server</center></li>
  <li class="list-group-item">Servera IP<div style="float: right;"><span class="label label-warning">rp.role.lv:7777</span></div></li>
  <li class="list-group-item">Spēlētāji serverī<div style="float: right;"><span class="label label-default">OFF</span></div></li>
  <li class="list-group-item">Kopumā reģistrēti<div style="float: right;"><span class="label label-danger">'.$num_rows.'</span></div></li>
  <li class="list-group-item">Kopumā mājas<div style="float: right;"><span class="label label-default">'.$numhouse.'</span></div></li>
  <li class="list-group-item">Kopumā biznesu<div style="float: right;"><span class="label label-default">'.$numbizz.'</span></div></li>
</ul>';
}

if(isset($aInformation)){
?>
<body>
<ul style="width:299px; height:210px" class="list-group">
  <li class="list-group-item" style="background-color:black;"><center><span class="label label-primary">SAMP Server</span></center></li>
  <li class="list-group-item" style="background-color:black;"><span class="label label-primary">Servera IP</span><div style="float: right;"><span class="label label-warning">rp.role.lv:7777</span></div></li>
  <li class="list-group-item" style="background-color:black;"><span class="label label-primary">Spēlētāji serverī</span><div style="float: right;"><span class="label label-default"><?php echo $aInformation['Players']; ?></span></div></li>
  <li class="list-group-item" style="background-color:black;"><span class="label label-primary">Kopumā reģistrēti</span><div style="float: right;"><span class="label label-danger"><?php printf("%d", $num_rows); ?></span></div></li>
  <li class="list-group-item" style="background-color:black;"><span class="label label-primary">Kopumā mājas</span><div style="float: right;"><span class="label label-default"><?php printf("%d", $numhouse); ?></span></div></li>
  <li class="list-group-item" style="background-color:black;"><span class="label label-primary">Kopumā biznesu</span><div style="float: right;"><span class="label label-default"><?php printf("%d", $numbizz); ?></span></div></li>
</ul>
</div>
</body>
</html>
<?php
}
?>