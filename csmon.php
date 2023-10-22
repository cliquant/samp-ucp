<?php
    $server = "";
    $ip = explode(":", $server);
    $fp = @fsockopen("udp://$ip[0]", $ip[1], $errno, $errstr);
    @stream_set_timeout($fp, 1, 0);
    @stream_set_blocking($fp, true);
    
    $server_name = "unknown";
    $server_online = "<font style=\"color: red;\">Выкл.</font>";
    $server_player = "0";
    $server_maxplayer = "0";
    $server_mapname = "Offline";
    
    if($fp)
    {
        fwrite($fp, "\xFF\xFF\xFF\xFFTSource Engine Query\x00");
        $buffer = fread($fp, 4096);
        fclose($fp);
        
        if($buffer)
        {
            $tmp = explode("\x00", $buffer);
            $place = strlen($tmp[0].$tmp[1].$tmp[2].$tmp[3].$tmp[4]) + 5;
            
            $server_name = $tmp[1];
            $server_online = "<font style=\"color: green;\">Вкл.</font>";
            $player += $server_player = ord($buffer[$place]);
            $maxplayer += $server_maxplayer = ord($buffer[$place + 1]);
            $server_mapname = $tmp[2];
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
<body class="theme-default disable-mm-animation">
<script>var init = [];</script>
<ul style="width:260px; height:210px" class="list-group">
  <li class="list-group-item"><center>#2 TS3</center></li>
  <li class="list-group-item" style="height:40px;">
  <div class="progress" style="width:225px; height:20px;">
  <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar"
  aria-valuenow="<?php echo $player; ?>" aria-valuemin="0" aria-valuemax="16" style="width:<?php $math = $player * 6.25; echo $math; ?>%">
    <font color="black"><?php echo $player; ?>/<?php echo $maxplayer; ?></font>
  </div>
</div>
  </li>
  <li class="list-group-item">Servera IP<div style="float: right;"><span class="label label-warning">188.165.29.76:27015</span></div></li>
  <li class="list-group-item">Mape<div style="float: right;"><span class="label label-info"><?php echo $server_mapname; ?></span></div></li>
</ul>
</body>
<script>
					init.push(function(){
					});
					window.PixelAdmin.start(init);
				</script>

</html>