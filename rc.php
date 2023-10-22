<?php
if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
  $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
}
if (gethostbyname('wos.lv') == $_SERVER['REMOTE_ADDR']){
	$user = $_GET['user'];
	include("php/config.php");
	if(mysqli_ping($connect)) {
		$mylink = mysqli_connect($smsdb['host'], $smsdb['user'], $smsdb['pass'], $smsdb['db']);
		if(mysqli_ping($mylink)) {
			$coins = 1;
	    	$date = date("Y-m-d G:i:s");
			$time_needed = "1440";
			$from_time = strtotime($date);
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
			$user_ip = getUserIP();
			$check = "SELECT * FROM users WHERE account = '".$user."'";
		    $result2 = mysqli_query($mylink, $check);
    	    $row2 = mysqli_fetch_row($result2); 
    	    $count2 = mysqli_num_rows($result2);
		    if($count2 == 1)
		    {
				$voted_ip = $row2[2]; 
        	    $voted_date = $row2[3]; 
        	    $voted_id = $row2[0]; 
        	    $voted_account = $row2[1]; 
        	    $to_time = strtotime($voted_date);     	
        	    if (round(abs($to_time - $from_time) / 60,2) > $time_needed) 
			    {
        	        $qsql1 = "UPDATE users SET date = '".$date."', ip = '".$user_ip."'  WHERE account = '".$user."' ";			
        	        mysqli_query($mylink, $qsql1);  
	    	        $qsql2 = "UPDATE points SET reward_points =reward_points+'".$coins."' WHERE account = '".$user."' ";
        	        mysqli_query($mylink,$qsql2);
        	        $qsql3 = "UPDATE accounts SET coin =coin+'".$coins."' WHERE name = '".$user."' ";
        	        mysqli_query($connect,$qsql3);
					ini_set('display_errors', 0);
        	        require('ucp/php/conf_global.php');
        	        $db = new mysqli($INFO['sql_host'], $INFO['sql_user'], $INFO['sql_pass'], $INFO['sql_database']);
        	        $db->query(
	    	        "INSERT INTO `".$INFO['sql_tbl_prefix']."ucp_logs`(`s_date`,`text`)
	   		        VALUES (".time().",'[Vote] Spēlētājs ".$user." nobalsoja par serveri un saņēma par to 1 RCoins.')");
			        mysqli_close($db);
	                mysqli_close($connect);
	                mysqli_close($mylink);
				}
			}
			else
			{
				$voted_ip = $row2[2]; 
        	    $voted_date = $row2[3]; 
        	    $voted_id = $row2[0]; 
        	    $voted_account = $row2[1]; 
        	    $to_time = strtotime($voted_date);     	
        	    if (round(abs($to_time - $from_time) / 60,2) > $time_needed) 
			    {
				    $qsql4 = "INSERT INTO users (account,ip,date) VALUES ('".$user."','".$user_ip."','".$date."' ) ";		
        		    mysqli_query($mylink, $qsql4);  
        		    $qsql5 = "INSERT INTO points (account,reward_points) VALUES ('".$user."','".$coins."')";		
        		    mysqli_query($mylink, $qsql5);
				    $qsql6 = "UPDATE accounts SET coin =coin+'".$coins."' WHERE name = '".$user."' ";
       	    	    mysqli_query($connect,$qsql6);
					ini_set('display_errors', 0);
        	        require('ucp/php/conf_global.php');
        	        $db = new mysqli($INFO['sql_host'], $INFO['sql_user'], $INFO['sql_pass'], $INFO['sql_database']);
        	        $db->query(
	    	        "INSERT INTO `".$INFO['sql_tbl_prefix']."ucp_logs`(`s_date`,`text`)
	   		        VALUES (".time().",'[Vote] Spēlētājs ".$user." nobalsoja par serveri un saņēma par to 1 RCoins.')");
			        mysqli_close($db);
				    mysqli_close($connect);
	                mysqli_close($mylink);
				}
			}
		}	
    }
	mysqli_close($connect);
	mysqli_close($mylink);
}
?>