<?php
$server_name 	= 'localhost';
$user_name		= 'root';
$password		= 'root';
$db_name		= 'chatroom';

//Creating Database connection
$connect = mysqli_connect( $server_name, $user_name, $password, $db_name );
if(!$connect){
	die("Failed to DB connect".mysql_error());
}
		
?>