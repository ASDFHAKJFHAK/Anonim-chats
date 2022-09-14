<?php

session_start();
require('function.php');

$chat_id = $_SESSION['this_chat'];

if($_SESSION['admin_chat'] == true){
	mysqli_query($connection, "DELETE FROM `chat` WHERE id = '$chat_id'");

	foreach($_SESSION['chats'] as $key => $item){
		if ($item == $chat_id){
			unset($_SESSION['chats'][$key]);
			unset($_SESSION['chat_name'][$key]);
			break;
		}
	}

	header("Location: ../friends.php");
}

?>