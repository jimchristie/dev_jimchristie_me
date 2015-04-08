jQuery(document).ready(function($){
    
	var breakpoint = 600;
    var sf = $('ul.nav-menu');
	
    if($(document).width() >= breakpoint){
        sf.superfish({
            delay: 1,
            speed: 1,
            disableHI: true
        });
    }
	
    $(window).resize(function(){
        if($(document).width() >= breakpoint & !sf.hasClass('sf-js-enabled')){
            sf.superfish({
                delay: 1,
                speed: 1,
                disableHI: true
            });
        } else if($(document).width() < breakpoint) {
            sf.superfish('destroy');
        }
    });
});