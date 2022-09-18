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
	<script src="js/js.js"></script>
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
								<a class="navbar-brand" href="profile.php">
									<p><img src="img/prof-icon.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
									Профиль</p>
								</a>
								<a class="navbar-brand" href="messange.php"><p>Сообщения</p></a>
								<a class="navbar-brand" href="friends.php"><p>Чаты</p></a>
								<form method="post" action="Server/Out.php">
									<button id="btnOut" type="submit" class="btn btn-primary mb-3 ps-4 pe-4"> Выход </button>
								</form>
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
									<p id="niks"></p>
									<button id="members" class="btn btn-secondary m-2 me-0 w-33">Участники</button>
									<button class="btn btn-success m-2 me-0 w-33" id='newChat'>Добавить</button>


									<p id="newChat"></p>
									<p id="sucses">Чат успешно расширен</p>
									<p style="display: none;" id="login"><?php echo $_SESSION['login']; ?></p>
									<p style="display: none;" id="user_id"><?php echo $_SESSION['user_id']; ?></p>
									<p style="display: none;" id="chat_id"><?php echo $_SESSION['this_chat']; ?></p>
									<form id="form2" style="max-width: 300px;" class="w-100" method="post">
										<div id="container">
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
									<div id="box">
										<form id="qwestions" method="post" action="Server/outChat.php">
											<p>Вы точно хотите выйти из беседы?</p>
											<button id="btnOut" type="submit" class="btn btn-primary mb-3 ps-4 pe-4"> Да </button>
											<button id="btnRepid" class="btn btn-primary mb-3 ps-4 pe-4"> Нет </button>
										</form>
										<form id="formAdmin" method="post" action="Server/DelitChat.php">
											<p>Выберите кого выгнать</p>
											<p id="sucses2">Пользователи успешно удалены из беседы</p>
											<?php

											foreach($_SESSION['niks'] as $nik){
												if($nik != $_SESSION['login']){
													echo "<input type='checkbox' name='chek' value='{$nik}'><p>$nik</p>";
												}
											}
											?>
											
											<button id="btnDel"  class="btn btn-primary mb-3 ps-4 pe-4"> Удалить </button>
											<button id="allDelit" type="submit" class="btn btn-primary mb-3 ps-4 pe-4"> Удалить всю беседу </button>
										</form>
										<?php 
										if ($_SESSION['admin_chat'] == true) {

											echo '<button id="delit" class="btn btn-danger m-2 me-0 w-33">Удалить</button>';

										} else{
											echo '<button id="out" class="btn btn-danger m-2 me-0 w-33">Выйти из беседы</button>';
										}
										?>
									</div>
								</div>
							</div>
						</div>
						<?php 
						$niks = "";
						foreach ($_SESSION['niks'] as $nik){
							$niks = $niks . $nik . " ,";
						}?>
						<p style="display: none;" id="niksInSesion"><?php echo $niks;?></p>
						<div id="block" class="chat-messages">
							<div id="output" class="chat-messages__content" id="messages">
								<?php
								$arr = array();
								$last_id = 0;
								$query = "SELECT id, user_id, content, time FROM message WHERE chat_id='$getURL' ORDER BY id DESC LIMIT 20";
								$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
								$numRows = mysqli_num_rows($result);
								$score = 50;
								if($numRows > 0){
									if ($numRows < 50) {
										$score = $numRows;
									}
									for(; $score > 0; $score--){
										$message = mysqli_fetch_assoc($result);
										$query_login = "SELECT login FROM user WHERE id ='{$message['user_id']}'";
										$result_login = mysqli_query($connection, $query_login) or die(mysqli_error($connection));
										$login = mysqli_fetch_assoc($result_login)['login'];
										array_push($arr, "<p>{$message['time']}</p><h3>{$login}</h3><p>{$message['content']}</p>");
										$last_id = $message['id'];
									}
									for($i = count($arr) - 1; $i >= 0; $i--){
										echo $arr[$i];
									}
									echo "<p style='display: none;' id='last_id'>$last_id</p>";
								}
								?>

							</div>
						</div>
						<form method="post" id="chat-form">
							<input id="input" type="text" class='chat-form__input' placeholder='Введите сообщение'> <input type='submit' id="set" class='chat-form__submit' value='➤'>
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
	let blocedCall = false;
	block.scrollTop = block.scrollHeight;
	block.addEventListener('scroll', function() {
		if(block.scrollTop == 0 && blocedCall == false){
			$.ajax({
				url: "../Server/GetOldMsg.php",
				type: "POST",
				data: {
					lastId: document.getElementById("last_id").innerText,
					url: document.getElementById("chat_id").innerText
				},
				success: (res) => {
					if(res != 0){
						data = JSON.parse(res);
						document.getElementById("last_id").innerText = data[data.length - 1];
						var blockMsg = document.getElementById("output");
						for(var i = 0, length1 = data.length - 1; i < length1; i++){
							let createTime = document.createElement('p');
							createTime.innerHTML = data[i]
							blockMsg.prepend(createTime);
						}
					}else {
						blocedCall = true;
					}
				}
			})
		}
	});
console.dir(block);
</script>