<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	<title>login</title>
</head>
<body>
	<section style="height:100vh">
		<div class="container__registr h-100">
			<div class="row justify-content-center h-reg-log ms-4">
				<div class=" col-12 col-sm-6 d-flex flex-column justify-content-center">
					<h1 class="mt-3 mb-3">Добро пожаловать на анонимный чат!</h1>
					<p class="h4 mb-3">Здесь ты сможешь:</p>
					<p class="h4 mb-3">-  общаться не раскрывая свои данные</p>
					<p class="h4 mb-3">-  поговорить с новыми людьми</p>
					<p class="h4 mb-3">-  узнать много нового</p>
					<p class="h4 mb-3">-  провести весело время</p>
					<p class="h4 form-text">будте осторожны со свое личной информацией, не сообщаейте ее ни кому</p>
				</div>
				<div class="col-12 col-sm-6 d-flex align-items-center justify-content-center mt-5 h-100">
					<form style="max-width: 300px;" class="w-100" method="post" action="Server/authorization.php">

						<div class="mb-3">
							<label for="exampleInputName" class="form-label">Никнейм</label>
							<input type="text" class="form-control"  maxlength=20 name="login" placeholder="Логин" value="<?php if(isset($_COOKIE['login'])) 
							echo "{$_COOKIE['login']}"; ?>" 
							aria-describedby="emailHelp" required>
						</div>

						<div class="mb-3">
							<label for="exampleInputPassword1" class="form-label">Пароль</label>
							<input type="password" name="password" class="form-control" maxlength=40 placeholder="Пароль" value="<?php if(isset($_COOKIE['password'])) 
							echo "{$_COOKIE['password']}"; ?>"  required>
						</div>

						<?php 
						session_start();
						if(isset($_SESSION['error'])){
							echo "<p class='text-danger'>{$_SESSION['error']}</p>";
						}
						?>

						<button type="submit" class="btn btn-primary mb-3 ps-4 pe-4" href=""> Вход </button>
						<a class="btn btn-primary mb-3 ps-4 pe-4" href="index.php"> Регистрация </a>

					</form>
				</div>
			</div>
		</div>
	</section>
</body>
</html>