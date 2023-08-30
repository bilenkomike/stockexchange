var link = window.location.pathname;
link = link.replace('/public/','');
if( link.includes('home/post/') || link.includes('home/work/') ) {
	$('#returnBack').attr('href', localStorage.getItem('previous_link'));
}
else {
	localStorage.setItem('previous_link', link);
}