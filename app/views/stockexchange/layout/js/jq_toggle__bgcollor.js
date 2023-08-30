bgc = window.localStorage;
var styles = getComputedStyle(document.documentElement);
if(!localStorage.getItem('bgc')) {
    localStorage.setItem('bgc','b');
}
$(document).ready(function(){
    if(localStorage.getItem('bgc') == 'b') {
            $('body').addClass('b');
			$('body').removeClass('w');
            dark__bgc();
            
        }
        else {
            $('body').addClass('w');
			$('body').removeClass('b');
            light__bgc();
        }
});
$('[data-changebgcolor]').each(function() {
    $(this).click(
	function(event){
		event.preventDefault();
        if(localStorage.getItem('bgc') == 'w') {
            localStorage.removeItem('bgc');
			localStorage.setItem('bgc','b');
            $('body').addClass('b');
			$('body').removeClass('w');
            dark__bgc();
        }
        else {
            localStorage.removeItem('bgc');
			localStorage.setItem('bgc','w');
            $('body').addClass('w');
			$('body').removeClass('b');
            light__bgc();
        }
    }
    
    
    );
});


function light__bgc() {
    document.documentElement.style.setProperty('--scrollbg','#202020');
    document.documentElement.style.setProperty('--bgbm','#202020');
    document.documentElement.style.setProperty('--bgc__footer__pagination','#d3d3d3');
    document.documentElement.style.setProperty('--short__post__bg','#eeeeee');
    document.documentElement.style.setProperty('--btnimageloadbg','#202020');
    document.documentElement.style.setProperty('--btnimageloadco','#f2f2f2');
    document.documentElement.style.setProperty('--postbgc','#f2f2f2');
    document.documentElement.style.setProperty('--info__urlc','#202020');
    document.documentElement.style.setProperty('--filterbgc','#f2f2f2');
    document.documentElement.style.setProperty('--interest__header','#9C7902');
    document.documentElement.style.setProperty('--checkbox__remember','#fff');
    document.documentElement.style.setProperty('--filter__underline','#0D0D0D');
    document.documentElement.style.setProperty('--header__bgc','#C5C5C5');
    document.documentElement.style.setProperty('--search__bgc','#ffffff');
    document.documentElement.style.setProperty('--breadcrumb','#C5C5C5');
    document.documentElement.style.setProperty('--chat__bgc','#f2f2f2');
    document.documentElement.style.setProperty('--message__bgc','#b6b6b6');
    document.documentElement.style.setProperty('--mess__list__item__bgc','#f8f8f8');
    document.documentElement.style.setProperty('--mess__list__item__border__bgc','#444444');

    if( $('[name=viewpost]').length > 0  ) {
        $('[name=viewpost]').contents().find('body').css('color','#202020');
    }
}

function dark__bgc() {
    document.documentElement.style.setProperty('--scrollbg','#e5e5e5');
    document.documentElement.style.setProperty('--bgbm','#f2f2f2');
    document.documentElement.style.setProperty('--bgc__footer__pagination','#0d0d0d');
    document.documentElement.style.setProperty('--short__post__bg','#0d0d0d');
    document.documentElement.style.setProperty('--btnimageloadbg','#f2f2f2');
    document.documentElement.style.setProperty('--btnimageloadco','#202020');
    document.documentElement.style.setProperty('--postbgc','#0D0D0D');
    document.documentElement.style.setProperty('--info__urlc','#f2f2f2');
    document.documentElement.style.setProperty('--filterbgc','#202020');
    document.documentElement.style.setProperty('--interest__header','#F3EBA2');
    document.documentElement.style.setProperty('--checkbox__remember','#0D0D0D');
    document.documentElement.style.setProperty('--filter__underline','#f2f2f2');
    document.documentElement.style.setProperty('--header__bgc','#0D0D0D'); 
    document.documentElement.style.setProperty('--search__bgc','#202020');  
    document.documentElement.style.setProperty('--breadcrumb','#212121');
    document.documentElement.style.setProperty('--chat__bgc','#232323');
    document.documentElement.style.setProperty('--message__bgc','#0D0D0D');
    document.documentElement.style.setProperty('--mess__list__item__bgc','#131313');
    document.documentElement.style.setProperty('--mess__list__item__border__bgc','#0D0D0D');
    
    if( $('[name=viewpost]').length > 0  ) {
        $('[name=viewpost]').contents().find('body').css('color','#f2f2f2');
    }
}