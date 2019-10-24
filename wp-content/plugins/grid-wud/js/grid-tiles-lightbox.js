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
		//alert(1);
		return this.each(function() {
			
			var $this = $(this), WudButtonLg = $this.attr(WUD.target), WudURLS = $this.attr(WUD.WudURL), WudExpt = $this.attr(WUD.WudEXE), WudButton = $this.attr(WUD.WudButtons), isCssLbWud = function(WudButtonLg) {return (typeof WudButtonLg !== undefined);};	
			
			//Return if url is not an image!
			if(typeof WudButtonLg === "undefined"){return;}
			//Preload the image!
			img1 = new Image();
			img1.src = WudButtonLg;
			
			//HREF			
			if ( isCssLbWud(WudButtonLg) ){$this.wrap("<a class='" + WUD.WudWrapClass + "' href='" + WudButtonLg + "' wudtarget='" + WudURLS + "' wudexerpts='" + WudExpt + "' wudbuttonx='" + WudButton + "'></a>");}
			//Prepare exit
			$("a." + WUD.WudWrapClass).click(function(e) {
				e.preventDefault();
				var WudButtonCss='';
				var CssLbWud,
				//Prepare image
				lbImageHref = $(this).attr( "href" );
				wudTargetURL = $(this).attr( "wudtarget" );
				wudTargetEXP = $(this).attr( "wudexerpts" );
				wudTargetBUT = $(this).attr( "wudbuttonx" );
				//Show it ...
				
				if ( $("#CssLbWud").length ) {$("#CssLbWudimg").html("<div id='CssLbCloseBox'>&#10754;</div><img src='" + lbImageHref + "' /><div id='WudExcerpt'>" + wudTargetEXP + "<p id='WudButtonCss'>" + wudTargetBUT + "</p></div>");	$("#CssLbWud").show();} 
				else {CssLbWud ="<div id='CssLbWud'>" + "<div id='CssLbWudimg'><img src='" + lbImageHref + "' /></div>" + "</div>"; $( "body" ).append(CssLbWud);}
			});
			//Hide on mouse click 
			$( document ).on('click','#WudButtonCss',function(){ $( "#CssLbWud" ).hide(); window.location.href = wudTargetURL; });
			$( document ).on("click touchend mouseup touchcancel", "#CssLbWud", function() {$( "#CssLbWud" ).hide(); });
			//Hide on key down
			$(this).keydown(function(e) { e.preventDefault(); if(e.keyCode == 27 || e.keyCode == 13) { $( "#CssLbWud" ).hide(); } });
	
			 
		});
		
	};
	$.fn.wudLB.defaults = {target: "wud-lb-gt",WudWrapClass: "CssLbWud", WudURL: "wud-lb-url", WudEXE: "wud-lb-excerpt", WudButtons: "wud-lb-readmore"};	
	$("a").wudLB();
})(jQuery);
//]]>