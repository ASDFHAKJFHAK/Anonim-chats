<?php
require('function.php');

$getURL = trim(urldecode(htmlspecialchars($_POST['url'])));
$arr = array();
$last_id = trim(urldecode(htmlspecialchars($_POST['lastId'])));
$query = "SELECT id, user_id, content, time FROM message WHERE chat_id='$getURL' and id < $last_id ORDER BY id DESC LIMIT 20";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$numRows = mysqli_num_rows($result);
$score = 50;
if($numRows > 0){
	if ($numRows < 50) {
		$score = $numRows;
	}
	for(; $score > 0; $score--){
		$message = mysqli_fetch_assoc($result);
		$query_login = "SELECT login FROM user WHERE id ='{$message['user_id']}'";
		$result_login = mysqli_query($connection, $query_login) or die(mysqli_error($connection));
		$login = mysqli_fetch_assoc($result_login)['login'];
		array_push($arr, "<p>{$message['time']}</p><h3>{$login}</h3><p>{$message['content']}</p>");
		$last_id = $message['id'];
	}
	array_push($arr, $last_id);
	$arr = json_encode($arr);
	echo $arr;
}else{
	echo 0;
}