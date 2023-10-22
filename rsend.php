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
    $query = "SELECT id,admin,coin,online FROM $usertable WHERE $namerow = '$username'";  
	$result=mysqli_query($connect,$query);
    while($row = mysqli_fetch_assoc($result)) 
    { 
		$admin = $row[$adminrow];
		$points = $row['coin'];
		$onle = $row['online'];
		$id = $row['id'];
	}
	$supq="SELECT id FROM rcquest WHERE done=0";
    $suppres=mysqli_query($connect,$supq);
    $suprcount = mysqli_num_rows($suppres);
	$rcbansql="SELECT admin FROM rcbans WHERE playerid = '$id'";
    $rcbanres=mysqli_query($connect,$rcbansql);
    $rcbans = mysqli_num_rows($rcbanres);
	if($rcbans > 0){
		while($asd = mysqli_fetch_assoc($rcbanres)) 
        {   
		    $guilty = $asd['admin'];
	    }
	}
} 
else
{	
    header('location: index.php');
	mysqli_close($connect);
	exit();
}
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
				  <a class='navbar-brand' href=''>ROLE <small>UCP</small></a>
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
										<li class='dropdown-submenu'><a href='http://ucp.role.lv/ccpanel' target='_blank'>WebAdmin</a>
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
if(isset($_GET['send'])) 
{
	if($onle == 0)
	{
	    $search="SELECT no FROM rcquest WHERE no='$username' AND done=0";
	    $wtf = mysqli_query($connect, $search);
	    $rowcount = mysqli_num_rows($wtf);
		if($rowcount == 0)
		{
	    	if(isset($_POST['nick']))
	    	{
		    	if(isset($_POST['number']))
	        	{
			    	$rc = $_POST['number'];
					if($rc > 0)
					{
				    	if($rc <= $points)
		            	{
							if($rcbans == 0){
								$to = $_POST['nick'];
								$humanq = "SELECT name FROM accounts WHERE name='$to'";
								$reshum = mysqli_query($connect, $humanq);
								$humcount = mysqli_num_rows($reshum);
								if($humcount == 1)
								{
						    		$points -= $rc;
				            		$qcon = "UPDATE accounts SET coin='$points' WHERE $namerow = '$username'";
                            		mysqli_query($connect, $qcon);
			               			$mess = $_POST['mess'];
			                		$date = time();
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
			                		$gosql = "INSERT INTO rcquest (no, uz, rc, mess, date,ip)
			                		VALUES ('".$username."', '".$to."', '".$rc."', '".$mess."', '".$date."', '".$userip."')";
        	                		mysqli_query($connect, $gosql);
				            		$done = "1";
									ini_set('display_errors', 0);
        	                        require('php/conf_global.php');
        	                        $db = new mysqli($INFO['sql_host'], $INFO['sql_user'], $INFO['sql_pass'], $INFO['sql_database']);
        	                        $db->query(
	    	                        "INSERT INTO `".$INFO['sql_tbl_prefix']."ucp_logs`(`s_date`,`text`)
	   		                        VALUES (".time().",'[RCSend] Spēlētājs ".$username." pieprasa nosūtīt ".$to." ".$rc." RCoins!')");
			                        mysqli_close($db);
								}
								else
					    		{
									$dont = "1";
								}
							}
							else
					    	{
								$bans = "1";
							}	
			        	}
			        	else
		            	{
				        	$enough = "1";
			       	    }	
					}
		    	}
	    	}
		}
		else
		{
			$error = "1";
		}
	}
	else{
		$error = "1";
	}
}

if($enough == 1)
{
?>
<div id="nomoney" class="modal modal-alert modal-danger fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-times-circle"></i>
							</div>
							<div class="modal-title">Kļūda!</div>
							<div class="modal-body">
Tev nav pietiekami daudz RCoins kontā!						
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div><?php
				}
				?>
<?php
if($error == 1)
{
?>
<div id="error" class="modal modal-alert modal-danger fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-times-circle"></i>
							</div>
							<div class="modal-title">Kļūda!</div>
							<div class="modal-body">
Pieprasījums nevar notikt, jo Jūs jau esat pieprasījis pārskaitīt vai arī esat online serverī!		
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div><?php
				}
				?>
<?php
if($bans == 1)
{
?>
<div id="bans" class="modal modal-alert modal-danger fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-times-circle"></i>
							</div>
							<div class="modal-title">Kļūda!</div>
							<div class="modal-body">
Pieprasījums nevar notikt, jo Jums ir uzlikts liegums pārsūtīt!		
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div><?php
				}
				?>
				
<?php
if($done == 1)
{
?>
<div id="done" class="modal modal-alert modal-success fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-check-circle"></i>
							</div>
							<div class="modal-title">Pieprasījums tika nosūtīts!</div>
							<div class="modal-body">
Drīzumā administrācija pieprasījumu izskatīs.		
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div><?php
				}
				?>
				
<?php
if($dont == 1)
{
?>
<div id="dont" class="modal modal-alert modal-danger fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<i class="fa fa-times-circle"></i>
							</div>
							<div class="modal-title">Kļūda!</div>
							<div class="modal-body">
Netika atrasts tāds spēlētājs.		
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div><?php
				}
				?>
<!-- Info table -->
				<div class="table-info" style="width:1000px; margin-left:auto; margin-right:auto;">
<?php
if($rcbans == 0){
	?>
<form action="rsend.php?send" method="post" class="panel form-horizontal">
					<div class="panel-heading">
						<span class="panel-title">RCoins sūtīšanas pieprasījums</span>
					</div>
					<div class="panel-body">
						<div class="row">
						<div class="col-md-4">
						<div class="stat-row">
								<!-- Success darken background, small padding, vertically aligned text -->
								<div class="stat-cell bg-success darken padding-sm valign-middle">
									Kontā <? echo $points ?> RCoins
								</div>
							</div>

							</div>
							<div class="col-md-4">
								<input type="text" name="nick" placeholder="Ievadi niku kam vēlies nosūtīt" class="form-control form-group-margin" required="">
							</div>
							<div class="col-md-4">
								<input type="number" name="number" placeholder="Ievadi RCoins skaitu cik vēlies nosūtīt" class="form-control form-group-margin" required="">
							</div>
						</div><!-- row -->
						<textarea class="form-control" name="mess" rows="3" placeholder="Iemesls, kapēc vēlaties sūtīt?" required=""></textarea>
					</div>
					<div class="panel-footer text-right">
						<button type="submit" class="btn btn-primary">Sūtīt pieprasījumu</button>
					</div>
				</form>
<!-- /7. $NO_LABEL_FORM -->
<?php 
}else{
	?>
<div class="panel panel-danger panel-dark">
					<div class="panel-heading">
						<span class="panel-title">RCoins pārsūtīšanas liegums</span>
						<div class="panel-heading-controls">
							<div class="panel-heading-icon"><i class="fa  fa-envelope-o"></i></div>
						</div>
					</div>
					<div class="panel-body">
						Diemžēl esam pamanījuši, ka šim profilam ir uzlikts RCoins pārsūtīšanas liegums un Jūs nevarat vairs pārsūtīt savus RCoins citiem.<br>
						Iespējamais iemesls, kāpēc esat saņēmis liegumu ir, ka esat mēģinājis negodīgi rīkoties ar citiem saviem profiliem. <br>
						Ja tomēr uzskatat, ka liegums ir uzlikts nepatiesi tad par to noņemšanu varat vērsties forumā pie sūdzībām vai skype - julijs40<br>
						Administrators, kas uzlika liegumu: <?php echo $guilty; ?>
						<br>
						<br>Ar cieņu, Role.lv
					</div>
				</div>
	<?php
}
?>
			</div>

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
	if($enough == 1)
    {
		?>$(window).load(function(){
       $('#nomoney').modal('show');
	   window.history.replaceState("object", "Title", "rsend.php");
	   });
           <?php
    }
	?>
	<?php
	if($done == 1)
    {
		?>$(window).load(function(){
       $('#done').modal('show');
	   window.history.replaceState("object", "Title", "rsend.php");
	   });
           <?php
    }
	?>
	<?php
	if($bans == 1)
    {
		?>$(window).load(function(){
       $('#bans').modal('show');
	   window.history.replaceState("object", "Title", "rsend.php");
	   });
           <?php
    }
	?>
	<?php
	if($error == 1)
    {
		?>$(window).load(function(){
       $('#error').modal('show');
	   window.history.replaceState("object", "Title", "rsend.php");
	   });
           <?php
    }
	?>
	<?php
	if($dont == 1)
    {
		?>$(window).load(function(){
       $('#dont').modal('show');
	   window.history.replaceState("object", "Title", "rsend.php");
	   });
           <?php
    }
	?>
</script>

<center><footer class="container-fluid text-center" style="width:1000px;margin-center:-15px;margin-top:-20px;">
  <p style="margin-left:800px;">© since 2015 · role.lv</p>
</footer></center>
</body>
</html>
<?php
mysqli_close($connect);
?>