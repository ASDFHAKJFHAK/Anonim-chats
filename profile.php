<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/swichPasword.js"></script>
	<script type="text/javascript" src="js/newChat.js"></script>
	<?php
	session_start(); 
	?>
	<title>masanger</title>
</head>
<body>
	<header>
		<nav class="navbar ">
			<div class="container-fluid">
				<a class="navbar-brand" href="messange.php">
					<p><img src="img/logo.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
					Сообщения</p>
				</a>
				<a class="navbar-brand" href="friends.php"><p>Чаты</p></a>
				<form method="post" action="Server/Out.php">
					<button id="btnOut" type="submit" class="btn btn-primary mb-3 ps-4 pe-4"> Выход </button>
				</form>
			</div>
		</nav>
		<hr>
	</header>

	<section>
		<div id="border" >
			<div class="hr__verticy__left"></div>
			<div class="hr__verticy__right"></div>
		</div>
		<center>
			<div class="width__block">

				<h1>Мой профиль</h1>

				<div class="container mt-5">
					<div class="row">
						<div class="col-4">
							<img class="mt-3" style="float: right;" src="img/logo.png" width="100" height="100">
						</div>

						<div class="col-8">
							<div class="float__left">
								<h3 >Никнейм: <?php echo "<p id='login'>{$_SESSION['login']}</p>"; ?></h3>
								<h3>Ваш ключ приглашения: <?php echo $_SESSION['key_invate']; ?></h3>
								<h3>Количество ключей: <?php echo $_SESSION['key_valid']; ?></h3>
								<button class="btn btn-primary mb-3 ps-4 pe-4" id='swichPasword'><h3>Поменять пароль</h3></button>
								<?php 
								if(isset($_SESSION)){
									echo "<p class='text-danger'>{$_SESSION['error']}</p>";
								}
								?>
								<form id="form" style="max-width: 300px;" class="w-100" method="post" action="Server/swichPasword.php">

									<div class="mb-3">
										<label for="exampleInputName" class="form-label">Старый пароль</label>
										<input type="text" class="form-control"  maxlength=40 name="oldPassword" placeholder="Старый пароль" aria-describedby="emailHelp" required>
									</div>

									<div class="mb-3">
										<label for="exampleInputPassword1" class="form-label">Новый пароль</label>
										<input type="text" name="password" class="form-control" maxlength=40 placeholder="Новый пароль"  required>
									</div>

									<button type="submit" class="btn btn-primary mb-3 ps-4 pe-4"> Поменять </button>
									<button id="offForm" class="btn btn-primary mb-3 ps-4 pe-4"> Отмена </button>

								</form>
								<button class="btn btn-primary mb-3 ps-4 pe-4" id='newChat'><h3>Создать чат</h3></button>
								<p id="sucses">Чат успешно создан</p>
								<form id="form2" style="max-width: 300px;" class="w-100" method="post">
									<div id="container">
										<div class="mb-3">
											<label for="exampleInputName" class="form-label">Название беседы</label>
											<input type="text" class="form-control"  maxlength=20 id="name" placeholder="Название" aria-describedby="emailHelp" required>
										</div>

										<div class="mb-3">
											<label for="exampleInputPassword1" class="form-label">Никнейм участника</label>
											<input type="text" id="user0" class="form-control" maxlength=20 placeholder="Никнейм"  required>
										</div>
									</div>
									<button id="new" class="btn btn-primary mb-3 ps-4 pe-4"> + </button>
									<button id="repeed" class="btn btn-primary mb-3 ps-4 pe-4"> - </button>

									<button id="create" type="submit" class="btn btn-primary mb-3 ps-4 pe-4"> Создать </button>
									<button id="offForm2" class="btn btn-primary mb-3 ps-4 pe-4"> Отмена </button>

								</form>
							</div>
						</div>

					</div>
				</div>
				<hr class="mt-3" style="height: 2px!important; opacity: 0.75!important;">
				<h1 class="mt-3">Друзья:</h1>
				<div class="container mt-3">
					<div class="row">
						<div class="col-2 mt-3">
							<img style="float: right;" src="img/logo.png" width="60" height="60">
						</div>

						<div class="col-10 mt-3">
							<div class="float__left">
								<h3>Имя:</h3>

							</div>
						</div>
						<div class="col-2 mt-3">
							<img style="float: right;" src="img/logo.png" width="60" height="60">
						</div>

						<div class="col-10 mt-3">
							<div class="float__left">
								<h3>Имя:</h3>

							</div>
						</div>

						<div class="col-2 mt-3">
							<img style="float: right;" src="img/logo.png" width="60" height="60">
						</div>

						<div class="col-10 mt-3">
							<div class="float__left">
								<h3>Имя:</h3>

							</div>
						</div>

						<div class="col-2 mt-3">
							<img style="float: right;" src="img/logo.png" width="60" height="60">
						</div>

						<div class="col-10 mt-3">
							<div class="float__left">
								<h3>Имя:</h3>

							</div>
						</div>


					</div>
				</div>

			</div>
		</center>
	</section>

</body>
</html>