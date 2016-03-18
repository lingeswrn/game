<?php
	session_start();
	include('../config/db_config.php');
	
	$query = "SELECT * FROM `users` order by score desc limit 10";	
	$result = mysql_query($query);
	$response = array();
	$response['response'] = '';
	$sl = 1;
	while($tbl = mysql_fetch_assoc($result)){
		$response['response'] .= "<table><tr><th>".$sl."</th><th>".$tbl['name']."</th><th>".$tbl['score']."</th></tr></table";
		$sl++;		
	}
print_r($response['response']);	
?>