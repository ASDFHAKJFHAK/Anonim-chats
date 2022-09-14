<?php

session_start();

require('function.php');

$getURL = trim(urldecode(htmlspecialchars($_GET['id'])));
$_SESSION['this_chat'] = $getURL;
$query = "SELECT * FROM party WHERE chat_id='$getURL' and user_id='{$_SESSION['user_id']}'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

$logins =array();

if(mysqli_num_rows($result)){
	if(in_array($getURL, $_SESSION['chat_id_if_admin']) == true){
		$_SESSION['admin_chat'] = true;
	}else{
		$_SESSION['admin_chat'] = false;
	}
	$query = "SELECT user_id FROM party WHERE chat_id='$getURL'";
	$result_id = mysqli_query($connection, $query) or die(mysqli_error($connection));
	$num = mysqli_num_rows($result_id);
	if($num){
		while($num){
			$num--;
			$user = mysqli_fetch_assoc($result_id)['user_id'];
			$query = "SELECT login FROM user WHERE id='$user'";
			$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
			array_push($logins, mysqli_fetch_assoc($result)['login']);
		}
	}
	$_SESSION['niks'] = $logins;
}
else{
	echo "ti pidoras? wishel nahui iz chuzoi komnaty";
	header("Location: /../profile.php");
}

?>