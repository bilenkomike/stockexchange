if(!window.location.href.includes('home/person') ) {
$('.category__filter__item').each(function() {
	$(this).click(function() {
		// var = 'filter';

		if($(this).hasClass('active')) {
			$(this).removeClass('active');
			

		}
		else {
			$('[filter_by="' + $(this).attr('filter_by') + '"]').each(function() {
				$(this).removeClass('active');
			});
			$(this).addClass('active');
		}

		filter__items = {};
		$('.category__filter__item.active').each(function() {
			// console.log($(this).attr('filter_by'));
			if ( $(this).attr('filter_by') == 'category' ) {
				filter__items['category'] = $(this).attr('filter_id');

			}
			else if ( $(this).attr('filter_by') == 'prof' ) {
				filter__items['prof'] = $(this).attr('filter_id');
			}
		});
		// console.log(JSON.stringify(filter__items));

		if ($('.category__filter__item.active').length == 0  ) {
			filter__items = 'all';
		}
//  filterItem:$(this).attr('filter_item'),
		if(localStorage.getItem('tag') == '') {
		$.post('home/filter/',{filterBy:$(this).attr('filter_by'), filterItem:$(this).attr('filter_item'),filterId:filter__items},function(result) {
			json = jQuery.parseJSON(result);
			// console.log(json);

			// if(json.result != null) {
				if( json.what == 'works' ) {
					if ( json.result != null ) {
						$('.works').html(' ');
						works = json.result;
						for ( let i = 0 ; i < works.length; i++ ) {
							var work_tags = '';
							// console.log(works[i]);
							for ( let j = 0 ; j < works[i].tag.length; j++ ) {
								work_tags += ' <li class="work__tag">'+ works[i].tag[j] +'</li>';
							}
							$('.works').append('<div class="work"><div class="work__image" style="background-image: url(../app/custmfolders/'+ works[i].user_dir +'/' + works[i].image + ');"></div><div class="work__content"><div class="work__author"><img src="'+ works[i].user.ava +'" class="work__author__ava" alt=""><ul class="work__author__info"><li class="work__author__info__item">'+ works[i].user.fullname +'</li><li class="work__author__info__item prof">'+ works[i].user.category +'</li></ul></div><h1 class="work__title">' + works[i].title + '</h1><div class="work__category"> <span translation_slug="category">Category</span>: ' + works[i].category + '</div><div class="work__text">'+ works[i].prev_text +'</div><ul class="work__tags">' + work_tags + '</ul><div class="work__edit"><div class="work__edit__item"><i class="fas fa-thumbs-up" style="margin-right: 3px;" aria-hidden="true"></i>'+ works[i].likes +'</div><div class="work__edit__item"><i class="fas fa-thumbs-down" style="margin-right: 3px;" aria-hidden="true"></i>' + works[i].dislikes + '</div><div class="work__edit__item"><i class="fas fa-eye" style="margin-right: 3px;" aria-hidden="true"></i>'+ works[i].views +'</div></div><a class="work__link" href="home/work/' + works[i].id + '/"><span translation_slug="look_work">Look work</span> ⟩</a></div></div>');
							$('.pagination').css('display','none');
						}
					}
					else {
						$('.works').html(' ');
					}

					setTimeout(changeLang,150);

					


				}
				else if ( json.what == 'users' ) {
					// console.log(json.result);
					if(json.result != null) {
					$('.users__table').html(' ');
						for(let i = 0; i < json.result.length; i++) {
							user = json.result[i];
							if ( user.ava == null ) {
								ava = 'images/icons/user.png';
							}
							else {
								ava = '../app/custmfolders/' + user.dir_url + '/' + user.ava;
							}
							//console.log(user); 
							$('.users__table').append('<li class="users__table__item" data-link="home/person/' + user.id + '/"><a href="home/person/' +user.id+ '/"><img src="' + ava + '" class="users__avatar" alt=""></a><a class="users__name" href="home/person/' + user.id + '/">'+ user.fullname +'</a><div class="users__work__category">' + user.category + '</div><div class="users__prof">' + user.prof + '</div></li>'); 
			            }   
		           	}
		           	else {
		           		$('.users__table').html('');
		           	}
				}
		});
		}
		else {
			if ( filter__items == 'all' ) {
				filter__items = {};
				$('.category__filter__item.active').each(function() {
					if ( $(this).attr('filter_by') == 'category' ) {
						filter__items['category'] = $(this).attr('filter_id');

					}
				});
				filter__items['tag'] =  localStorage.getItem('tag');
				$.post('home/filter/',{filterBy:$(this).attr('filter_by'), filterItem:'works',filterId:filter__items},function(result) {
				json = jQuery.parseJSON(result);
				//console.log(json);

				if(json.result != null) {
				if( json.what == 'works' ) {
				 	if ( json.result != null ) {
						$('.works').html(' ');
						works = json.result;
						for ( let i = 0 ; i < works.length; i++ ) {
							var work_tags = '';
							// console.log(works[i]);
							for ( let j = 0 ; j < works[i].tag.length; j++ ) {
								work_tags += ' <li class="work__tag">'+ works[i].tag[j] +'</li>';
							}
							$('.works').append('<div class="work"><div class="work__image" style="background-image: url(../app/custmfolders/'+ works[i].user_dir +'/' + works[i].image + ');"></div><div class="work__content"><div class="work__author"><img src="'+ works[i].user.ava +'" class="work__author__ava" alt=""><ul class="work__author__info"><li class="work__author__info__item">'+ works[i].user.fullname +'</li><li class="work__author__info__item prof">'+ works[i].user.category +'</li></ul></div><h1 class="work__title">' + works[i].title + '</h1><span translation_slug="category">Category</span>: ' + works[i].category + '<div class="work__text">'+ works[i].prev_text +'</div><ul class="work__tags">' + work_tags + '</ul><div class="work__edit"><div class="work__edit__item"><i class="fas fa-thumbs-up" style="margin-right: 3px;" aria-hidden="true"></i>'+ works[i].likes +'</div><div class="work__edit__item"><i class="fas fa-thumbs-down" style="margin-right: 3px;" aria-hidden="true"></i>' + works[i].dislikes + '</div><div class="work__edit__item"><i class="fas fa-eye" style="margin-right: 3px;" aria-hidden="true"></i>'+ works[i].views +'</div></div><a href="home/work/' + works[i].id + '/" class="work__link"> <span translation_slug="look_work"> Look work </span> ⟩</a></div></div>');
							$('.pagination').css('display','none');
						}
					}
				}
				else {
				 	$('.works').html(' ');
				 	$('.pagination').css('display','flex');
				 	}

				}
				setTimeout(changeLang,100);
				tagsclick();
				checkTags();
			});
			} 
			else if ( filter__items != 'all' ) {
				filter__items = {};
				$('.category__filter__item.active').each(function() {
					if ( $(this).attr('filter_by') == 'category' ) {
						filter__items['category'] = $(this).attr('filter_id');

					}
				});
				filter__items['tag'] =  localStorage.getItem('tag');
				$.post('home/filter/',{filterBy:$(this).attr('filter_by'), filterItem:'works',filterId:filter__items},function(result) {
				json = jQuery.parseJSON(result);
				//console.log(json);

				if(json.result != null) {
				if( json.what == 'works' ) {
				 	if ( json.result != null ) {
						$('.works').html(' ');
						works = json.result;
						for ( let i = 0 ; i < works.length; i++ ) {
							var work_tags = '';
							// console.log(works[i]);
							for ( let j = 0 ; j < works[i].tag.length; j++ ) {
								work_tags += ' <li class="work__tag">'+ works[i].tag[j] +'</li>';
							}

							$('.works').append('<div class="work"><div class="work__image" style="background-image: url(../app/custmfolders/'+ works[i].user_dir +'/' + works[i].image + ');"></div><div class="work__content"><div class="work__author"><img src="'+ works[i].user.ava +'" class="work__author__ava" alt=""><ul class="work__author__info"><li class="work__author__info__item">'+ works[i].user.fullname +'</li><li class="work__author__info__item prof">'+ works[i].user.category +'</li></ul></div><h1 class="work__title">' + works[i].title + '</h1><div class="work__category">  <span translation_slug="category">Category</span>: ' + works[i].category + '</div><div class="work__text">'+ works[i].prev_text +'</div><ul class="work__tags">' + work_tags + '</ul><div class="work__edit"><div class="work__edit__item"><i class="fas fa-thumbs-up" style="margin-right: 3px;" aria-hidden="true"></i>'+ works[i].likes +'</div><div class="work__edit__item"><i class="fas fa-thumbs-down" style="margin-right: 3px;" aria-hidden="true"></i>' + works[i].dislikes + '</div><div class="work__edit__item"><i class="fas fa-eye" style="margin-right: 3px;" aria-hidden="true"></i>'+ works[i].views +'</div></div><a href="home/work/' + works[i].id + '/" class="work__link"> <span translation_slug="look_work"> Look work</span> ⟩</a></div></div>');
							$('.pagination').css('display','none');
						}
					}
				}
				else {
				 	$('.works').html(' ');
				 	$('.pagination').css('display','flex');
				 	}

				}
				setTimeout(changeLang,100);
				tagsclick();
				checkTags();
			});
			}
		}
		setTimeout(function() {
			tagsclick();
			checkTags();
		}, 100);
	});
});

localStorage.setItem('tag','');

function tagsclick() {
	$('.work__tag').each(function() {
		$(this).click(function () {

			var tag_filter = $(this).text().replace('\n','');
			if ( tag_filter != localStorage.getItem('tag') ){
			localStorage.setItem('tag',tag_filter);
			filter__items = {};
			filter__items['tag'] = tag_filter;
			if ( $('.category__filter__item.active').length > 0 ) {
				filter__items[$('.category__filter__item.active').attr('filter_by')] = $('.category__filter__item.active').attr('filter_id');
			}
			else {
				filter__items['tag'] =  localStorage.getItem('tag');
			}

			$.post('home/filter/',{filterBy:$(this).attr('filter_by'), filterItem:'works',filterId:filter__items},function(result) {
				json = jQuery.parseJSON(result);
			

				if(json.result != null) {
				if( json.what == 'works' ) {
				 	if ( json.result != null ) {
						$('.works').html(' ');
						works = json.result;
						for ( let i = 0 ; i < works.length; i++ ) {
							var work_tags = '';
							for ( let j = 0 ; j < works[i].tag.length; j++ ) {
								work_tags += ' <li class="work__tag">'+ works[i].tag[j] +'</li>';
							}
														
							$('.works').append('<div class="work"><div class="work__image" style="background-image: url(../app/custmfolders/'+ works[i].user_dir +'/' + works[i].image + ');"></div><div class="work__content"><div class="work__author"><img src="'+ works[i].user.ava +'" class="work__author__ava" alt=""><ul class="work__author__info"><li class="work__author__info__item">'+ works[i].user.fullname +'</li><li class="work__author__info__item prof">'+ works[i].user.category +'</li></ul></div><h1 class="work__title">' + works[i].title + '</h1><div class="work__category"> <span translation_slug="category"> Category</span>: ' + works[i].category + '</div><div class="work__text">'+ works[i].prev_text +'</div><ul class="work__tags">' + work_tags + '</ul><div class="work__edit"><div class="work__edit__item"><i class="fas fa-thumbs-up" style="margin-right: 3px;" aria-hidden="true"></i>'+ works[i].likes +'</div><div class="work__edit__item"><i class="fas fa-thumbs-down" style="margin-right: 3px;" aria-hidden="true"></i>' + works[i].dislikes + '</div><div class="work__edit__item"><i class="fas fa-eye" style="margin-right: 3px;" aria-hidden="true"></i>'+ works[i].views +'</div></div><a href="home/work/' + works[i].id + '/" class="work__link"><span translation_slug="look_work">Look work</span> ⟩</a></div></div>');
							$('.pagination').css('display','none');
						}
					}
				}
				else {
				 	$('.works').html(' ');
				 	$('.pagination').css('display','flex');
				 	}

				}
				setTimeout(changeLang,100);
				tagsclick();
				checkTags();
			});
			}
			else if( tag_filter == localStorage.getItem('tag') )  {
				localStorage.setItem('tag','');
				filter__items = {};
				
				if ( $('.category__filter__item.active').length > 0 ) {
					filter__items[$('.category__filter__item.active').attr('filter_by')] = $('.category__filter__item.active').attr('filter_id');
				}
				else {
					filter__items = 'all';
				}
				$.post('home/filter/',{filterBy:$(this).attr('filter_by'), filterItem:'works',filterId:filter__items},function(result) {
			
				json = jQuery.parseJSON(result);
				

				if(json.result != null) {
				if( json.what == 'works' ) {
				 	if ( json.result != null ) {
						$('.works').html(' ');
						works = json.result;
						for ( let i = 0 ; i < works.length; i++ ) {
							var work_tags = '';
							
							for ( let j = 0 ; j < works[i].tag.length; j++ ) {
								work_tags += ' <li class="work__tag">'+ works[i].tag[j] +'</li>';
							}

							$('.works').append('<div class="work"><div class="work__image" style="background-image: url(../app/custmfolders/'+ works[i].user_dir +'/' + works[i].image + ');"></div><div class="work__content"><div class="work__author"><img src="'+ works[i].user.ava +'" class="work__author__ava" alt=""><ul class="work__author__info"><li class="work__author__info__item">'+ works[i].user.fullname +'</li><li class="work__author__info__item prof">'+ works[i].user.category +'</li></ul></div><h1 class="work__title">' + works[i].title + '</h1><div class="work__category">  <span translation_slug="category">Category</span>: ' + works[i].category + '</div><div class="work__text">'+ works[i].prev_text +'</div><ul class="work__tags">' + work_tags + '</ul><div class="work__edit"><div class="work__edit__item"><i class="fas fa-thumbs-up" style="margin-right: 3px;" aria-hidden="true"></i>'+ works[i].likes +'</div><div class="work__edit__item"><i class="fas fa-thumbs-down" style="margin-right: 3px;" aria-hidden="true"></i>' + works[i].dislikes + '</div><div class="work__edit__item"><i class="fas fa-eye" style="margin-right: 3px;" aria-hidden="true"></i>'+ works[i].views +'</div></div><a href="home/work/' + works[i].id + '/" class="work__link"><span translation_slug="look_work">Look work</span> ⟩</a></div></div>');
							$('.pagination').css('display','none');
						}
					}
				}
				else {
				 	$('.works').html(' ');
				 	}

				}

				setTimeout(changeLang,100);

				tagsclick();
				checkTags();
			});


			}
			
		});
	});
}
tagsclick();
checkTags();


function changeLang() {
	$.get('home/getLang/', function(result) {
	lang_json = jQuery.parseJSON(result).lang;
	$('.lang').each(function() {
		if($(this).children('.subnav__link').attr('data-lang') == lang_json) {
			$(this).click();
		}
	});

});
}


$('.filter__header').click(function () {
	$(this).toggleClass('active');
	$('.filter__inner').toggleClass('active');
	$('.filter__inner__content').toggleClass('active');
});


function checkTags() {
	$('.work__tag').each(function () {
		if($(this).text() == localStorage.getItem('tag')) {
			$(this).addClass('active');
		}
	});
}
}