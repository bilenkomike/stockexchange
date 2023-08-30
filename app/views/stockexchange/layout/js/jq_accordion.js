const accordions = $('[accordion]');
accordions.each(function() {
	// $()
	$(this).click(function() {
		$(this).toggleClass('active');
		$('#'+$(this).attr('accordion-item')).toggleClass('active');
	})
});