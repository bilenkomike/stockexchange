$('[form__answer]').each(function () {
	$(this).css('display', 'none');
});


$('[answer__comment]').each( function() {
	$(this).click(function() {
		$('[answer__comment]').each(function() {
			$(this).css('display', 'block');
		});
		$('[form__answer]').each(function () {
			$(this).css('display', 'none');
		});

		comment_id = $(this).attr('comment');
		$(this).css('display', 'none');
		$('[form__answer]').each(function() {
			if($(this).attr('id') == comment_id) {
				$(this).css('display', 'block');
			}
		});
	});
	
} );

