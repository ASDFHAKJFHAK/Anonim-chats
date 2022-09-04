<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	<script src="js/jquery.js"></script>
	<?php session_start(); ?>
	<title>friends</title>
</head>

<body>

	<header>
		<nav class="navbar ">
			<div class="container-fluid justify-content-start">
				<a class="navbar-brand" href="profile.html">
					<p><img src="img/prof-icon.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
					Профиль</p>
				</a>
				<a class="navbar-brand" href="messenger.html"><p>Сообщения</p></a>
			</div>
		</nav>
		<hr>
	</header>

	<section>
		<h1 class="mt-3 text-center">Чаты:</h1>
		<div class="container mt-3">
			<div class="row">


				<?php foreach($_SESSION['chat_name'] as $key => $name) {
					// code...
					?>
					<!-- cообщества -->
					<a href="messange.php?id=<?php echo $_SESSION['chats'][$key]; ?>"> asdafa</a>
					<div class=" col-10 mt-3 border"> 
						<div class="float__left">
							
							<h3><img src="img/icon.jpg" width="60" height="60"><?php echo $name; ?></h3>
						</div>
					</div>
<!--  -->



					<!-- при нажатии на кнопку  -->
<!-- 					<div id="clickButton" class=" col-12  border">
						<div class="d-flex justify-content-center flex-wrap">
							<button class="btn btn-secondary m-2 me-0 w-33">Участники</button>
							<button class="btn btn-success m-2 me-0 w-33">Добавить</button>
							<button class="btn btn-danger m-2 me-0 w-33">удалить</button>
						</div>
					</div> -->
					<?php
				}
				?>


				<!-- друзья -->
				<!-- <div class="col-12 mt-3 border">
				<div class="float__left">
				<h3><img src="img/prof-icon.png" width="60" height="60">
				андрей</h3>

				</div>
				</div>

				<div class="col-12 mt-3 border">
				<div class="float__left">
				<h3><img src="img/prof-icon.png" width="60" height="60">
				максим</h3>

				</div>
				</div>

				<div class="col-12 mt-3 border">
				<div class="float__left">
				<h3><img src="img/prof-icon.png" width="60" height="60">
				влад</h3>

				</div>
				</div>

				<div class="col-12 mt-3 border">
				<div class="float__left">
				<h3><img src="img/prof-icon.png" width="60" height="60">
				дима</h3>

				</div>
				</div>

				<div class="col-12 mt-3 border">
				<div class="float__left">
				<h3><img src="img/prof-icon.png" width="60" height="60">
				эдик(лох)</h3>

				</div>
				</div>
				-->
				</div>
				</div>
				</section>
				</body>
				</html>