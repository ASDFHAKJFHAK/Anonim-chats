<?php
session_start();

require('function.php');

$user_add_to_party = $_POST['data']['nik'];
$chat_id = $_SESSION['this_chat'];
$error = array();
$new_user = array();

$success = 0;
foreach($user_add_to_party as $user){
	if(in_array($user, $_SESSION['niks']) == false){
		$query = "SELECT id FROM user WHERE login ='$user'";
		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

		if(mysqli_num_rows($result)){
			$user_id = mysqli_fetch_assoc($result)['id'];
			mysqli_query($connection, "INSERT INTO `party` (chat_id, user_id) VALUES ( '$chat_id', '$user_id')");
			
			$success++;
			array_push($new_user, $user);
		}else{
			array_push($error, $user);
		}
	}
}
$data = "";
if ($success > 0) {
	$data = "@";
	$old_chat_user = $_SESSION['niks'];
	array_push($old_chat_user, $new_user);
	$_SESSION['niks'] = $old_chat_user;
}



foreach($error as $e){
	$data = $data . "#" . $e;
}
echo($data);
?>