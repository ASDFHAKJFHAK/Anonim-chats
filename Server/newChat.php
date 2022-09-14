<?php

session_start();
require('function.php');

$name = trim(urldecode(htmlspecialchars($_POST['data']['name'])));
$user_add_to_party = $_POST['data']['nik'];
$id = $_SESSION['user_id'];
mysqli_query($connection, "INSERT INTO `chat` ( name, user_id) VALUES ('$name', '$id')");
$chat_id = mysqli_insert_id($connection);
$error = array();
$success = 0;
foreach($user_add_to_party as $user){
	$query = "SELECT id FROM user WHERE login ='$user'";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
	if(mysqli_num_rows($result)){
		$user_id = mysqli_fetch_assoc($result)['id'];
		mysqli_query($connection, "INSERT INTO `party` (chat_id, user_id) VALUES ( '$chat_id', '$user_id')");
		$success++;
	}else{
		array_push($error, $user);
	}
}
$data = "";
if($success <= 0){
	mysqli_query($connection, "DELETE FROM `chat` WHERE id = '$chat_id'");
	$data = "@";
}else{
	mysqli_query($connection, "INSERT INTO `party` (chat_id, user_id) VALUES ( '$chat_id', '$id')");

	$old_chat_id = $_SESSION['chats'];
	array_push($old_chat_id, $chat_id);
	$_SESSION['chats'] = $old_chat_id;
	$old_chat_name = $_SESSION['chat_name'];
	array_push($old_chat_name, $name);
	$_SESSION['chat_name'] = $old_chat_name;
}

foreach($error as $e){
	$data = $data . "#" . $e;
}
echo($data);
?>