<?php

session_start();
require('function.php');
$user_id = $_SESSION['user_id'];
$chat_id = $_SESSION['this_chat'];

$query = "DELETE FROM party WHERE user_id = '$user_id' and chat_id = '$chat_id'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

foreach($_SESSION['chats'] as $key => $item){
    if ($item == $chat_id){
      unset($_SESSION['chats'][$key]);
      unset($_SESSION['chat_name'][$key]);
      
      break;
    }
}
header("Location: ../friends.php");
?>