<?php

session_start();
require('function.php');

if(isset($_POST['login']) and isset($_POST['password'])){
	$login = trim(urldecode(htmlspecialchars($_POST['login'])));
	$password = trim(urldecode(htmlspecialchars($_POST['password'])));

	$query = "SELECT id, key_invate, key_valid FROM user WHERE login='$login' and password='$password'";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

	if(mysqli_num_rows($result)){


		$user_id = mysqli_fetch_assoc($result);

		$query = "SELECT chat_id FROM party WHERE user_id ='{$user_id['id']}'";
		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
		$chat_id = array();
		$chat_name = array();
		$chat_id_if_admin = array();
		$num_rows = mysqli_num_rows($result);

		while ($num_rows){
			$num_rows--;
			array_push($chat_id, mysqli_fetch_assoc($result)['chat_id']);
		}

		setcookie("login", $login, time()+60*60*24*30,  '/');
		setcookie("password", $password, time()+60*60*24*30,  '/'); 
		

		if(count($chat_id) > 0){
			$query = "SELECT id FROM chat WHERE user_id ='{$user_id['id']}'";
			$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
			$num_rows = mysqli_num_rows($result);
			if($num_rows > 0){
				while ($num_rows){
					$num_rows--;
					array_push($chat_id_if_admin, mysqli_fetch_assoc($result)['id']);
				}
			}
			

			foreach($chat_id as $chat){
				$query = "SELECT name FROM chat WHERE id ='$chat'";
				$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
				array_push($chat_name, mysqli_fetch_assoc($result)['name']);
			}
		}

		$_SESSION['error'] = null;
		$_SESSION['chats'] = $chat_id;
		$_SESSION['login'] = $login;
		$_SESSION['key_invate'] = $user_id['key_invate'];
		$_SESSION['key_valid'] = $user_id['key_valid'];
		$_SESSION['user_id'] = $user_id['id'];
		$_SESSION['chat_id_if_admin'] = $chat_id_if_admin;
		$_SESSION['chat_name'] = $chat_name;
		header("Location: ../profile.php");
	}else{
		$_SESSION['error'] = 'Неверный никнейм или пароль';
		header("Location: ../login.php");
	}

}
?>