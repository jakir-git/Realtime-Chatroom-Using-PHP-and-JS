<?php
//Connect database
include 'db_connect.php';

$msg 	= $_POST['text'];
$room 	= $_POST['room'];
$ip 	= $_POST['ip'];

// This refers to the previous code block.
include "safe_encrypt.php"; 

// Do this once then store it somehow:
$key = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);

$message = safeEncrypt($msg, $key);

$sql = "INSERT INTO `msgs` ( `msg`, `room`, `ip`, `stime`) VALUES ( '$msg', '$room', '$ip', CURRENT_TIMESTAMP);";

mysqli_query($connect, $sql);
mysqli_close();

?>