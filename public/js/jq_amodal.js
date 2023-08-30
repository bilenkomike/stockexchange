$('#load__image__form').attr('action', window.location.pathname.substr(8));



$('.modal__content').each(function() {
	$(this).click(function(e) {
		e.stopPropagation();

	});
});



const modals = $('[modal]');
const modal_queries = $('[query-modal]');
if(modal_queries.length > 0) {
	modal_queries.each(function() {
		$(this).click(function(e) {
			modal__call = $(this);
			
			modal = $(this).attr('modal-call');

			modals.each(function() {
				$(this).removeClass('selected');
				if($(this).attr('data-modal') == modal) {

					$(this).addClass('selected');
					$('body').addClass('no-scroll');

					if (modal == 'content-append-modal' || modal == 'content-append-modal2') {
						$.get('home/getContentFiles/', function(result) {

							json = jQuery.parseJSON(result);
							images = json.message;

							$('.select__images__content').each(function() {
								$(this).html('');
							});
							for ( let i = 0; i < images.length; i++ ) {
								path = images[i].path;
								name = images[i].name;
									
									$('.select__images__content').append('<div class="select__images__item"><div style="background-image: url('+ path +');" class="select__image__block"></div><input id="' + name + '" value="'+ path +'" name="append_to_content_image[]" type="checkbox"><label class="input__select__image" for="'+ name +'" select__image><span class="selected__image" data-image-src="' + path + '"></span></label></div>');
							}

							setTimeout(chooseImage(), 200);


						});
					}
				}
			});

		});
	});
}

$('[modal]').each(function () {

	$(this).click(function() {
		$(this).removeClass('selected');
		$('body').removeClass('no-scroll');
	});
	
});




$('[data-id="modal__close"]').each(function() {
	$(this).click(function() {
		$(this).parent().parent().removeClass('selected');
		$('body').removeClass('no-scroll');
	});
});

