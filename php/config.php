<?php
error_reporting(0);
$dbhost = 'localhost';
$dbuser = 'rpcproleplay';
$dbpass = 'SaIh0nk)4bTW';
$dbname = 'rpcproleplay';
$usertable = 'accounts';
$namerow = 'name';
$pwrow = 'password';
$skinrow = 'model';
$cashrow = 'cash';
$hourrow = 'time';
$dataregrow = 'datareg';
$adminrow = 'admin';
$org = 'leader';
$bankrow = 'bank';
$numberrow = 'phone';
$agerow = 'age';
$sexrow = 'sex';
$iprow = 'ip';
$emailrow = 'mail';
$levelrow = 'level';
$jobrow = 'job';
$fuel = 'timers';
$carcost = 'carcost';
$carmod = 'car';
$c1 = 'cColor1';
$c2 = 'cColor2';
$organisator = 'member';
$lockrow = 'clock';
$paintrow = 'paintjob';
$phonerow = 'phone';
$securerow = 'security';
$coderow = 'code';
$smsdb = array(  
    'host' => "localhost",  
    'user' => "rpcproleplay",  
    'pass' => "SaIh0nk)4bTW",  
    'db'   => "rpcproleplay"
);
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if (mysqli_connect_errno())
{
  echo "Nevar savienoties ar datubazi!" . mysqli_connect_error();
}
function escape($string)
{  
        $string = strip_tags($string);  
        $string = mysqli_real_escape_string($string);  
        return $string;  
} 
?>