
$(document).ready(function () {

  
    "use strict";
    
    // Nice Scroll
    $("html").niceScroll();
    
    $('.carousel').carousel({
        
        interval: 6000
        
    });

	  
    // Caching The Scroll Top Element
    var scrollButton = $("#scroll-top")
    $(window).scroll(function () {
        
        if ($(this).scrollTop() >= 600) {
            
            scrollButton.show();
            
        } else {
            
            scrollButton.hide();
        }
    });
    
    // Click On Button To Scroll Top
    
    scrollButton.click(function () {
        
        $("html,body").animate({ scrollTop : 0 }, 500);
        
    });



// Switch Between Login & Signup

$('.login-page h1 span').click(function(){

	$(this).addClass('selected').siblings().removeClass('selected');

	$('.login-page form').hide();
	
	$('.' + $(this).data('class')).fadeIn(100)
});

	// Trigger The Selectboxit

	$("select").selectBoxIt({

		autoWidth: false
	}); 

    	// Hide Placeholder On Form Focus

	$('[placeholder]').focus(function(){

		$(this).attr('data-text', $(this).attr('placeholder'));
		$(this).attr('placeholder', '');
	}).blur(function () {

		$(this).attr('placeholder', $(this).attr('data-text'));

	});
	
	//confirmation Message On Button

	$('.confirm').click(function() {
	
		return confirm('Are You Sure?');
	})

	// Add Asterisk On Required Field


});


// Loading Screen

$(window).load(function () {
    
    "use strict";
    
    // Loading Elements
    
    $(".loading-overlay .cssload-thecube").fadeOut(500, function () {
        
        // Show The Scroll

        $("body").css("overflow", "auto");
        
        $(this).parent().fadeOut(500, function () {
            
            $(this).remove();
        });
    });
});