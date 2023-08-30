$('[likes-dislikes]').each(function() {
	$(this).click(function() {
		if(!$(this).children().hasClass('fas')) {
			$('[likes-dislikes]').each(function() {
					$(this).children().removeClass('fas');
			});
			$(this).children().addClass('fas');
			$.post('home/likedsislike/', {workId:$(this).attr('wwork-id'), like:$(this).attr('data-like')}, function(result) {
				json = jQuery.parseJSON(result).message;
				$('#likes').html(json.likes);
				$('#dislikes').html(json.dislikes);
			});
		}
	});
});