$(function(){
		// ДЛЯ ФРОНТЕРОВ ТРОГАТЬ ТОЛЬКО ТО ЧТО ПОХОЖЕ НА HTML !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	$.ajax({
		url: "../Server/getUserFromChat.php",
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
				for(let i = 0; i < res.length; i++){
					if(res[i] != "#"){
						str = str + res[i];
					}else {
						str = str + ", ";
					}
				}
				$('#newChat').append(`<p class="delit">Нет пользователей с ником ${str}</p>`);


			}
			console.log(res);
		}

	})
})