/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens and enables tab
 * support for dropdown menus.
 */
( function() {
	var container, button, menu, links, subMenus;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );
	subMenus = menu.getElementsByTagName( 'ul' );

	// Set menu items with submenus to aria-haspopup="true".
	for ( var i = 0, len = subMenus.length; i < len; i++ ) {
		subMenus[i].parentNode.setAttribute( 'aria-haspopup', 'true' );
	}

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}
} )();

jQuery(document).ready(function($){
    
    

    /*  Let's add distributed nav items for large screens */
    
    // global vars
    var mainNav = $(".main-navigation"),
        mainNavRect,
        thisLiRect,
        thisLiWidth,
        adjustedNavWidths,
        totalNativeNavLiWidth = 0,
        innerLiHtmlWidth,
        smallNativeNavLiWidth = 0;
    
    // get the top level nav elements
    var topLevelNavLiElements = $(".main-navigation ul").children("li").not("ul ul li"),
        allNavLiElements = mainNav.find("li");
    
    // get the total width of the navbar
    for (var i = 0; i < topLevelNavLiElements.length; i++ ){
        thisLiRect = topLevelNavLiElements[i].getBoundingClientRect();
        thisLiWidth = thisLiRect.right - thisLiRect.left;
        totalNativeNavLiWidth += thisLiWidth;
    }
    
    //remove the left and right padding from the elements so that we can measure the width of the li elements without it
    $(allNavLiElements).children("a").css("padding", "0");

    // recalculate the width of the nav li elements
    for (var j = 0; j < topLevelNavLiElements.length; j++){   
        thisLiRect = topLevelNavLiElements[j].getBoundingClientRect();
        thisLiWidth = thisLiRect.right - thisLiRect.left;
        smallNativeNavLiWidth += thisLiWidth;
    }
    
    // reset the default padding on the li elements
    $(allNavLiElements).children("a").css("padding", "");
    
    
    function setLiWidths(){
        var emptySpace,
            newPadding;
        
        // get the width of the main-navigation div
        mainNavRect = mainNav[0].getBoundingClientRect();
        mainNavWidth = mainNavRect.right - mainNavRect.left;
        console.log("mainNavWidth = " + mainNavWidth);
        
        emptySpace = mainNavWidth - smallNativeNavLiWidth;
        console.log("smallNativeLiWidth = " + smallNativeNavLiWidth);
        console.log("emptySpace = " + emptySpace);
        
        newPadding = ( emptySpace / topLevelNavLiElements.length ) / 2;

        if ( mainNavWidth > totalNativeNavLiWidth ){
            $(topLevelNavLiElements).children("a").css({"padding-left": newPadding, "padding-right": newPadding});
            
            // set  width of sub-menus
            $(".sub-menu").css("width", $(this).parent("li").width() );
            
            
            $("ul.sub-menu").each(function(){
                $(this).width($(this).parent().width());
            });

            
            
        } else if ( mainNavWidth <= totalNativeNavLiWidth ) {
            $(topLevelNavLiElements).children("a").css({"padding": ""});
        } else {
            console.log("Failure. Something goes wrong.");
        }
    }
    setLiWidths();
    $(window).resize(function(){
        setLiWidths();
    });
    
    
    
    /* Let's make dropdown menus activate on click */
    
    
    // override css hover rules on page load
    var disableMenuHover = function(){
        $(".menu-item-has-children").mouseenter(function(){
            $(this).children("ul").css("left", "-999em");
        });
    }
    disableMenuHover();
    
    $("body").on("click", function(){
        $(".main-navigation").removeClass("showing-sub-navs");
        $(".menu-item-has-children ul").css("left", "-999em");
    });
    
    $(".menu-item-has-children").mouseout(function(){
        $(this).removeClass("focus");
    });
    $(".nav-menu > .menu-item-has-children > a").on("click", function(e){
        e.preventDefault();
    });
    
    $(".main-navigation .menu-item-has-children a").on("click", function(e){
            //e.stopPropagation();
        if ( !$(".main-navigation").hasClass("showing-sub-navs")){
            $(this).parent(".menu-item-has-children").children("ul").css("left","auto");
            e.stopPropagation();
            e.preventDefault();
            $(".main-navigation").addClass("showing-sub-navs");
        } else {
            $(".main-navigation").removeClass("showing-sub-navs");
        }
        
    });
    
    $(".menu-item-has-children").mouseenter(function(){
        
        //get parent and child elements
        var parentLI = $(this).parents(".menu-item-has-children"),
            childUL = $(this).children("ul");
        console.log ( parentLI.length );
        if ( $(".main-navigation").hasClass("showing-sub-navs") ){
            $(".menu-item-has-children").not(parentLI).children("ul").css("left", "-999em");
            // different behavior for second and third level navs
            if ( !$(this).parents(".menu-item-has-children").length > 0 ){
                // second level navs 
                $(childUL).css("left", "auto");
            } else {
                // third level navs (and beyond)
                $(childUL).css("left", "100%");
            }
        }
    });
});
