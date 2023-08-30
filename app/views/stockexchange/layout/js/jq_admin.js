$('.admin__content').each( function () {
	$(this).css('display', 'none');
} );

$('.admin__content').first().each(function() {
	$(this).css('display', 'block');
});

$('.admin__nav__btn').each( function() {
	$(this).click( function() {
		$('.admin__nav__btn').each(function() {
			$(this).removeClass('active');
		});
		$(this).addClass('active');

		$('.admin__content').each( function () {
			$(this).css('display', 'none');
		} );
		$('#works-all').click();
		$('[data-page__open="' + $(this).attr('data-page') + '"]').css('display', 'block');
	} );
} );

// $('[data-page="4"]').click();

if ( localStorage.getItem('page') == '' ) {
	localStorage.setItem('page', '');
} 

// redirect from loading
$('[data-page="5"]').click();
// hook
 
// 

if (localStorage.getItem('page') != '') {
	$('.admin__nav__btn').each(function() {
			$(this).removeClass('active');
	});
	$('[data-page="' + localStorage.getItem('page') + '"]').addClass('active');
	$('[data-page="' + localStorage.getItem('page') + '"]').click();
	if( localStorage.getItem('page') == 3 ) {
		setTimeout(function() {
			$('#posts-request').click();
		}, 100);
		
	}
	else if ( localStorage.getItem('page') == 2 ) {
		setTimeout(function() {
			$('#works-request').click();
		}, 100);
	}
	else if (localStorage.getItem('page') == '2_1') {
	    $('[data-page="2"]').addClass('active');
	    $('[data-page="2"]').click();
	}
	else if (localStorage.getItem('page') == '3_1') {
	    $('[data-page="3"]').addClass('active');
	    $('[data-page="3"]').click();
	}
	localStorage.setItem('page','');

}

$('#add__story').click(function() {
	window.location.href = 'home/admin/';
	localStorage.setItem('page','3');
});

$('#look_fllowers2').click(function() {
	window.location.href = 'home/admin/';
	localStorage.setItem('page','1');
});

$('#look_fllowers1').click(function() {
	window.location.href = 'home/admin/';
	localStorage.setItem('page','1');
});

$('#profile__edit').click(function() {
	window.location.href = 'home/admin/';
	localStorage.setItem('page','5');
});

$('#addWork__link').click(function(event) {
	console.log('yes');
	event.preventDefault();
	window.location.href = 'home/admin/';
	localStorage.setItem('page','2');
});


const friendsBreadcrumbs = $('.friends__breadcrumb');

friendsBreadcrumbs.each(function() {
	$(this).click(function () {
		friendsBreadcrumbs.each(function() {
			$(this).removeClass('active');
		});
		$('.friends').each(function () {
			$(this).removeClass('active');
		});

		$('.friends[data-id="' + $(this).attr('id') + '"]').addClass('active');
		$(this).addClass('active');
	});
});

const worksBreadcrumbs = $('.works__breadcrumb');

worksBreadcrumbs.each(function() {
	$(this).click(function () {
		$('#workForm')[0].reset("");
		$('#imgWork').attr('src', 'http://placehold.it/380x550');
		$('.lookwork').each(function() {
			$(this).remove();
		});
		$('[name=work__content]').text('');
		$('#richTextField').contents().find('body').html('');
		$('.workTags').html(' ');
		$('#worktags').val('');
		$('.workChackboxTick').each(function() {
			$(this).css('display','none');
		});
		$('#workSubmit').text('Add work');


		worksBreadcrumbs.each(function() {
			$(this).removeClass('active');
		});
		$('.workss').each(function () {
			$(this).removeClass('active');
		});

		$('.workss[data-id="' + $(this).attr('id') + '"]').addClass('active');
		$(this).addClass('active');
	});
});



$('#workSubmit').click(function() {
    localStorage.setItem('page','2_1');
});

var friendsActions = $('[fr-actionable]');
// console.log(friendsActions);

