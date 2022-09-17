 window.onload = function() {
 	let input = document.getElementById('input');
 	let btn = document.getElementById('set');
 	let output = document.getElementById('output');
 	let el = document.getElementById("block");
 	let login_html = document.getElementById('login');
 	let user_id_html = document.getElementById('user_id');
 	let chat_id_html = document.getElementById('chat_id');
 	let login = login_html.innerText;
 	let user_id = user_id_html.innerText;
 	let chat_id = chat_id_html.innerText;


 	var conn = new WebSocket('ws://127.0.0.1:8656');
 	conn.onopen = function(e) {
 		console.log("Connection established!");
 	};

 	conn.onmessage = function(e) {
 		console.log(e.data);
 		let data = JSON.parse(e.data);
 		console.log(e.data);
 		let createTime = document.createElement('p');
 		createTime.innerHTML = `${data.time}`;
 		output.append(createTime);
 		let createLogin = document.createElement('h3');
 		createLogin.innerHTML = `${data.login}`;
 		output.append(createLogin);
 		let createMsg = document.createElement('p');
 		createMsg.innerHTML = `${data.msg}`;
 		output.append(createMsg);
 		el.scrollTop = Math.ceil(el.scrollHeight - el.clientHeight);
 	};

 	btn.onclick = function(event) {
 		event.preventDefault();
 		let data = JSON.stringify({ "login": login, "user_id": user_id, "chat_id": chat_id, "msg": input.value});
 		console.dir(data);
 		conn.send(data);
 		input.value = "";
 	};

 	input.addEventListener('keydown', function(e) {
 		if (e.keyCode === 13 && this.value != "") {
 			e.preventDefault();
 			let data = JSON.stringify({ "login": login, "user_id": user_id, "chat_id": chat_id, "msg": input.value});
 			console.dir(data);
 			conn.send(data);
 			input.value = "";
 		}
 	});
 }