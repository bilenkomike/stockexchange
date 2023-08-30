function messageAddImage () {
	if ( $('#chat').attr('data-chat__id') != '' ){
		$(".chat").on('dragenter', function (e){
		e.preventDefault();
		$(this).css('opacity', .5);
	});


	$('.chat').on('dragleave', function (e) {
		$(this).css('opacity',1);
	});

	$('.chat').on('dragover', function(e) {
		e.preventDefault();
	});

	$('.chat').on('drop', function(e) {
		e.preventDefault();
		$(this).css('opacity',1);
		if ($('.mess__img').length == 1) {
			$('#much__photos').click();
		}
		else {
		var formimage = new FormData();
		var image = e.originalEvent.dataTransfer.files;


		formimage.append('imageloadforpost', image[0]);
		$.ajax({
			type: "POST",
			url: 'home/messanger/',
			data: formimage,
			contentType: false,
			cache: false,
			processData: false,
			success: function(result) {
				console.log(result);
				json = jQuery.parseJSON(result);
				console.log(json);
				$('#messanger__imgload').append('<div class="mess__img"><span class="mess__img__cross"><i class="far fa-times-circle"></i></span><img src="' + json.src + '" style="width: 100px; height: 100px; margin: 7px;" hspace="15" alt=""></div>');
				$('#messge__form').append('<input type="hidden" name="imgpath" value="' + json.src +  '"> ');
				$('.mess__img__cross').each(function() {
					$(this).click(function() {
						src = $(this).parent().children('img').attr('src');
						$('#messge__form').children('input').each(function() {
							if($(this).val() == src) {
								$(this).remove();
							}
						});
						$(this).parent().remove();
					});
				});
			},
		});
	}
		
	});
}
}



function addMessage(message, json) {
	if(message.message.type == "0") {
		format_date =  new Date(message.message.time);
		formated_date = format_date.getHours() + ':' + format_date.getMinutes();
		if ( message.self == true ) {
			$('#chat').append('<li class="chat__item chat__item--self"><div class="message"><div class="message__author">' + message.user.username + '</div><div class="message__content">' + message.message.message + '</div><ul class="message__actions self"><li class="message__action">'+formated_date+'</li><li class="message__action"><i class="fas fa-check-double"></i></li></ul></div><span class="message__triangle self"></span><img class="message__ava" src="' + message.user.ava + '" alt=""></li>');
		}
		else {
			$('#chat').append('<li class="chat__item"><img class="message__ava" src="' + message.user.ava + '" alt=""><span class="message__triangle"></span><div class="message"><div class="message__author">' + message.user.username +'</div><div class="message__content">' + message.message.message +'</div><ul class="message__actions"><li class="message__action">' + formated_date + '</li><li class="message__action"><i class="fas fa-check-double"></i></li></ul></div></li>');
		}
	}
	else if ( message.message.type == "1" ) {
		format_date =  new Date(message.message.time);
		formated_date = format_date.getHours() + ':' + format_date.getMinutes();
		
		if ( message.self == true ) {
			$('#chat').append('<li class="chat__item chat__item--self"><div class="message"><div class="message__author">' + message.user.username + '</div><div class="message__content"> <img src="'+message.message.image + '" alt=""> ' + message.message.message + '</div><ul class="message__actions self"><li class="message__action">'+formated_date+'</li><li class="message__action"><i class="fas fa-check-double"></i></li></ul></div><span class="message__triangle self"></span><img class="message__ava" src="' + message.user.ava + '" alt=""></li>');
		}
		else {
			$('#chat').append('<li class="chat__item"><img class="message__ava" src="' + message.user.ava + '" alt=""><span class="message__triangle"></span><div class="message"><div class="message__author">' + message.user.username +'</div><div class="message__content"><img src="'+ message.message.image + '" alt=""> ' + message.message.message +'</div><ul class="message__actions"><li class="message__action">'+formated_date+'</li><li class="message__action"><i class="fas fa-check-double"></i></li></ul></div></li>');

		}
	}
	openimage();
}


function openimage( ) {
	$('.message__content').each( function() {
		if( $(this).children('img').length > 0 ) { 
		$(this).children('img').each( function() {
			$(this).click(function() {
				$('#show__image').click();
				$('#storyImage').attr('src', $(this).attr('src'));
			});
		} );
		}
	} );
} 



