/*
 * Toggles header search on and off
 */
 
jQuery(document).ready(function($){
    $(".search-toggle").click(function(){
        $("#search-container").slideToggle(100, function(){
            $(".search-toggle").toggleClass("active");
        });
    });
});