friendsActions.each(function() {
	$(this).click(function(e) {
		e.preventDefault();

		if( $(this).attr('data-action') == 'remove' )  {

			var id = $(this).attr('data-request');

			friend = $(this).parent().parent().parent();
			$.post('home/admin/', {removeFriend:id}, function(data,status) {
				json = jQuery.parseJSON(data);
				console.log(json);
				friend.remove();
			});

		}
		else if ( $(this).attr('data-action') == 'accept' ) {
			var id = $(this).attr('data-request');

			let friend = $(this).parent().parent().parent().parent();

			$(this).parent().parent().parent().parent().remove();
			console.debug(friend.children());

			$.post('home/admin/', {acceptFriend:id}, function(data) {
				json = jQuery.parseJSON(data);
				console.log(json);
				// friend.remove();
			});
		}
		else if ( $(this).attr('data-action') == 'decline' ) {
			var id = $(this).attr('data-request');

			let friend = $(this).parent().parent().parent().parent();
			// console.log(friend);
			$(this).parent().parent().parent().parent().remove();
			// console.debug(friend.children());
			// $('[data-id="fr-all"]').append(friend);

			$.post('home/admin/', {declineFriend:id}, function(data) {
				json = jQuery.parseJSON(data);
				console.log(json);
				// friend.remove();
			});
		}
		else if ( $(this).attr('data-action') == 'send' ) {
			var id = $(this).attr('data-request');

			let friend = $(this).parent().parent().parent().parent();
			// console.log(friend);
			$(this).parent().parent().parent().parent().remove();
			// console.debug(friend.children());
			// $('[data-id="fr-all"]').append(friend);

			$.post('home/admin/', {sendFriendrequest:id}, function(data) {
				json = jQuery.parseJSON(data);
				console.log(json);
				// friend.remove();
			});
		}
	});
	
});







$('#workImage').change(function(event) {
	$('#imgWork').attr('src', URL.createObjectURL(event.target.files[0]));
});


$('#btn--loadavater').change(function(event) {
	$('.avatar').each(function() {
		$($(this)).attr('src', URL.createObjectURL(event.target.files[0]));

	});
});


$('#btn--loadpreview').change(function(event) {
	$('.sidebar__header__image').each(function() {
		$($(this)).attr('src', URL.createObjectURL(event.target.files[0]));

	});
});



const workActions = $('[wrk-actionabe]');

workActions.each(function() {
	$(this).click(function() {
		let action = $(this).attr('data-action');
		var idw = $(this).attr('data-wrkid');
		var work = $(this).parent().parent().parent();
		switch (action) {
			case 'remove':
				// console.log(idw);
				$.post( 'home/admin/',{workRemoveId:idw} , function(data) {
					console.log(data);
					work.remove();
				});
			break;
			case 'edit':
				$('#works-request').click();
				$.post( 'home/admin/',{workEditId:idw, editWork:true} , function(data) {
					console.log(idw);

					$('[name="editWork"]').val(idw);
					workData = jQuery.parseJSON(data).message;
					console.log(workData);
					$('[name="workName"]').val(workData.title);
					$('[name="workCategory"]').val(workData.category);
					$('[name="workTag"]').val(workData.tags);
					$('[name="WorkDesc"]').val(workData.prev_text);
					$('#imgWork').attr('src', '../app/custmfolders/' + workData.dir + '/' + workData.image);
					$('[name=work__content]').text(workData.full_content);

					// tinymce.activeEditor.setContent(workData.full_content);
					$('#richTextField').contents().find('body').html(workData.full_content);
					if(workData.site == 1) {
						$('[name="workLink"]').val(workData.link);
						site = 'url';
						download = '';
					}
					else if(workData.site == 0) {
						site = 'file';
						download = 'download="'+ workData.link + '"';

					}

					for ( let i = 0; i < workData.tags.length; i ++) {
						$('#worktags').val($('#worktags').val() + '/' + workData.tags[i]);
						$('.workTags').append('<li class="workTags__item" id="' + workData.tags[i] + '">#' + workData.tags[i] + '<i class="fas fa-times"></i></li>');
					}
					$('.workTags__item').each(function() {
						$(this).click(function() {
							$('#worktags').val($('#worktags').val().replace('/' + $(this).attr('id'),''));
							$(this).remove();
						});
					});

					if($('.lookwork').length > 0) {
						$('.lookwork').each(function() {
							$(this).remove();
						});
					}
					$('#workSubmit').text('Save work');
					$('.work__choose__file').append('<div class="work__choose__file__item lookwork" style="margin: 10px auto;"><a target="_blank" href="' + workData.link + '"  ' + download + ' class="btn btn--mnsd btn--mnsd--red">look for work <i class="fas fa-hand-point-down"></i></a></div>');

					$('.Workradio[value="' + site + '"]').click();
				});
			break;
		}
	});
});

function setFocusOnPostIframe() {
	console.log('yes');
	console.log();
	$('#richTextField2').contents().find('body').focus();
	$('#richTextField2').contents().find('body').focus();
}

$('#posts-request').click(function() {

	setTimeout( setFocusOnPostIframe, 200);
});


function setFocusOnWordIframe() {
	$('#richTextField').contents().find('body').focus();
}
$('#works-request').click(function() {
	setTimeout( setFocusOnWordIframe, 200);
});




// $('#workTags').click(function() {
// 	console.log('clicked');
// });

