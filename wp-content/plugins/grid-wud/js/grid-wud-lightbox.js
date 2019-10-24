/**
=== Grid WUD ===
Contributors: wistudat.be
Plugin Name: Grid WUD
Description: Adds 100% responsive, customizable and dynamic grids to WordPress posts and pages.
Author: Danny WUD
Author URI: https://wud-plugins.com
 */
//<![CDATA[
(function($) {
	$.fn.wudLB = function(WUDopt) {
		if(!this.length){return this;}
		var WUD = $.extend( $.fn.wudLB.defaults, WUDopt );
		
		return this.each(function() {
			
			var $this = $(this), wudImgLg = $this.attr(WUD.target), isCssLb = function(wudImgLg) {return (typeof wudImgLg !== undefined);};	
			//Return if url is not an image!
			if(typeof wudImgLg === "undefined"){return;}
			//Preload the image!
			img1 = new Image();
			img1.src = wudImgLg;
			//HREF			
			if ( isCssLb(wudImgLg) ){$this.wrap("<a class='" + WUD.WudWrapClass + "' href='" + wudImgLg + "'></a>");}
			//Prepare exit
			$("a." + WUD.WudWrapClass).click(function(e) {
				e.preventDefault();
				var CssLb,
				//Prepare image
				lbImageHref = $(this).attr( "href" );
				//Show it ...
				if ( $("#CssLb").length ) {$("#CssLb-img").html("<img style='max-height: 80%; margin-top: 2%' src='" + lbImageHref + "' /><div class='text-box'> <h4>&#10754;</h4></div>");	$("#CssLb").show();} 
				else {CssLb ="<div id='CssLb' style='z-index: 1001;'>" + "<div id='CssLb-img'>" + "<img src='" + lbImageHref + "' />" + "</div>" + "</div>"; $( "body" ).append(CssLb);}
			});
			//Hide on mouse click
			$( document ).on("click touchend mouseup touchcancel", "#CssLb", function() {$( "#CssLb" ).hide(); });
			//Hide on key down
			$(this).keydown(function(e) { e.preventDefault(); if(e.keyCode == 27 || e.keyCode == 13) { $( "#CssLb" ).hide(); } });
			
		});
		
	};
	$.fn.wudLB.defaults = {target: "wud-lb",WudWrapClass: "CssLb"};	
	$("a").wudLB();
})(jQuery);
//]]>