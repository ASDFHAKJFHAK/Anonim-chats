<?php 

session_start();

require('function.php');


if(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['key_invate']) && isset($_POST['email'])){

	$key_invate = trim(urldecode(htmlspecialchars($_POST['key_invate'])));
	$login = trim(urldecode(htmlspecialchars($_POST['login'])));
	$email = trim(urldecode(htmlspecialchars($_POST['email'])));
	$password = trim(urldecode(htmlspecialchars($_POST['password'])));

	$passwordHash = password_hash($password, PASSWORD_DEFAULT);

	// ОПТИМИЗАЦИЯ ПЕРВАЯ OCHERED
	$query = "SELECT * FROM user WHERE login='$login' or email='$email'";
	$chekResult = mysqli_query($connection, $query) or die(mysqli_error($connection));
	
	if(mysqli_num_rows($chekResult)){
		$_SESSION['error'] = 'Уже существует такой логин или почта';
		header("Location: /../index.php");
	}
	else {
		$query_key = "SELECT id, key_valid FROM user WHERE key_invate='$key_invate'";
		$result_key = mysqli_query($connection, $query_key) or die(mysqli_error($connection));

		if(mysqli_num_rows($result_key)){

			$user_info = (mysqli_fetch_assoc($result_key));

			if($user_info['key_valid'] > 0) {
				$user_info1 = $user_info['id'];
				$user_info2 = $user_info['key_valid'] - 1;

				$pass = bin2hex(openssl_random_pseudo_bytes(4));

				mysqli_query($connection, "UPDATE `user` SET `key_valid` ='$user_info2' WHERE `id` = '$user_info1' ");
				mysqli_query($connection, "INSERT INTO `user` (login, email, password, invate_id, key_invate) VALUES ('$login' , '$email' , '$passwordHash' , $user_info1, '$pass')");

				setcookie("login", $login, time()+60*60*24*30,  '/');
				setcookie("password", $password, time()+60*60*24*30,  '/');

				$_SESSION['error'] = null;
				
				header("Location: /../login.php");
			}
			else{
				$_SESSION['error'] = 'Кончились ключи входа';
				header("Location: /../index.php");
			}

		}
		else{
			$_SESSION['error'] = 'Нет такого ключа входа';
			header("Location: /../index.php");
		}

	}
}
echo $_SESSION['error'];






/* возвращает 2, так как id,email === двум полям */

?>