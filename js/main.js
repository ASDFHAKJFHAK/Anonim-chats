$(function(){
	$('#niks').hide();
	let clickButton = $('#clickButton');
	clickButton.slideUp();
	let num = false;
	$('#button').click(function(){

		if(num == false){
			clickButton.slideDown(500);
			num = !num;
		}
		else{
			clickButton.slideUp(500);
			num = false;
			$('#niks').hide();
		}
		console.log(num);
	});
	let niks = $('#niksInSesion').text();
	let num2 = false;
	$('#members').click(function(){
		if (num2 == false) {
			$('#niks').text(niks).show(1000);
			num2 = !num2;
		}
		else {
			$('#niks').hide();
			num2 = false;
		}

	})
})