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
<?php
if(isset($_GET['player_name'])) 
{
	if(isset($_GET['player_name'])){
	    include("php/config.php");
		$niks = $_GET['player_name'];
		$sql_query="SELECT name,level,datareg FROM accounts WHERE name=".$niks." LIMIT 1";
   	    $result_set=mysqli_query($connect,$sql_query);
        $fetched_row=mysqli_fetch_array($result_set);
        $name = $fetched_row['name'];
		$level = $fetched_row['level'];
		$datareg = $fetched_row['datareg'];
		header('Content-Type: image/png;');
    	$im = imagecreatefrompng('mypic.png') or die("Cannot select the correct image. Please contact the webmaster."); // Don't forget to put your picture there. 
		$text_color = imagecolorallocate($im, 197,197,199);
    	$font = "lol.ttf";
    	imagettftext($im, 16, 0, 20, 36, $text_color, $font, $name); // Prints the username in the picture.  
    	imagettftext($im, 16, 0, 72, 69, $text_color, $font, $level); // Prints the score in the picture. 
    	imagettftext($im, 16, 0, 72, 99, $text_color, $font, $datareg); // Prints the money in the picture. 
    	imagepng($im);
		mysqli_close($connect);
	}
}
?>
<body class="theme-default disable-mm-animation " style="background: url(assets/images/bg.png) repeat;">
<div class="test" style="margin-top:20px;">
<center><a href="register.php"><img src="assets/images/header.png"/></a></center>
<form action="signature.php" method="get">
        Niks: <input type="text" name="player_name"><br> 
       <input type="Submit">
       </form>

</div>

</body>
</html>