$("#inputforWorkTags").on('input', function(e){
    var selected = $(this).val();
    $('[workoptions]').each(function() {
    	if( selected == $(this).val() ) {
    		if(!$('#worktags').val().includes('/' + selected)) {
    			$('.workTags').append('<li class="workTags__item" id="' + $(this).val() + '">#' + $(this).val() + '<i class="fas fa-times"></i></li>');
    			$('#worktags').val($('#worktags').val() + '/' + $('#inputforWorkTags').val());
    			
    		}
    		$('#inputforWorkTags').val('');
    	}
    	
    });
    $('.workTags__item').each(function() {
		$(this).click(function() {
			$('#worktags').val($('#worktags').val().replace('/' + $(this).attr('id'),''));
			$(this).remove();
		});
	});
    
});




$('.Workradio').each(function() {
	$(this).click(function () {
		if($(this).is(':checked')) {
			$('.workChackboxTick').each(function() {
				$(this).css('display', 'none');
			});
			$('[for="' + $(this).attr('id') + '"]').children().css('display','block');
		}
	});
	
});




$('.posts__breadcrumb').each(function() {
	$(this).click(function() {
		$('#postForm')[0].reset('');
		$('[name="posttags"]').val('');
		$('#richTextField2').contents().find('body').html('');
		$('.postTags').html('');
		$('#imgPost').attr('src', 'http://placehold.it/175x200');
		$('.posts__breadcrumb').each(function() {
			$(this).removeClass('active');
		});
		$('.posts').each(function() {
			$(this).removeClass('active');
		});
		$('[data-id="' + $(this).attr('id') + '"]').addClass('active');
		$(this).addClass('active');
	});
});



$('#postSubmit').click(function() {
    localStorage.setItem('page','3_1');
});


$('.post').each(function() {
	$(this).click(function () {
		window.location.href = "home/post/" + $(this).attr('data-id') + "/" ;
	});
});






const postActions = $('[pst-actionabe]');

postActions.each(function() {
	$(this).click(function(e) {
		e.stopPropagation();
		post = $(this).parent().parent().parent();
		action = $(this).attr('data-action');
		id = $(this).attr('data-pstid');

		switch (action) {
			case 'remove':
				$.post('home/admin/', {removePost:id}, function(result) {
					console.log(result);
					post.remove();
				});
			break;
			case 'edit':
				$.post('home/admin/', {editpost:id}, function(result) {

					postData = jQuery.parseJSON(result).message;
					$('#posts-request').click();
					$('#imgPost').attr('src', '../app/custmfolders/posts/' + postData.image_path);
					$('[name="postName"]').val(postData.title);
					$('[name="editPost"]').val(postData.id);
					for ( let i = 0; i < postData.tags.length; i ++) {
						$('#posttags').val($('#posttags').val() + '/' + postData.tags[i]);
						$('.postTags').append('<li class="postTags__item" id="' + postData.tags[i] + '">#' + postData.tags[i] + '<i class="fas fa-times"></i></li>');
					}
					$('.postTags__item').each(function() {
						$(this).click(function() {
							$('#posttags').val($('#posttags').val().replace('/' + $(this).attr('id'),''));
							$(this).remove();
						});
					});
					$('#post__content').text(postData.content);
					$('#richTextField2').contents().find('body').html(postData.content);
					
					$('#postSubmit').text('Save post');
				}); 
			break;
		}
	});
});




$('#postImage').on('change',function(event) {
	$('#imgPost').attr('src', URL.createObjectURL(event.target.files[0]));
});


$("#inputforPostTags").on('input', function(e){
    var selected = $(this).val();
    $('[postoptions]').each(function() {
    	if( selected == $(this).val() ) {
    		if(!$('#posttags').val().includes('/' + selected)) {
    			$('.postTags').append('<li class="postTags__item" id="' + $(this).val() + '">#' + $(this).val() + '<i class="fas fa-times"></i></li>');
    			$('#posttags').val($('#posttags').val() + '/' + $('#inputforPostTags').val());
    			
    		}
    		$('#inputforPostTags').val('');
    	}
    	
    });
    $('.postTags__item').each(function() {
		$(this).click(function() {
			$('#posttags').val($('#posttags').val().replace('/' + $(this).attr('id'),''));
			$(this).remove();
		});
	});
    
});


$('#postSubmit').click(function(event) {

	event.preventDefault();
	if( $(`[name=postName]`).val() != '' && $('#imgPost').attr('src') != 'http://placehold.it/175x200' && $('#posttags').val() != '' && $('#post__content').text() != '') {
		$('#postForm').submit();
	}
	else {
		$('[data-modal=modal--errors]').addClass('selected');
		$('.error').each(function() {
			$(this).hide();
		});
		$(`[name="post_submit_error"]`).show();
	}
});

