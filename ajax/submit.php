<?php
	include('../config/db_config.php');
	
	$val =  $_POST['mailid'];
	
	$query = "SELECT * FROM `users` WHERE `mailid` = '$val' ";	
	$result = mysql_query($query);
	
	$row = mysql_fetch_assoc($result);

	if(count($row) > 1){
		$_SESSION['id'] = $row['id'];
		$_SESSION['name'] = $row['name'];
		$_SESSION['mail'] = $row['mailid'];
	}else{
		$result = mysql_query("INSERT INTO `users` (`mailid`) VALUES ('$val')");
		print_r($result);
	}
?>