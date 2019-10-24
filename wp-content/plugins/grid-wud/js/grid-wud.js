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
	var GridWudIncDir = grid_wud_php.grid_wud_url;
	var counts = new Object; counts.property = 0; /* Count per button */
    var cct = 0 ; /* milisec var per button */
	
	
	/* Get and remember the form and elements id */
    $("button[ClickResult]").click(function() {
        cct = $(this).attr("ClickResult") ;
    });	
	
	/* SUBMIT grid-wud-page */
	$(document).on('submit', '#grid_wud_form', function()
	{		
		if(isNaN(counts[cct])){ counts[cct] = 0; } /* Create once per ctt value */
			var pmore = document.getElementById("grid_wud_set_more_grid_"+cct).value;
			var ptags = document.getElementById("grid_wud_tags_"+cct).value;
			var pcats = document.getElementById("grid_wud_cats_"+cct).value;
			var cfound = document.getElementById("cat_found"+cct).value;
			var tfound = document.getElementById("tag_found"+cct).value;
			var ids = document.getElementById("grid_wud_ids_"+cct).value;
			var tnr = document.getElementById("grid_wud_grid_nr_"+cct).value;
			var snr = document.getElementById("grid_wud_shape_"+cct).value;
			var lp = document.getElementById("grid_wud_latest_"+cct).value;
			var sh = document.getElementById("grid_wud_shadow"+cct).value;
			var posttype = document.getElementById("posttype"+cct).value;
			var tax_name = document.getElementById("tax_name"+cct).value;
			var pc = document.getElementById("pods_cat"+cct).value;
			var pu = document.getElementById("pods_is_used"+cct).value;
			var isnr = document.getElementById("is_numbers"+cct).value;
			var isids = document.getElementById("postids"+cct).value;
			var ptotal = $("#grid_wud_set_max_grid_"+cct).val();
			var bg = document.getElementById("background"+cct).value;
			var tl = document.getElementById("tiles"+cct).value;
			var de = document.getElementById("dark_excerpt"+cct).value;
			var ng = document.getElementById("grid_wud_gray"+cct).value;
			var wo = document.getElementById("grid_wud_or_woo"+cct).value;
			
			var knop = document.getElementById("grid_wud_hide_button"+cct).value;
			var backimg = document.getElementById("backimg"+cct).value;
			var backcol = document.getElementById("backcol"+cct).value;
			var ob = document.getElementById("order_by"+cct).value;
			var so = document.getElementById("order_sort"+cct).value;
			var sticky = document.getElementById("sticky"+cct).value;
			var tpost = document.getElementById("tpost"+cct).value;
			var stickyleft = document.getElementById("stickyleft"+cct).value;
			var pop = document.getElementById("grid_wud_or_popup"+cct).value;
			
			var loaded = tnr-1;
			
		counts[cct] ++;

		if(counts[cct] ==1)
		{
			ptotal = parseInt(pmore);
			document.getElementById("grid_wud_set_max_grid_"+cct).value = ptotal;		 
		}
		else{
			ptotal = parseInt(ptotal) + parseInt(pmore);
			document.getElementById("grid_wud_set_max_grid_"+cct).value = ptotal;	
		}
		
		/* Hide the button if reached maximum*/
		var nowloaded = loaded+ptotal;
		if(nowloaded >= tpost && knop==1){ $('.'+cct).css('visibility','hidden');}
		if(nowloaded >= tpost && knop==2){ $('.'+cct).css({'cursor':'default' , 'color':'#9e9e9e', 'background-color':''+backcol+'', 'background-image':'url('+backimg+')'});}
		
		var dataString = 'stickyleft='+ stickyleft + '& no_gray='+ ng + '& popup='+ pop + '& grid_wud_or_woo='+ wo + '& sticky='+ sticky + '& dark_excerpt='+ de + '& grid_wud_set_max_grid='+ ptotal + '& grid_wud_tags='+ ptags +'& grid_wud_cats='+ pcats +'& grid_wud_ids='+ ids+'& grid_wud_grid_nr='+ tnr+'& grid_wud_shape='+ snr+'& grid_wud_latest='+ lp+'& grid_wud_shadow='+ sh+'& posttype='+ posttype+'& tax_name='+ tax_name+'& pods_cat='+ pc+'& pods_is_used='+ pu+'& is_numbers='+ isnr+'& postids='+ isids+'& background='+ bg+'& order_by='+ ob+'& order_sort='+ so+'& tiles='+ tl+'& cat_found='+ cfound+'& tag_found='+ tfound;
		
		/* Load in div grid_wud_result data with structure from grid-wud-xtra*/
		$.ajax({
		type : 'POST',
		url  : GridWudIncDir,
		data : dataString,
		cache: false,
		async: true,
		success :  function(data){$("#grid_wud_result_"+cct).html(data);}
		});	
		return false;
	});
	
	/* GO TO once grid-wud-page */
	if (document.getElementById("grid_wud_button")) {
		var pos = localStorage.getItem("pos");
		$('html, body').animate({scrollTop : pos},0);
		localStorage.removeItem(pos);
    }
	
})(jQuery);
//]]> 