function messages() {


$('.mess__list__item').each(function() {
	$(this).click(function() {
		if ($(window).width() < 770)  {
			$('.mess__aside').addClass('remove__side');
		}
		
		$.post('home/messanger/', {
				hash:$(this).attr('data-chat')
			}, function(data, status) {
				$('#chat').html('');
				json = jQuery.parseJSON(data);
				$('#messanger__header').css('display','flex');
				$('#messanger__header__content').css('display','flex');
				$('#messge__form').removeAttr('style');
				$('.messanger__header__ava').attr('src', '../app/custmfolders/'+json.user.dir_url + '/' + json.user.ava);
				$('.messanger__header__name').html(json.user.fullname);
				$('#chat__user__activity').attr('checkactivity-id', json.user.id);
				if(json.user.activity != 0) {
					$('#chat__user__activity').addClass('active');
				}
				else {
					$('#chat__user__activity').removeClass('active');
				}
				$('.chat').animate({scrollTop:0}, '0');
				$('#chat').attr('data-chat__id', json.status);
				var messages = json.message;
				if(messages != null) {
					for(let i = 0; i < messages.length; i++) {
						addMessage(messages[i], json);
						openimage();
					}
					setTimeout(function() {
						$('.chat').animate({scrollTop:$('.lorem').offset().top}, '100');
					},150);
				}
				$('#message').removeAttr('disabled');
				$('#send__message__btn').removeAttr('disabled');

				messageAddImage();
			}
		);
	});
});
}
messages();

$(document).on('keypress',function(e) {
    if(e.which == 13) {
        $('#send__message__btn').click();
    }
});


$('#messge__form').submit(function(event) {
	event.preventDefault();
	// console.log($('#message').());
	if( $.trim($('#message').val()) != '' ||  $('[name="imgpath"]').length > 0 ){
		$.post('home/messanger/', {message:$('#message').val(), chat_id:$('#chat').attr('data-chat__id'), message__image : $('[name="imgpath"]').val()}, function(status,data) {
			json = jQuery.parseJSON(status);
			message = json.message;
			format_date =  new Date(message.message.time);
			formated_date = format_date.getHours() + ':' + format_date.getMinutes();
			if(message.message.type == "0") {
				$('#chat').append('<li class="chat__item chat__item--self"><div class="message"><div class="message__author">'+ message.user.username + '</div><div class="message__content">' + message.message.message +'</div><ul class="message__actions self"><li class="message__action">' + formated_date + '</li><li class="message__action"><i class="fas fa-check-double"></i></li></ul></div><span class="message__triangle self"></span><img class="message__ava" src="' + message.user.ava + '" alt=""></li>');
			}
			else if(message.message.type == "1") {
				$('#chat').append('<li class="chat__item chat__item--self"><div class="message"><div class="message__author">'+ message.user.username + '</div><div class="message__content">' + '<img src="' + message.message.image + '" alt="">' + message.message.message +'</div><ul class="message__actions self"><li class="message__action">' + formated_date + '</li><li class="message__action"><i class="fas fa-check-double"></i></li></ul></div><span class="message__triangle self"></span><img class="message__ava" src="' + message.user.ava + '" alt=""></li>');
			}
			$('#message').val('');
			$('.mess__img__cross').click();

			setTimeout(function() {
				$('.chat').animate({scrollTop:$('.lorem').offset().top}, '100');
			},500);
			
			messageAddImage();
			openimage();
		});
	}
});

function mess__list__items () {

$('.mess__list__item').each(function() {
	$(this).on('click',function () {
		var message__get__interval = setInterval(function() {
			$.post('home/messanger/', {chat__url:$('#chat').attr('data-chat__id')}, function(data,status) {
				json = jQuery.parseJSON(data);
				if(json.message.length > 0) {
					messages = json.message;

					for ( let i = 0; i < messages.length; i++ ) {
						addMessage(messages[i], json);
						$('.chat').animate({scrollTop:$('.lorem').offset().top}, '100');

					}
				}
			});

			if ($(window).width() > 770) {
		$('.mess__list__item').each(function() {
			$(this).click(function() {
				clearInterval(message__get__interval);
			});
		});
	}
			$('.messanger__header__arrow__back').click(function() {
				$('.mess__aside').removeClass('remove__side');
				clearInterval(message__get__interval);
			});

			if($(window).width() < 770) {
				$(window).on('touchend', function() {
					if( !$('.mess__aside').hasClass('remove__side') ) {
						clearInterval(message__get__interval);
					}
				});
			}
			
			
		},1000);
	});
	openimage();
	messageAddImage();


	


});

$('.mess__list__item').each(function() {
	$(this).click(function() {
		if($(window).width() < 770) {

			var clicking = false;
			$(document).on('touchstart',function(e){
				if( $('#mess__aside').hasClass('remove__side') ) {
					clicking = true;
			    var down = e.touches[0].clientX;

			    $(document).on('touchmove',function(event){
			    if(clicking == false) return;
			    
			    if ( event.touches[0].clientX > down + 300 ) {
			    	clicking = false;
			    	$('#mess__aside').removeClass('remove__side');
			    }

				});
			}
			});
			$(document).on('touchend',function(){
				clicking = false;
			});
		}
	
	});
});

}


