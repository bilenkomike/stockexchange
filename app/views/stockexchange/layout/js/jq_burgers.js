// mobile Nav burger call
const mobileNavBurger = $("#nav__burger");
mobileNavBurger.click(function(){
	$(this).toggleClass('bact');
	$('body').toggleClass('no-scroll');
	$('#mobileNav').toggleClass('active');
	setTimeout(function(){
		$('#mobileContent').toggleClass('active');
	}, 100);

});

const mobileContent = $('#mobileContent');
mobileContent.click(function(e) {
	e.stopPropagation();
});


const mobileNav = $('#mobileNav');
mobileNav.on('click',function() {
	mobileContent.toggleClass('active');
	setTimeout(function(){
		mobileNav.removeClass('active');
		mobileNavBurger.toggleClass('bact');
		$('body').toggleClass('no-scroll');
	}, 500);
	
});


$('#admin__nav__burger').click(function() {
	$(this).toggleClass('bact');
	$('.admin__header').toggleClass('active');
	$('.admin__nav').toggleClass('active');
});

$('.admin__nav__btn').each(function() {
	$(this).click(function() {
		$('#admin__nav__burger').removeClass('bact');
		$('.admin__header').removeClass('active');
		$('.admin__nav').removeClass('active');
	});
	
});