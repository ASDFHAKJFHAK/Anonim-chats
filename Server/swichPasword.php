<?php
session_start();
require('function.php');

if(isset($_POST['oldPassword']) and isset($_POST['password'])){
	$id = $_SESSION['user_id'];
	$oldPassword = trim(urldecode(htmlspecialchars($_POST['oldPassword'])));
	$password = trim(urldecode(htmlspecialchars($_POST['password'])));
	$query = "SELECT password FROM user WHERE password='$oldPassword'";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

	if(mysqli_num_rows($result)){
		echo "{$id}";
		$query = "UPDATE user SET password = '$password' WHERE id = '$id'";
		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));


		$_SESSION['error'] = null;
		header("Location: ../profile.php");
	}else{
		$_SESSION['error'] = 'Старый пароль не совподает';
		header("Location: ../profile.php");
	}

}
?>