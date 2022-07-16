<?php 

// This refers to the previous code block.
include "safe_encrypt.php"; 
$key = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);

$room = $_POST['room'];

//Connect database
include 'db_connect.php';

$sql = "SELECT msg, stime, ip FROM msgs WHERE room = '$room' ";
$html_content = '';
$result = mysqli_query($connect, $sql);

if(mysqli_num_rows($result) > 0){
	while ($row = mysqli_fetch_assoc($result)){
		//$plaintext 	  = safeDecrypt($row['msg'], $key);
		$html_content = $html_content . '<div class="container">';
		$html_content = $html_content . $row['ip'];
		$html_content = $html_content . " Says <p>" .$row['msg'];
		$html_content = $html_content . "</p><span class='time-right'>" .$row['stime'] ."</span></div>";
	}
}
echo $html_content;


?>