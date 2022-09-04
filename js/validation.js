$(function(){
	$('#submit').click(function(e){
		if($('#password')[0].value !== $('#passwordRepeat')[0].value){
			e.preventDefault();
			$('#passwordRepeat').addClass('border-danger').addClass('border-3');
		}
	})

})