<?php
include("config.php");
require('conf_global.php');
$psql = "DELETE FROM paintball";
mysqli_query($connect, $psql);
$time = time();
$coins = 15;
$orgq = "SELECT name, pkill, pdeath, pskin FROM score WHERE pkill > 0 ORDER BY pkill DESC LIMIT 3";
$orgres = mysqli_query($connect,$orgq);
$orgcount = mysqli_num_rows($orgres);
if($orgcount == 3){
	while ($row = mysqli_fetch_array($orgres))
	{
		do
		{
			$name = $row['name'];
			$paintkill = $row['pkill'];
			$paintdeath = $row['pdeath'];
			$model = $row['pskin'];
			$gsql = "INSERT INTO paintball (nick,time,pkill,pdead,model) VALUES ('".$name."','".$time."','".$paintkill."','".$paintdeath."','".$model."' ) ";		
    		mysqli_query($connect, $gsql);
			$cquery = "UPDATE accounts SET coin =coin+'".$coins."' WHERE name = '".$name."' ";
       	    mysqli_query($connect, $cquery);
			$coins -= 5;
		}
		while ($row = mysqli_fetch_array($orgres));
	}//Iegūstam 3 labākos un ieliekam paintball tabulā.
	$db = new mysqli($INFO['sql_host'], $INFO['sql_user'], $INFO['sql_pass'], $INFO['sql_database']);
	$db->query(
	"INSERT INTO `".$INFO['sql_tbl_prefix']."shoutbox_shouts`(`s_mid`,`s_date`,`s_message`,`s_ip`)
	VALUES ('2036',".time().",'[PaintBall] Notika statu restarts un tika atrasti 3 labākie šāvēji, kuri tika arī apbalvoti. Apskatīt viņus varat šeit - http://ucp.role.lv/winpb.php','".$_SERVER['REMOTE_ADDR']."')");
}
else{
	$db = new mysqli($INFO['sql_host'], $INFO['sql_user'], $INFO['sql_pass'], $INFO['sql_database']);
	$db->query(
	"INSERT INTO `".$INFO['sql_tbl_prefix']."shoutbox_shouts`(`s_mid`,`s_date`,`s_message`,`s_ip`)
	VALUES ('2036',".time().",'[PaintBall] Notika statu restarts un diemžēl šonedēļ 3 labākie šāvēji netika atrasti dēļ spēlētāju trūkuma.','".$_SERVER['REMOTE_ADDR']."')");
}
$sql = "DELETE FROM score";
mysqli_query($connect, $sql);
mysqli_close($db);
mysqli_close($connect);
?>