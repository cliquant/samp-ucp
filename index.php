<?php
error_reporting(0);
session_start();
?>
<html>
<head>
<title>RPCP UCP</title>
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
                <div class="panel-heading"> <strong class="" >RPCP - Spēlētāja kontrolpanelis</strong>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" autocomplete="off" name="input" method="post" action="login.php">
                        <div class="form-group">
						<?php
						    if(isset($_SESSION['Wrong'])){
							    echo '<div class="alert alert-danger" role="alert">Kļūda 404, jums ir jāienāk UCP.</div>';
							    session_destroy();
						    }
						?>
						<?php
						    if(isset($_SESSION['Email'])){
							    echo '<div class="alert alert-danger" role="alert">[REGISTER SISTĒMA] Lai ieietu Jums nepieciešams apstiprināt e-pastu!</div>';
							    session_destroy();
						    }
						?>
						<?php
						    if(isset($_SESSION['Decline'])){
							    echo '<div class="alert alert-danger" role="alert">[REGISTER SISTĒMA] Diemžēl Jūsu pieprasījumu atteica!<br>Mēģiniet reģistrēties vēlreiz!</div>';
							    session_destroy();
						    }
						?>
						<?php
						if(isset($_SESSION['timer'])){
							echo '<div class="alert alert-danger" role="alert">Jusu sessija ir beigusies, ielogojies no jauna!</div>';
							session_destroy();
						}
						?>
	  					<?php
						if(isset($_SESSION['Error'])){
							echo '<div class="alert alert-danger" role="alert">Jūsu ievadītie dati nav pareizi, mēģini vēl.</div>';
							session_destroy();
						}
						?>
						<?php
						if(isset($_GET['ok']))
                        {
							include("php/config.php");
	                        $code = $_GET['ok'];
							$cq="SELECT name,code FROM reg WHERE code='$code' AND done=0 ORDER BY id DESC LIMIT 1";
        					$req=mysqli_query($connect,$cq);
							while($row = mysqli_fetch_assoc($req)) 
    						{ 
								$name = $row['name'];
								$kods = $row['code'];
							}
        					$countq = mysqli_num_rows($req);
						    if($countq > 0){
								$q1="SELECT id FROM reg WHERE name='$name' AND done=1 and admin=0 ORDER BY id DESC LIMIT 1";
        					    $r1=mysqli_query($connect,$q1);
								$c1 = mysqli_num_rows($r1);
								if($c1 > 0){
									echo '<div class="alert alert-danger" role="alert">Šādam nikam jau tika apstiprināts e-pasts un pieprasījums tiek gaidīts uz izskatīšanu!</div>';
								}
								else{
									$qsql1 = "UPDATE reg SET done = 1 WHERE code = '".$code."' ";			
            	                    mysqli_query($connect, $qsql1); 
								    echo '<div class="alert alert-success" role="alert">Reģistrācijas pieprasījums apstiprināts! <br>Tagad Jums atliek tikai gaidīt, kad Jūsu pieprasījumu apstiprinās administratori.<br>Gaidīt varat arī ieejot UCP un saņemt tur informāciju sīkāku.</div>';
									ini_set('display_errors', 0);
            	                    require('php/conf_global.php');	// Norādi pareizu ceļu uz šo failu un visam jadarbojas
            	                    $db = new mysqli($INFO['sql_host'], $INFO['sql_user'], $INFO['sql_pass'], $INFO['sql_database']);
           		                    $db->query(
				                    "INSERT INTO `".$INFO['sql_tbl_prefix']."ucp_logs`(`s_date`,`text`)
			                        VALUES (".time().",'[REG] Spēlētājs ".$name." akceptēja reģistrācijas pieprasījumu un gaida izskatīšanu!')");
            	                    mysqli_close($db);
								}
							}
						    else{
								echo '<div class="alert alert-danger" role="alert">Kods nav atrasts, tapēc nav iespējams aktivizēt pieprasījumu! <br> Sazinies ar administrāciju, ja uzskati, ka šeit ir kļūda!</div>';
							}
							mysqli_close($connect);
						}
						?>
                            <label for="inputEmail3" class="col-sm-3 control-label">Login</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="myusername" id="inputEmail3" placeholder="Vards_Uzvards" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Parole</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="mypassword" id="inputPassword3" placeholder="Parole" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                            </div>
                        </div>
                        <div class="form-group last">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-success btn-sm" style="float:left;">Ienākt</button>
                                <button type="reset" class="btn btn-default btn-sm" style="float:left;">Reset</button>
                            </div>
                        </div>
                    </form>
					<span style="float: right;"><a href="pw.php"><button class="btn btn-labeled btn-danger" href="pw.php"><span class="btn-label icon fa fa-mail-forward"></span>Aizmirsi paroli?</button></a></span>
					<span style="float: left;"><a href="https://rpcp.itp.lv"><button class="btn btn-labeled btn-primary"><span class="btn-label icon fa  fa-comment-o"></span>Forums</button></a></span>
					<span style="margin-right: auto; margin-left: auto;"><a href="register.php"><button class="btn btn-labeled btn-warning"><span class="btn-label icon fa  fa-edit"></span>Reģistrēties</button></a></span>
                </div>
      
            </div>
    </div>
</div>
</center>
</body>
<script>
$(window).load(function(){
    $.growl.notice({ title: "INFO", message: "User Control Panel jau apkalpo vairāk kā 14 tūkstošu profilu!", duration: 180*180 });
    $.growl.notice({ title: "Support", message: "Ja ir kādi jautājumi / problēmas sazinies ar administrāciju.", duration: 9999*9999 });
    });
<?php
	if(isset($_GET['ok']))
    {
		?>$(window).load(function(){
	   window.history.replaceState("object", "Title", "/ucp/index.php");
	   });
           <?php
    }
	?>
</script>
</html>