<?php
session_start();
require('function.php');

if(isset($_POST['oldPassword']) and isset($_POST['password'])){
	$id = $_SESSION['user_id'];
	$oldPassword = trim(urldecode(htmlspecialchars($_POST['oldPassword'])));
	$password = trim(urldecode(htmlspecialchars($_POST['password'])));

	$passwordHashOld = password_hash($oldPassword, PASSWORD_DEFAULT);
	$passwordHash = password_hash($password, PASSWORD_DEFAULT);

	$query = "SELECT password FROM user WHERE password='$passwordHashOld'";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

	if(mysqli_num_rows($result)){
		echo "{$id}";
		$query = "UPDATE user SET password = '$passwordHash' WHERE id = '$id'";
		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));


		$_SESSION['error'] = null;
		header("Location: ../profile.php");
	}else{
		$_SESSION['error'] = 'Старый пароль не совпадает';
		header("Location: ../profile.php");
	}

}
?>