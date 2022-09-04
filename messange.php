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
	<script src="js/main.js"></script>
	<?php
	session_start();
	require("Server/chatFunction.php") 
	?>
	<title>messenger</title>
</head>
<body style="overflow: hidden;">
	<section>
		<div style="height: 100%; position: absolute;" class="w-100 mt-2">
			<div style="height:100%;" class="row w-100 m-0">
				<div class="col-12">
					<header>
						<nav class="navbar ">
							<div class="container-fluid justify-content-start">
								<a class="navbar-brand" href="profile.html">
									<p><img src="img/prof-icon.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
									Профиль</p>
								</a>
								<a class="navbar-brand" href="messange.php"><p>Сообщения</p></a>
							</div>
						</nav>
						<hr>
					</header>

					<div class="chat">

						<div class="d-flex justify-content-center">
							<div id="button" class=" col-12 mt-1 p-0 d-flex justify-content-center border btn">
								<h3>ᐯ</h3>
							</div>
						</div>	
						<!-- при нажатии на кнопку  -->
						<div class="d-flex justify-content-center" style="position: relative;">
							<div id="clickButton" class=" col-12  border" style="position: absolute; background-color: #171624;">
								<div class="d-flex justify-content-center flex-wrap">
									<button class="btn btn-secondary m-2 me-0 w-33">Участники</button>
									<button class="btn btn-success m-2 me-0 w-33">Добавить</button>
									<button class="btn btn-danger m-2 me-0 w-33">удалить</button>
								</div>
							</div>
						</div>
						<div id="block" class="chat-messages">
							<div class="chat-messages__content" id="messages">

								<?php
								echo "<pre>";
									var_dump($_SESSION);
								echo "</pre>";?>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
								<p>какой то текст</p>
							</div>
						</div>
						<form method="post" id="chat-form">
							<input type="text" class='chat-form__input' placeholder='Введите сообщение'> <input type='submit' class='chat-form__submit' value='➤'>
						</form>
					</div>

				</div>

			</div>
		</div>
	</div>
</section>
</body>

<script>
	var block = document.getElementById("block");
	block.scrollTop = block.scrollHeight;
</script>