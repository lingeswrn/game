<?php
	session_start();
	include('../config/db_config.php');
	
	$val =  $_POST['mailid'];
	$name =  $_POST['name'];
	$score =  $_POST['score'];
	
	$query = "SELECT * FROM `users` WHERE `mailid` = '$val' ";	
	$result = mysql_query($query);
	
	$row = mysql_fetch_assoc($result);

	if(count($row) > 1){
		if( $row['score'] < $score){
			mysql_query("UPDATE `users` SET `name` = '$name', `score` = '$score' WHERE `mailid` = '$val'");			
			$_SESSION['score'] = $score;
		}else{
			$_SESSION['score'] = $row['score'];
		}		
		
		$_SESSION['id'] = $row['id'];
		$_SESSION['name'] = $row['name'];
		$_SESSION['mail'] = $row['mailid'];
		$_SESSION['image'] = $row['image'];
		
	}else{
		$result = mysql_query("INSERT INTO `users` (`name`,`mailid`,`score`) VALUES ('$name','$val','$score')");
		$query2 = "SELECT * FROM `users` WHERE `mailid` = '$val' ";	
		$result = mysql_query($query2);

		$_SESSION['id'] = $result['id'];
		$_SESSION['name'] = $result['name'];
		$_SESSION['mail'] = $result['mailid'];
		$_SESSION['score'] = $result['score'];
		$_SESSION['image'] = $row['image'];
	}
	echo "1";
	
?>