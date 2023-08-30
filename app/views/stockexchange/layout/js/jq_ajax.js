localStorage.setItem('mail_img_path','');
localStorage.setItem('mail_img_width','');
localStorage.setItem('mail_img_height','');
$(document).ready(function() {
	if( $('.mess__aside').length > 0 ) {
		if ($('.mess__img').length == 1) {
			$('#much__photos').click();
		}
		else {
		$('#load__image__form').submit(function(event) {
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
				json = jQuery.parseJSON(result);
				if( $('#load__image__form').attr('action') == 'home/messanger/' ) {
					$('#messge__form').append('<input type="hidden" name="imgpath" value="' + json.src +  '"> ');
					$('#messanger__imgload').append('<div class="mess__img"><span class="mess__img__cross"><i class="far fa-times-circle"></i></span><img src="' + json.src + '" style="width: 100px; height: 100px; margin: 7px;" hspace="15" alt=""></div>');
					$('.mess__img__cross').each(function() {
						$(this).click(function() {
							src = $(this).parent().children('img').attr('src');
							$('#messge__form').children('input').each(function() {
								console.log($(this).val());
								if($(this).val() == src) {
									$(this).remove();
								}
							});
							$(this).parent().remove();
						});
					});
				}
				$('.modal').each(function() {
					$(this).removeClass('selected');
					$('body').removeClass('no-scroll');
				});
				$('[model="fileload"]')[0].reset();
			},
		});
		});
		}
	} 
	else {
		$('#load__image__form').submit(function(event) {
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
				json = jQuery.parseJSON(result);
				localStorage.setItem('mail_img_path',json.src);
				localStorage.setItem('mail_img_width',json.width);
				localStorage.setItem('mail_img_height',json.height);
				$('.modal').each(function() {
					$(this).removeClass('selected');
					$('body').removeClass('no-scroll');
				});
				$('[model="fileload"]')[0].reset();
			},
		});
	});
	}
	
});
$(document).ready(function() {
	$('#second__load__image__form').submit(function(event) {
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
				console.log(result);
				json = jQuery.parseJSON(result);
				console.log(json);
				localStorage.setItem('mail_img_path',json.src);
				localStorage.setItem('mail_img_width',json.width);
				localStorage.setItem('mail_img_height',json.height);
				$('.modal').each(function() {
					$(this).removeClass('selected');
					$('body').removeClass('no-scroll');
				});
				$('[model="fileload"]')[0].reset();
			},
		});
	});
});
