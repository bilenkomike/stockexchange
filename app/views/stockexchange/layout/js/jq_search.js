$('[searchForm]').each(function() {
	$(this).on('submit', function(e) {
		e.preventDefault();
		
    var search_par = $(this).children('input').val();

    $.post('home/setSearch/', {search:search_par}, function (result) {
        const json = jQuery.parseJSON(result);
        if (json.status == 'ok') {
            window.location.href = 'home/search/' + json.message + '/';
        }
    });
	});
});