function deletechatHistory() {
	$('.delete__chat').each(function() {
		$(this).click(function(event) {
			event.stopPropagation();
			$.post('home/messanger/',{clearMessageHistory:$(this).parent().parent().attr('data-chat') },function(result) {
				json = jQuery.parseJSON(result);
				if($('#chat').attr('data-chat__id') == json.message) {
					$('.chat__item').each(function() {
						$(this).remove();
					});
				}
			});

		});
	});
}
deletechatHistory();


mess__list__items();




$('#messanger__searh').keyup(function() {
	var search;
	if ( $(this).val().length > 0 ) {
		search = $(this).val();
	} 
	else {
		search = 'all';
	}

	$.post('home/messanger/', {messanger__searh:search}, function(result) {
		json = jQuery.parseJSON(result);	

		if (json.message.length > 0) {
				$('.mess__list').html(' ');
				for(let i = 0; i < json.message.length; i++) {
					console.log(json.message[i].last_record);
					$('.mess__list').append('<li class="mess__list__item" data-chat="'+json.message[i].hash.hash+'"><div class="mess__list__item__user"><img src="'+ json.message[i].user.ava +'" class="mess__list__item__ava" alt=""><ul class="mess__list__item__info"><li class="mess__list__item__info__item">'+ json.message[i].user.fullname +'</li><li class="mess__list__item__info__item">...</li></ul></div><ul class="mess__list__item__info"><li class="mess__list__item__info__item op-5"><div class="user__ativity" data-checkactivity="" checkactivity-id="'+ json.message[i].user.id +'"></div></li><li class="mess__list__item__info__item delete__chat"><i class="fas fa-trash-alt" aria-hidden="true"></i></li></ul></li>');

				}
			} 
			mess__list__items();
			messages();
			deletechatHistory();
	}); 
});


$('.message__search__clear').click(function() {
	if( $('#messanger__searh').val().length > 0 ) {
		$('#messanger__searh').val('');
		$.post('home/messanger/', {messanger__searh:'all'}, function(result) {

			json = jQuery.parseJSON(result);	
			if (json.message.length > 0) {
				$('.mess__list').html(' ');
				for(let i = 0; i < json.message.length; i++) {
					$('.mess__list').append('<li class="mess__list__item" data-chat="'+json.message[i].hash.hash+'"><div class="mess__list__item__user"><img src="'+ json.message[i].user.ava +'" class="mess__list__item__ava" alt=""><ul class="mess__list__item__info"><li class="mess__list__item__info__item">'+ json.message[i].user.fullname +'</li><li class="mess__list__item__info__item">...</li></ul></div><ul class="mess__list__item__info"><li class="mess__list__item__info__item op-5"><div class="user__ativity" data-checkactivity="" checkactivity-id="'+ json.message[i].user.id +'"></div></li><li class="mess__list__item__info__item delete__chat"><i class="fas fa-trash-alt" aria-hidden="true"></i></li></ul></li>');
				}
			} 			
			mess__list__items();
			messages();
			deletechatHistory();
		});
	}
	 
});

$('[modal-call="content-append-image-to-messanger"]').click(function() {
	$.get('home/getContentFiles/', (result) => {
		json = jQuery.parseJSON(result);
		images = json.message;
		$('#message__images__content').html('');
		images.map((image) => {
			
			$('#message__images__content').append(`
				<div class="select__images__item">
					<div style="background-image: url(${image.path});" class="select__image__block"></div>
					<input id="${image.name}" value="${image.path}" name="append_to_content_image_to_messages" type="checkbox">
					<label class="input__select__image" for="${image.name}" select__image="">
						<span class="selected__image" data-image-src="${image.path}"></span>
					</label>
				</div>


				`);



		});
		setTimeout(selectImage, 200);		
	});
	
});


function selectImage() {
	$('.select__images__item').each(function() {
		$(this).click(function() {
			$(this).children('.input__select__image')[0].click();
		});
	});
	$('.input__select__image').each(function() {
		$(this).click(function() {
			$('.selected__image').each(function() {
				$(this).removeClass('active');
			});

			$(this).children('.selected__image').addClass('active');
		});
	});
}


$('#submit__form__append__image__message').click(function(e) {
	e.preventDefault();
	if ($('.mess__img').length == 1) {
			$('#much__photos').click();
		}
		else {
	let src_image = $('.selected__image.active').attr('data-image-src');	


	$('#messanger__imgload').append('<div class="mess__img"><span class="mess__img__cross"><i class="far fa-times-circle"></i></span><img src="' + src_image + '" style="width: 100px; height: 100px; margin: 7px;" hspace="15" alt=""></div>');
	$('#messge__form').append('<input type="hidden" name="imgpath" value="' + src_image +  '"> ');
	$('[data-id="modal__close"]').click();
	$('.mess__img__cross').each(function() {
		$(this).click(function() {
			src = $(this).parent().children('img').attr('src');
			$('#messge__form').children('input').each(function() {
				if($(this).val() == src) {
					$(this).remove();
				}
			});
			$(this).parent().remove();
		});
	});
	}
});

