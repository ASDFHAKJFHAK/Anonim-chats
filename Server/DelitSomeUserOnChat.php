<?php
session_start();

require('function.php');

$user_delit_on_party = $_POST['data']['nikForDelit'];
$chat_id = $_SESSION['this_chat'];
$delUser = array();

foreach($user_delit_on_party as $user){
	$query = "SELECT id FROM user WHERE login ='$user'";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

	if(mysqli_num_rows($result)){
		$user_id = mysqli_fetch_assoc($result)['id'];
		$query = "DELETE FROM party WHERE user_id = '$user_id' and chat_id = '$chat_id'";
		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
			array_push($delUser, $user);
		}
}
$data = "";
$_SESSION['niks'] = array_diff($_SESSION['niks'], $delUser);



foreach($delUser as $e){
	$data = $data . "#" . $e;
}
echo $data;
?>
