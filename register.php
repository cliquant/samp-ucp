<?php
error_reporting(0);
session_start();
?>
<html>
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
.panel-default {
 width:1000px;
}
</style>
<?php
if(isset($_GET['send'])) 
{
	if(isset($_POST['niks']) || isset($_POST['parole']) || isset($_POST['epasts']) || isset($_POST['sex']) || isset($_POST['skin']) || isset($_POST['national']) || isset($_POST['why']) || isset($_POST['rp'])){
	    include("php/config.php");
		$niks = $_POST['niks'];
		$parole = $_POST['parole'];
        $epasts = $_POST['epasts'];
        $sex = $_POST['sex'];
        $skin = $_POST['skin'];
        $national = $_POST['national'];
        $why = $_POST['why'];
		$rp = $_POST['rp'];
		$click = $_POST['agree'];
	    $nikq="SELECT name FROM reg WHERE name='$niks' and done = 1 and admin = 0";
        $nikres=mysqli_query($connect,$nikq);
        $nikcount = mysqli_num_rows($nikres);
		if($nikcount > 0){
			$error = "1";
		}
		else{
			$useq="SELECT name FROM accounts WHERE name='$niks'";
            $useres=mysqli_query($connect,$useq);
            $usercount = mysqli_num_rows($useres);
			if($usercount > 0){
				$error = "1";
			}
			else{
				function getUserIP()
    			{
        			$client  = @$_SERVER['HTTP_CLIENT_IP'];
        			$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        			$remote  = $_SERVER['REMOTE_ADDR'];
        			if(filter_var($client, FILTER_VALIDATE_IP))
        			{
            			$ip = $client;
					}
        			elseif(filter_var($forward, FILTER_VALIDATE_IP))
        			{
            			$ip = $forward;
        			}
        			else
        			{
            			$ip = $remote;
        			}
        			return $ip;
    			}
				$userip = getUserIP();
				$date = time();
				$code = $date + $skin;
				$done = "0";
				$ipq="SELECT ip FROM reg WHERE ip='$userip' AND done=1 and admin = 0";
                $ipres=mysqli_query($connect,$ipq);
                $ipcount = mysqli_num_rows($ipres);
				if($ipcount > 0){
					$error = "4";
				}
				else{
				    if($sex == 1 || $sex == 2){
					    if($skin > 0 && $skin < 300){
							if($click == 1){
								$gosql = "INSERT INTO reg (`name`, `parole`, `mail`, `sex`, `skin`, `national`, `why`, `rp`, `ip`, `date`, `code`, `done`)
		    	    	    	VALUES ('".$niks."', '".$parole."', '".$epasts."', '".$sex."', '".$skin."', '".$national."', '".$why."', '".$rp."', '".$userip."', '".$date."', '".$code."', '".$done."')";
        		   	 	    	mysqli_query($connect, $gosql);
								$to      = $epasts;
   						    	$subject = 'RPCP.lv profila reģistrācijas apstiprināšanas vēstule';
   						    	$message = 'Atver šo linku lai aktivizētu reģistrēšanas pieprasījumu: https://rpcp.itp.lv/ucp/index.php?ok='.$code.'';
   						    	$headers = 'From: <role@role.lv>' . "\r\n" .
   						    	'Reply-To: role@role.lv' . "\r\n" .
   						    	'Content-Type: text/html; charset=utf-8' . "\r\n" .
  						   	    'X-Mailer: PHP/' . phpversion();
						    	mail($to, $subject, $message, $headers);
								$ok = "1";
							}
						    else{
								$error = "5";
							}
					    }
					    else{
						    $error = "3";
					    }
				    }
				    else{
					    $error = "2";
				    }	
				}
			}
		}
		mysqli_close($connect);
	}
}
?>
<body class="theme-default disable-mm-animation " style="background: url(assets/images/bg.png) repeat;">
<div class="test" style="margin-top:20px;">
<center><a href="register.php"><img src="assets/images/header.png"/></a></center>
</div>
<?php
if($error == 0){
	?>
<center>
<div class="container">
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading"> <strong class="" >RPCP.LV - Spēlētāja reģistrācija</strong>
                </div>
                <div class="panel-body">
				<?php
                    if($ok == 1){
	                    echo '<div class="alert alert-success" role="alert">Tavs pieprasījums nosūtīts administrācijai, tagad apstiprini pieprasījumu! Vēstule nosūtīta uz Tavu norādīto e-pastu jeb '.$epasts.'! <br>Brīdinam, ka vēstule var atrasties arī spam paskastē jeb surogātpastā.</div>';
                    }
				?>
                    <form class="form-horizontal" method="post" action="register.php?send">
                        <div class="row">
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">Vārds_Uzvārds</label>
									<input type="text" name="niks" class="form-control" placeholder="Ievadi kādu IG niku gribi" required="">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">Parole(MAX 16 simboli)</label>
									<input type="password" name="parole" class="form-control" placeholder="Ievadi kādu paroli vēlies profilam" required="">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">E-Pasta adrese (Viņa būs vajadzīga lai apstiprinātu reģistrāciju)</label>
									<input type="text" name="epasts" class="form-control" placeholder="Tava īstā e-pasta adrese,kas tiks saglabāta profilam" required="">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
								<label for="jq-validation-select" class="col-sm-3 control-label">Izvēlies dzimumu</label>
								<div class="col-sm-9">
									<select class="form-control" id="sex" name="sex">
										<option value="">Izvēlies...</option>
											<option value="1">Vīrietis</option>
											<option value="2">Sieviete</option>
									</select>
								</div>
							</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">Ievadi skina id kādu vēlies sev(<a href="http://wiki.sa-mp.com/wiki/Skins:All" target="_blank">Skinus varat redzēt spiežot šeit!</a>)</label>
									<input type="number" name="skin" class="form-control" placeholder="Skina ID (1-299)" required="">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">Personāža tautība</label>
									<input type="text" name="national" class="form-control" placeholder="Ievadi tautību" required="">
								</div>
							</div>
						</div>
						<div class="row">
						<div class="form-group no-margin-hr">
									<label class="control-label">Pastāstiet ar kādu mērķi vēlaties reģistrēt šo profilu</label>
						<textarea class="form-control" name="why" rows="3" placeholder="Pastāstiet par saviem mērķiem" required=""></textarea>
						</div>
						</div>
						<div class="row">
						<div class="form-group no-margin-hr">
									<label class="control-label">Izskaidrojiet pāris RP terminus kādus zinat kā, piemēram, DeathMatch(DM), Powergaming(PG), Metagaming(MG).</label>
						<textarea class="form-control" name="rp" rows="3" placeholder="Pastāstiet kādus RP terminus zinat un paskaidrojat ko tie nozīmē." required=""></textarea>
						</div>
						<br>
						<div class="alert alert-info" role="alert"><b>Ievēro tas ir svarīgi!</b> Ievadi pareizu e-pastu, jo pēc pieprasījuma nosūtīšanas Jums būs jaapstiprina e-pasts lai varētu veikt tālākās darbības un administratori saņemtu Jūsu pieprasījumu!</div>
						<br>
						<input type="checkbox" name="agree" value="1"> Ar šo es apliecinu, ka piekrītu role.lv noteikumiem un esmu sapratis visu par e-pasta apstiprināšanu!<br><p>
						</div>
					<button type="submit" class="btn btn-primary">Sūtīt pieprasījumu reģistrācijai</button>
					</form>
					<span style="float:left;"><a href="http://role.lv/forum"><button class="btn btn-labeled btn-primary"><span class="btn-label icon fa  fa-comment-o"></span>Forums</button></a></span>
					<span style="float:right;"><a href="index.php"><button class="btn btn-success" href="index.php">Atpakaļ uz sākumu</button></a></span>
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
<center>
<div class="container">
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading"> <strong class="" >ROLE.LV - Spēlētāja reģistrācija</strong>
                </div>
                <div class="panel-body">
				<?php
                    if($error == 1){
	                    echo '<div class="alert alert-danger" role="alert">Šāds niks jau eksistē vai gaida savu apstiprinājumu!</div>';
                    }
                    if($error == 2){
	                    echo '<div class="alert alert-danger" role="alert">Nav norādīts pareizs dzimums!</div>';
                    }
					if($error == 3){
	                    echo '<div class="alert alert-danger" role="alert">Atļauts tikai 1-299 skina id!</div>';
                    }
					if($error == 4){
	                    echo '<div class="alert alert-danger" role="alert">No vienas IP atļauts tikai vienreiz pieprasīt reģistrāciju. Gaidat, kad izskatīs administratori veco!</div>';
                    }
					if($error == 5){
	                    echo '<div class="alert alert-danger" role="alert">Tu neesi atķeksējis, ka piekrīti role.lv noteikumiem! Bez tā Tu nevari turpināt reģistrāciju.</div>';
                    }
                ?>
                    <form class="form-horizontal" method="post" action="register.php?send">
                        <div class="row">
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">Vārds_Uzvārds</label>
									<input type="text" name="niks" class="form-control" placeholder="Ievadi kādu IG niku gribi" required="" value="<?php echo $niks; ?>">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">Parole</label>
									<input type="password" name="parole" class="form-control" placeholder="Ievadi kādu paroli vēlies profilam" required="" value="<?php echo $parole; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">E-Pasta adrese (Viņa būs vajadzīga lai apstiprinātu reģistrāciju)</label>
									<input type="text" name="epasts" class="form-control" placeholder="Tava īstā e-pasta adrese,kas tiks saglabāta profilam" required="" value="<?php echo $epasts; ?>">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
								<label for="jq-validation-select" class="col-sm-3 control-label">Izvēlies dzimumu</label>
								<div class="col-sm-9">
									<select class="form-control" id="sex" name="sex">
										<option value="">Izvēlies...</option>
											<option value="1">Vīrietis</option>
											<option value="2">Sieviete</option>
									</select>
								</div>
							</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">Ievadi skina id kādu vēlies sev(<a href="http://wiki.sa-mp.com/wiki/Skins:All" target="_blank">Skinus varat redzēt spiežot šeit!</a>)</label>
									<input type="number" name="skin" class="form-control" placeholder="Skina ID (1-299)" required="" value="<?php echo $skin; ?>">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group no-margin-hr">
									<label class="control-label">Personāža tautība</label>
									<input type="text" name="national" class="form-control" placeholder="Ievadi tautību" required="" value="<?php echo $national; ?>">
								</div>
							</div>
						</div>
						<div class="row">
						<div class="form-group no-margin-hr">
									<label class="control-label">Pastāstiet ar kādu mērķi vēlaties reģistrēt šo profilu</label>
						<textarea class="form-control" name="why" rows="3" placeholder="Pastāstiet par saviem mērķiem" required=""><?php echo $why; ?></textarea>
						</div>
						</div>
						<div class="row">
						<div class="form-group no-margin-hr">
									<label class="control-label">Izskaidrojiet pāris RP terminus kādus zinat kā, piemēram, DeathMatch(DM), Powergaming(PG), Metagaming(MG).</label>
						<textarea class="form-control" name="rp" rows="3" placeholder="Pastāstiet kādus RP terminus zinat un paskaidrojat ko tie nozīmē." required=""><?php echo $rp; ?></textarea>
						</div>
						<br>
						<div class="alert alert-info" role="alert"><b>Ievēro tas ir svarīgi!</b> Ievadi pareizu e-pastu, jo pēc pieprasījuma nosūtīšanas Jums būs jaapstiprina e-pasts lai varētu veikt tālākās darbības un administratori saņemtu Jūsu pieprasījumu!</div>
						<br>
						<input type="checkbox" name="agree" value="1"> Ar šo es apliecinu, ka piekrītu role.lv noteikumiem un esmu sapratis visu par e-pasta apstiprināšanu!<br><p>
						</div>
					<button type="submit" class="btn btn-primary">Sūtīt pieprasījumu reģistrācijai</button>
					</form>
					<span style="float:left;"><a href="http://role.lv/forum"><button class="btn btn-labeled btn-primary"><span class="btn-label icon fa  fa-comment-o"></span>Forums</button></a></span>
					<span style="float:right;"><a href="index.php"><button class="btn btn-success" href="index.php">Atpakaļ uz sākumu</button></a></span>
                </div>
                <div class="panel-footer">Ja ir kādas problēmas, ziņo administrācijai vai skype - julijs40</a>
                </div>
            </div>
    </div>
</div>
</center>
<?php
}
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