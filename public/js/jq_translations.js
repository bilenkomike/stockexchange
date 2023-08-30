const langs = $('.lang');
// const tranlsation_items = $('[translate]');

$(document).ready(function() {
	$.post('home/translate/', {lang:'all'}, function(data,status) {

		json = jQuery.parseJSON(data);


		lang  = json.lang;

		translations = json.translations;

		for( let i = 0; i < translations.length; i ++ ) {
			tran__text = jQuery.parseJSON(translations[i].translation)[lang];

			slug = translations[i].slug; 
			if($('[translation_slug="' + slug + '"]').is('[translation_input]')) {
				$('[translation_slug="' + slug + '"]').attr('placeholder',tran__text);
			}
			else {
				$('[translation_slug="' + slug + '"]').html(tran__text);
			}
			
		}
	});
});

const mobile__langs = $('.nav__link.languages');
langs.each(function () {
	$(this).click(function() {

		mobile__langs.each(function() {
			$(this).removeClass('active');
		});

		lang_slug = $(this).children().attr('data-lang');
		$('#lang__selector').html($(this).children().html());
		$(this).children().addClass('active');
		$.post('home/translate/',{lang: lang_slug}, function (data,status) {
			json = jQuery.parseJSON(data);
			
			lang  = json.lang;
			translations = json.translations;

			for( let i = 0; i < translations.length; i ++ ) {
				tran__text = jQuery.parseJSON(translations[i].translation)[lang];

				slug = translations[i].slug; 
				if($('[translation_slug="' + slug + '"]').is('[translation_input]')) {
					$('[translation_slug="' + slug + '"]').attr('placeholder',tran__text);
				}
				else {
					$('[translation_slug="' + slug + '"]').html(tran__text);
				}
				
			}
		});
	});
});