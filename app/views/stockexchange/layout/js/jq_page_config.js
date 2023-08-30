$('[name="post__text"]').on('input', function(event) {
	text = $(this).val();
	if(text.length >= 500) {
		$(this).val(function() {
			return this.value.substr(0,500);

		});
	}
	else {
		$(this).val();
	}
});
