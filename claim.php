<?php
$room = $_POST['room'];

if( strlen($room) > 20 or strlen($room) < 2 ){
	$message = "Please enter a name between 2 to 20 character";
	echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="http://localhost:8888/php/chatroom/"';
	echo '</script>';
}else if (!ctype_alnum($room)) {
	$message = "Please enter a alphanumaric room name";
	echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="http://localhost:8888/php/chatroom/"';
	echo '</script>';
}else{
	//Connect to Database
	include 'db_connect.php';
}

//Check if room is alredy exist or not.
$sql = "SELECT * FROM `rooms` where roomname = '$room'";
$result = mysqli_query($connect, $sql);

if($result){

	if( mysqli_num_rows($result) > 0 ){
		$message = "Please type different room it's already exist";
		echo '<script language="javascript">';
		echo 'alert("'.$message.'");';
		echo 'window.location="http://localhost:8888/php/chatroom/"';
		echo '</script>';
	}else{
		$sql = "INSERT INTO `rooms` ( `roomname`, `stime`) VALUES ('$room', CURRENT_TIMESTAMP); ";
		if(mysqli_query($connect, $sql)){
			$message = "Your room is ready and you can chat now";
			echo '<script language="javascript">';
			echo 'alert("'.$message.'");';
			echo 'window.location="http://localhost:8888/php/chatroom/rooms.php?roomname='.$room.'";';
			echo '</script>';
		}
	}

}else{
	echo "Error".mysqli_error($connect);
}

?>
