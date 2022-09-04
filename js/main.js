$(function(){
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
		}
		console.log(num);
	});
})