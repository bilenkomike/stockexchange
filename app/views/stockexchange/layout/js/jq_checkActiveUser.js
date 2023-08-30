// document.addEventListener("visibilitychange", event => {
//   console.clear();
// if (document.visibilityState == "visible") {
//   console.log("tab is active")
// } else {
//   console.log("tab is inactive")
// }
// })

$(window).blur(function() {
  $.post('home/activity', {activity:0}, function (data){
  });
});

$(window).focus(function() {
  $.post('home/activity', {activity:1}, function (data){
  });
});





if($('[data-checkactivity]').length > 0) {
    setInterval(function () {
        $('[data-checkactivity]').each(function() {
            id = $(this).attr('checkactivity-id');
            if ( id != '' ) {
                $.post('home/checkactivity/', {checkAct:id}, function(result) {
                    json = jQuery.parseJSON(result);
                    if(json.active_nor_not != 0) {
                        $('[checkactivity-id="'+ json.id +'"]').addClass('active');
                    }
                    else {
                        $('[checkactivity-id="'+ json.id +'"]').removeClass('active');
                    }
                });
            } 
            
        });
    }, 10000);
}