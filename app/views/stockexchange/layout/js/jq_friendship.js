$(document).ready(function() {
	$('#request__friendshipForm').submit(function(event) {
		var json;
		event.preventDefault();
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(result) {
				$('[modal-call="request_frendship--modal"]').each(function () {
					$(this).removeAttr('query-modal');
					$(this).removeAttr('modal-call');
					$(this).removeAttr('modal');
					$(this).removeClass('btn--mnsd--blue');
					$(this).addClass('btn--mnsd--orange');
					$(this).text('In progress');

				});
				$('.modal').each(function() {
					$(this).removeClass('selected');
					$('body').removeClass('no-scroll');
				});
				$('[model="fileload"]')[0].reset();
			},
		});
	});
});