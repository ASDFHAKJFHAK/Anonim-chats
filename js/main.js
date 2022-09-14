$(function() {


	let batton = undefined;
	let admin = false;
	let chekBtn = false;
	$('#qwestions').hide();
	$('#formAdmin').hide();
	$('#sucses2').hide();

	if ($('#out')[0] !== undefined) {
		batton = $('#out');
	} else {
		batton = $('#delit')
		admin = true;
	}



	$('#niks').hide();
	let clickButton = $('#clickButton');
	clickButton.slideUp();
	let num = false;
	$('#button').click(function() {
		$('#qwestions').hide(1000);
		$('#formAdmin').hide();
		batton.text("Удалить");

		if (num == false) {
			clickButton.slideDown(500);
			num = !num;
		} else {
			clickButton.slideUp(500);
			num = false;
			$('#niks').hide();
		}
		console.log(num);
	});
	let niks = $('#niksInSesion').text();
	let num2 = false;
	$('#members').click(function() {
		if (num2 == false) {
			$('#niks').text(niks).show(1000);
			num2 = !num2;
		} else {
			$('#niks').hide();
			num2 = false;
		}

	})

	let num3 = 1;
	$('#form2').hide();
	$('#sucses').hide();

	$('#newChat').click(function() {
		$('#form2').show(2000);
	})

	$('#offForm2').click(function() {
		$('#form2').hide(2000);
		num3 = 1;
		$('#container').remove();
		$('.delit').remove();
		$('#form2').prepend(`									<div id="container">

			<div class="mb-3">
			<label for="exampleInputPassword1" class="form-label">Никнейм участника</label>
			<input type="text" id="user0" class="form-control" maxlength=20 placeholder="Никнейм"  required>
			</div>
			</div>`);

	})
	$('#repeed').click(function() {
		$('#container').children().last().remove();
	})

	$('#new').click(function() {
		$('#container').append(`<div class="mb-3"> <label for="exampleInputPassword1" class="form-label">Никнейм участника</label> <input type="text" id="user${num3}" class="form-control" maxlength=20 placeholder="Никнейм"  required> </div>`);
		num3++;
	})

	$('#create').click(function(e) {
		e.preventDefault();
		$('.delit').remove();
		let nik = [];
		let score = 0;
		let oneNic = "";

		while (true) {
			if ($(`#user${score}`)[0] !== undefined) {
				oneNic = $(`#user${score}`)[0].value;
				if (oneNic != $('#login').text()) {
					if (nik.find(element => element == (oneNic)) == undefined) {
						nik.push($(`#user${score}`)[0].value);
					}

				}
			} else {
				break;
			}
			score++;
		}
		let dataTemp = {
			nik: nik
		};

		console.dir(dataTemp);

		$.ajax({
			url: "../Server/newUserFromChat.php",
			type: "POST",
			data: {
				data: dataTemp
			},
			success: (res) => {
				if (res.length <= 1) {
					$('#form2').hide(2000);
					num3 = 1;
					$('#container').remove();
					$('#form2').prepend(`									<div id="container">
						<div class="mb-3">
						<label for="exampleInputPassword1" class="form-label">Никнейм участника</label>
						<input type="text" id="user0" class="form-control" maxlength=20 placeholder="Никнейм"  required>
						</div>
						</div>`);
					$('#sucses').show(1000).delay(2000).hide(1000);
				} else {

					let str = "";
					let flag = false;
					for (let i = 0; i < res.length; i++) {
						if (res[i] == "@") {
							flag = true;
							i++;
						}
						if (res[i] != "#") {
							str = str + res[i];
						} else {
							str = str + ", ";
						}
					}
					if (flag == false) {
						$('#newChat').append(`<p class="delit">Чат не удалось пополгить</p>`);
						$('#newChat').append(`<p class="delit">Нет пользователей с ником ${str}</p>`);
					} else {
						$('#newChat').append(`<p class="delit">Чат пополнен но не все пользователи добавлены</p>`);
						$('#newChat').append(`<p class="delit">Нет пользователей с ником ${str}</p>`);
					}

				}
				console.log(res);
			}

		})



	})



	$('#btnRepid').click(function(e) {
		e.preventDefault();
		$('#qwestions').hide(1000);
	})

	batton.click(function() {
		if (admin == false) {
			$('#qwestions').show(1000);
			$('#newChat').hide();
		} else {
			if (chekBtn == false) {
				batton.text("Отмена");
				chekBtn = !chekBtn;
				$('#formAdmin').show(1000);
			} else {
				$('#formAdmin').hide(1000);
				batton.text("Удалить");
				chekBtn = !chekBtn;
			}

		}
	})

	$('#btnDel').click(function(e) {
		e.preventDefault();
		let nikForDelit = [];
		let dataDelit = ($('input:checkbox:checked'));
		for (let i = 0; i < dataDelit.length; i++) {
			nikForDelit.push(dataDelit[i].value);
		}
		if (nikForDelit.length > 0) {
			let nikDelit = {
				nikForDelit: nikForDelit
			};

			$.ajax({
				url: "../Server/DelitSomeUserOnChat.php",
				type: "POST",
				data: {
					data: nikDelit
				},
				success: (res) => {
					dataDelit.next().remove();
					dataDelit.remove();
					$('#sucses2').show(1000).delay(1000).hide(1000);
				}
			})
		}
	})
})