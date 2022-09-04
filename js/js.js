
let input = document.getElementById('input');
let btn = document.getElementById('btn');
let output = document.getElementById('output');

let login = document.getElementById('login').innerText;

var conn = new WebSocket('ws://127.0.0.1:8656');
conn.onopen = function(e) {
	console.log("Connection established!");
};

conn.onmessage = function(e) {
	console.log(e.data);
	output.innerHTML +=  e.data +  "<br>";
};

btn.onclick = function() {
	console.log(login.innerText);
	var msg = input.value;
	conn.send(msg);
};
