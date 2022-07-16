<?php 
$roomname = $_GET['roomname'];

//Connect database
include 'db_connect.php';

//Check room exists or not
$sql = "SELECT * FROM `rooms` WHERE roomname ='$roomname'";

$result = mysqli_query($connect, $sql);

if($result){

	if( mysqli_num_rows($result) == 0 ){
		$message = "This room does not exists";
		echo '<script language="javascript">';
		echo 'alert("'.$message.'");';
		echo 'window.location="http://localhost:8888/php/chatroom/"';
		echo '</script>';
	}

}else{
	echo "Error: ".mysqli_error($connect);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
.chatbox input, .chatbox button{
	padding:10px 15px;
}
.chatbox input{
	display: block;
	width: 100%;

}
.chatbox-wrap{
	height: 300px;
	overflow-y: scroll;
}
</style>
</head>
<body>

	<h2>Chat Messages - <?php echo $roomname; ?> </h2>

	<div class="container chatbox-wrap">
	  <img src="assets/images/avatar.png" alt="Avatar" style="width:100%;">
	  <p>Hello. How are you today?</p>
	  <span class="time-right">11:00</span>
	</div>

	<div class="chatbox">
		<input type="text" name="usermsg" id="usermsg" placeholder="Type your Messages">
		<button name="submitmsg" id="submitmsg">Send Now</button>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

	<script>
		//Check for new messages for every 1 second.
		setInterval(runFunction, 1000);
		function runFunction(){
			$.post("htcont.php", {room: '<?php echo $roomname?>'},
				function(data, status){
					document.getElementsByClassName('chatbox-wrap')[0].innerHTML = data;
				}
			)
		}

		// Get the input field
		var input = document.getElementById("usermsg");
		input.addEventListener("keypress", function(event) {
		  if (event.key === "Enter") {
		    // Cancel the default action, if needed
		    event.preventDefault();
		    // Trigger the button element with a click
		    document.getElementById("submitmsg").click();
		  }
		});

		$("#submitmsg").click(function(){
			let clientmsg = $('#usermsg').val();
		  $.post("postmsg.php", {text:clientmsg, room: '<?php echo $roomname?>', ip: '<?php echo $_SERVER['REMOTE_ADDR'] ?>'}),
		  function(data, status){
		  	document.getElementsByClassName('chatbox-wrap')[0].innerHTML = data;};
		  	$('#usermsg').val("");
		return false;
		});
	</script>

</body>
</html>
