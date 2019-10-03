// remap jQuery to $
(function($) {})(window.jQuery); /* trigger when page is ready */
$(document).ready(function() {
	// Horizontal Scrolling 
	$('a.scroller').bind('click', function(e) {
		var $anchor = $(this);
		$('html, body').stop().animate({
			scrollTop: $($anchor.attr('href')).offset().top
		}, 1500, 'easeInOutExpo');
		// if you don't want to use the easing effects:
		//  $('html, body').stop().animate({
		// scrollTop: $($anchor.attr('href')).offset().top
		// }, 1000);
		e.preventDefault();
	});
	// Font Size Changer
	fontSize("#fontsize", ".font-size", 10, 15, 22);
	// Menus
/* $('.navbar ul.nav').superfish({
	delay: 500,
	animation:{
	    height:'show'
	},
	speed:'fast',
	autoArrows:false,
	dropShadows:false
    });
    */
	// Add Last Child Class for IE6
	$('body.ie6 .row div[class^="span"]:last-child').addClass('last-child');
	// Navigation Buttons
	$('a.services').click(function(e) {
		e.preventDefault();
		$('.status-dropdown').slideUp('fast');
		$('a.status').removeClass('active');
		$(this).toggleClass('active');
		$('.service-dropdown').slideToggle('slow');
	});
	$('a.status').click(function(e) {
		e.preventDefault();
		$('.service-dropdown').slideUp('fast');
		$('a.services').removeClass('active');
		$(this).toggleClass('active');
		$('.status-dropdown').slideToggle('slow');
	});
	// News Archive
	$('.post-type-archive-news a.view_archive').click(function(e) {
		e.preventDefault();
		$('.archived_news').slideToggle('slow');
		$('html, body').animate({
			scrollTop: $('.span8').offset().top - 30
		}, 500);
	});
	// FAQ Questions + Answers
	$('a.question').click(function(e) {
		e.preventDefault();
		$(this).next('p.answer').slideToggle('fast');
	});
	//Hide Empty Sidebar Navigation
	if (!($('#sidebar nav.box-radius').html())) {
		$('#sidebar nav.box-radius').hide();
	}
	
});