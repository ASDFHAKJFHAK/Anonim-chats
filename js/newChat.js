$(function(){
		// ДЛЯ ФРОНТЕРОВ ТРОГАТЬ ТОЛЬКО ТО ЧТО ПОХОЖЕ НА HTML !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	let num = 1;
	$('#form2').hide();
	$('#sucses').hide();

	$('#newChat').click(function(){
		$('#form2').show(2000);
	})

	$('#offForm2').click(function(){
		$('#form2').hide(2000);
		num = 1;
		$('#container').remove();
		$('.delit').remove();
		$('#form2').prepend(`									<div id="container">
			<div class="mb-3">
			<label for="exampleInputName" class="form-label">Название беседы</label>
			<input type="text" class="form-control"  maxlength=20 id="name" placeholder="Название" aria-describedby="emailHelp" required>
			</div>

			<div class="mb-3">
			<label for="exampleInputPassword1" class="form-label">Никнейм участника</label>
			<input type="text" id="user0" class="form-control" maxlength=20 placeholder="Никнейм"  required>
			</div>
			</div>`);

	})
	$('#repeed').click(function(){
		$('#container').children().last().remove();
	})

	$('#new').click(function(){
		$('#container').append(`<div class="mb-3"> <label for="exampleInputPassword1" class="form-label">Никнейм участника</label> <input type="text" id="user${num}" class="form-control" maxlength=20 placeholder="Никнейм"  required> </div>`);
		num++;
	})

	$('#create').click(function(e){
		e.preventDefault();
		$('.delit').remove();
		let nik = [];
		let score = 0;
		let oneNic = "";
		while (true) {
			if($(`#user${score}`)[0] !== undefined){
				oneNic = $(`#user${score}`)[0].value;
				if(oneNic != $('#login').text()){
					if (nik.find(element => element == (oneNic)) == undefined) {
						nik.push($(`#user${score}`)[0].value);
					}

				}
			}else {
				break;
			}
			score++;
		}
		let dataTemp = {
			name: $('#name')[0].value,
			nik: nik
		};

		console.dir(dataTemp);

		$.ajax({
			url: "../Server/newChat.php",
			type:"POST",
			data:{
				data: dataTemp
			},
			success: (res) => {	
				if(res.length <= 0){
					$('#form2').hide(2000);
					num = 1;
					$('#container').remove();
					$('#form2').prepend(`									<div id="container">
						<div class="mb-3">
						<label for="exampleInputName" class="form-label">Название беседы</label>
						<input type="text" class="form-control"  maxlength=20 id="name" placeholder="Название" aria-describedby="emailHelp" required>
						</div>

						<div class="mb-3">
						<label for="exampleInputPassword1" class="form-label">Никнейм участника</label>
						<input type="text" id="user0" class="form-control" maxlength=20 placeholder="Никнейм"  required>
						</div>
						</div>`);
					$('#sucses').show(1000).delay(2000).hide(1000);
				}else {
					let str = "";
					let flag = false;
					for(let i = 0; i < res.length; i++){
						if(res[i] == "@"){
							flag = true;
							i++;
						}
						if(res[i] != "#"){
							str = str + res[i];
						}else {
							str = str + ", ";
						}
					}
					if (flag) {
						$('#newChat').append(`<p class="delit">Беседа не создана</p>`);
						$('#newChat').append(`<p class="delit">Нет пользователей с ником ${str}</p>`);
					}else {
						$('#newChat').append(`<p class="delit">Беседа создана но не все пользователи добавлены</p>`);
						$('#newChat').append(`<p class="delit">Нет пользователей с ником ${str}</p>`);
					}

				}
				console.log(res);
			}

		})

	})
})