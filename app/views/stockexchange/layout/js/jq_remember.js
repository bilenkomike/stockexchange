$('#remember').click(function(){
	if($(this).is(':checked')) {
		$('#input--remember--checked').addClass('checked');
		// alert('checked');
	}
	else {
		$('#input--remember--checked').removeClass('checked');
		// alert('not checked');
	}
});
