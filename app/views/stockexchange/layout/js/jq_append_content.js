if( $('[name=viewpost]').length > 0 ) {
	if($(window).width() < 420) {
		$('[name=viewpost]').contents().find('head').append('<style> body { max-width:350px; height: auto;  color:#f2f2f2; margin: 0; overflow:hidden; } img {display: block; max-width: 350px;} iframe { width:95%; height:200px;} @media screen and (max-width:480px) {body{width:300px;}}</style>');		
		$('[name=viewpost]').css('width','360px');
	}
	else {
		$('[name=viewpost]').contents().find('head').append('<style> body { width:' + $('.about').width() + 'px; height: auto;  color:#f2f2f2; margin: 0; overflow:hidden; font-size: 18px; line-height:1.5;} img {display: block; max-width: '+ $('.about').width() +'px;} iframe { width:95%; height:200px;} @media screen and (max-width:480px) {body{width:300px;}}</style>');
	}
	
	if (localStorage.getItem('bgc') == 'w') {
		$('[name=viewpost]').contents().find('body').css('color','#202020');

	}
	else {
		$('[name=viewpost]').contents().find('body').css('color','#f2f2f2');
	}

	$('[name=viewpost]').width($('.about').width());

	$('[name=viewpost]').contents().find('body').append($('[name=viewpost]').html());

// x	console.log($('[name=viewpost]').contents().find('body').html());
	if ( $(window) )
	setTimeout(function() {
		$('[name=viewpost]').css('height', $('[name=viewpost]').contents().find('body').height() + 'px');
	}, 50);
}


$('.about__content').each(function() {
	if($(this).hasClass('editor_result')) {
		$(this).contents().find('b').each(function () {
			$(this).css({
				'font-weight':'700'
			});
		});
		$(this).contents().find('i').each(function () {
			$(this).css({
				'font-style':'italic'
			});
		});
		$(this).contents().find('p').each(function () {
			$(this).css({
				'margin':'20px 0'
			});
		});
		$(this).contents().find('div').each(function () {
			// console.log($(this));
			$(this).css({
				'margin':'10px 0'
			});
		});

		$(this).contents().find('img').each(function () {
			$(this).css({
				'display':'inline-block',
				'max-width':'1340px'
			});
			var image_in = $(this);
			console.log(window.screen.width);
			if(window.screen.width < 415) {
				console.log(image_in);
				image_in.css({
					'max-width':'calc(100% - 30px)'
				});
			}
		});

		$(this).contents().find('ol').each(function () {
			$(this).css({
				'display':'block',
				'list-style-type':'decimal',
				'padding-right':'20px',
				'margin': '0px 0px 0px 50px'
			});
			$(this).children('li').each(function() {
				$(this).css({
					'padding-left':'20px',
					'margin': '10px 10px 10px 10px'
				});
			});
			var ol_in = $(this);

			if(window.screen.width < 415) {
				
				ol_in.css({
					'padding-right':'10px',
					'margin': '0px 0px 0px 20px'
				});
			}
		});
		$(this).contents().find('ul').each(function () {
			$(this).css({
				'display':'block',
				'list-style-type':'disc',
				'padding-right':'20px',
				'margin': '0px 0px 0px 50px'
			});
			$(this).children('li').each(function() {
				$(this).css({
					'padding-left':'20px',
					'margin': '10px 10px 10px 10px'
				});
			});

			var ul_in = $(this);

			if(window.screen.width < 415) {
				
				ul_in.css({
					'padding-right':'10px',
					'margin': '0px 0px 0px 20px'
				});
			}
		});
		$(this).contents().find('a').each(function() {
			// console.log($(this));
			$(this).attr('target','_blank');
			$(this).css({
				'color':'#107EFF'
			});
		});

		$('h2').each(function() {
			if($(this).attr('class') == undefined) {
				$(this).css({
					'font-size':'25px'
				});
			}
		}); 

		$('h3').each(function() {
			if($(this).attr('class') == undefined) {
				$(this).css({
					'font-size':'22px'
				});
			}
		});
		$('h4').each(function() {
			if($(this).attr('class') == undefined) {
				$(this).css({
					'font-size':'19px'
				});
			}
		});

	}
});