$('#workSubmit').click(function(event) {

	event.preventDefault();
	if( $(`[name=workName]`).val() != '' && $('#imgWork').attr('src') != 'http://placehold.it/380x550' && $('[name=workCategory]').val() != '' && $('#worktags').val() != '' && $('#work__content').text() != ''  && $('[name=WorkDesc]').val() != '') {
		var check = false;
		$('.workChackboxTick').each(function () {
			if ( $(this).attr('style') == 'display: block;' ) {
				// check = true;
				if( $(`#${$(this).parent().attr('for')}`).val() == 'url' ) {
					if( $(`[name=workLink]`).val() != '' ) {
						check = true;
					} 
				}


				if( $(`#${$(this).parent().attr('for')}`).val() == 'file' ) {
					if( $(`#workZip`).val() != '' ) {
						check = true;
					} 
				}
			}
		}); 

		
		if(check == true ) {
			$('#workForm').submit();
		}
		else {
			$('[data-modal=modal--errors]').addClass('selected');
			$('.error').each(function() {
				$(this).hide();
			});
			$(`[name="work_submit_error"]`).show();
		}
	}
	else {
		$('[data-modal=modal--errors]').addClass('selected');
		$('.error').each(function() {
			$(this).hide();
		});
		$(`[name="work_submit_error"]`).show();
	}
});



$('[data-copy-image-link]').each(function() {
	$(this).click(function() {
		let copyText = $(this).parent().children('[data-copy]');
		copyText.select();
	 	document.execCommand("copy");	
	});
	
});




$('#imageloadformmanager').submit(function(e) {
	e.preventDefault();
	let data = new FormData(this);

	
	$.ajax({
		type: 'POST',
		url: 'home/loadFiles/',
		data: data,
		contentType: false,
		cache: false,
		processData: false,
		success: function(result) {

			json = jQuery.parseJSON(result);

			if(json.status != 'error') {
				$('.file__list__spliter').each(function() {
				if($(this).hasClass('today')) {
				
					images = json.message;
					for ( let i = 0; i < images.length; i++ ) {
						var css_class = 'file';

						if( $(this).next().hasClass('file') ) {
							if( !$(this).next().hasClass('next') ) {
								css_class += ' next';

							}
							path = images[i].path;
							name = images[i].name;
							$(this).append('<li class="' + css_class + '"><div class="file__content"><i class="fas fa-image" aria-hidden="true"></i><img src="'+ path +'" style="width: 1.5rem;" alt=""> ' + name + '  </div> <div class="file__actions"> <textarea id="' + path + '" style="height: 0; border:0; background-color: transparent; resize: none; overflow: hidden; line-height: 0; font-size: 0;">'+ path +'</textarea> <i class="fas fa-copy" copy="" data-copy="' + path + '" aria-hidden="true"></i> </div></li>');

							setTimeout(copyText, 100);
							setTimeout(showImage, 100);
						}	
					}
					
				}
				else {
					images = json.message;
					for ( let i = 0; i < images.length; i++ ) {
						var css_class = 'file';

						if( $(this).next().hasClass('file') ) {
							if( !$(this).next().hasClass('next') ) {
								css_class += ' next';

							}
							path = images[i].path;
							name = images[i].name;
							$(this).append('<li class="' + css_class + '"><div class="file__content"><i class="fas fa-image" aria-hidden="true"></i><img src="'+ path +'" style="width: 1.5rem;" alt=""> ' + name + '  </div> <div class="file__actions"> <textarea id="' + path + '" style="height: 0; border:0; background-color: transparent; resize: none; overflow: hidden; line-height: 0; font-size: 0;">'+ path +'</textarea> <i class="fas fa-copy" copy="" data-copy="' + path + '" aria-hidden="true"></i> </div></li>');

							setTimeout(copyText, 100);
							setTimeout(showImage, 100);
						}	
					}
				}
				});
			}
			else {
				$('#file__manager__error__modal').click();
			}
			
		},
	});
	

});



function showImage() {
	$('.file').each( function() {
	$(this).click(function() {
		$('#show__image').click();
		var src = $(this).children('.file__actions').children('textarea').text();
		$('#storyImage').attr('src', src);
	});
} );
} 

showImage();

$('[copy]').click(function(e) {
	e.stopPropagation();
});


function chooseImage() {
	
	$('.select__image__block').each(function() {
		$(this).click(function() {
			$(this).parent().children('[select__image]').click();
		});
	});

	$('[select__image]').each(function () {

		$(this).click(function(e) {
			e.stopPropagation();
			$(this).children('span').toggleClass('active');

			var image_input = $('[data-text="' + $(this).attr('for') + '"]');	
		});
	});

}
