<?php
error_reporting(0);
session_start();
$cookie_name = "user";
$cookie_value = $_POST['myusername'];
$tbl_name="accounts"; // Table name 

$con = mysqli_connect("localhost","rpcproleplay","SaIh0nk)4bTW","rpcproleplay");
if (mysqli_connect_errno())
{
  echo "Nevar savienoties ar datubazi!" . mysqli_connect_error();
}
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword'];
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($con,$myusername);
$mypassword = mysqli_real_escape_string($con,$mypassword);
$sql="SELECT * FROM $tbl_name WHERE name='$myusername' and password='$mypassword' LIMIT 1";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
if($count==1){
	setcookie($cookie_name, $cookie_value, time() + (3600), "/"); // 86400 = 1 day
    $_SESSION['myusername'] = $myusername;
    $_SESSION['mypassword'] = $mypassword;
    header("location:intro.php");
}
else{
	$ch1="SELECT name FROM reg WHERE name='$myusername' and parole='$mypassword' and done = 1 and admin = 0 ORDER BY id DESC LIMIT 1";
    $res1=mysqli_query($con,$ch1);
    $resco=mysqli_num_rows($res1);
	if($resco > 0){
		$_SESSION['waitname'] = $myusername;
		header("location:wait.php");
	}
	else{
	    $check="SELECT name FROM reg WHERE name='$myusername' and parole='$mypassword' and done = 3 and admin = 1 ORDER BY id DESC LIMIT 1";
        $chres=mysqli_query($con,$check);
        $chcount=mysqli_num_rows($chres);
	    if($chcount > 0){
		    $_SESSION['waitname'] = $myusername;
		    header("location:wait.php");
	    }
	    else{
		    $text="SELECT name FROM reg WHERE name='$myusername' and parole='$mypassword' and done = 0 and admin = 0 ORDER BY id DESC LIMIT 1";
            $ress=mysqli_query($con,$text);
            $rescount=mysqli_num_rows($ress);
		    if($rescount > 0){
			    $_SESSION['Email'] = $myusername;
		        header("location:index.php");
		    }
			else{
				$_SESSION['Error'] = $myusername;
		        header("location:index.php");
			}
	    }
	}
}
?>
