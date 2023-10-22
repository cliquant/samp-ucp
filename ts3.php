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
<?php
/**
 * @name Display TS3 Status and Clientcount
 * @author SilentStorm
 */

date_default_timezone_set("Europe/London");
require_once("./libraries/TeamSpeak3/TeamSpeak3.php");
TeamSpeak3::init();

$status = "offline";
$count = 0;
$max = 0;
$color = "danger";

try {
    $ts3 = TeamSpeak3::factory("serverquery://212.24.102.198:10011/?server_port=9987&use_offline_as_virtual=1&no_query_clients=1");
    $status = $ts3->getProperty("virtualserver_status");
    $count = $ts3->getProperty("virtualserver_clientsonline") - $ts3->getProperty("virtualserver_queryclientsonline");
    $max = $ts3->getProperty("virtualserver_maxclients");
	if($status == "online"){
		$color = "success";
	}
}
catch (Exception $e) {
    echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
}
echo '<ul style="width:270px; height:210px" class="list-group">
<li class="list-group-item"><center>#2 TeamSpeak3 Server</center></li>
<li class="list-group-item">Servera IP<div style="float: right;"><span class="label label-warning">ts3.role.lv</span></div></li>
<li class="list-group-item">Servera statuss:<div style="float: right;"><span class="label label-' . $color . '">' . $status . '</span></div></li>
<li class="list-group-item">Online:<div style="float: right;"><span class="label label-info">' . $count . '/' . $max . '</span></div></li>';

?>