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

	var GroupWudIncDir = group_wud_php.group_wud_url;	
    var cctot = 0 ; /* milisec var per button */
		
	/* Button value (time and button number) */
    $("button[ClickResultGroup]").click(function() {
        cctot = $(this).attr("ClickResultGroup") ;
    });		

	//If form is submitted
	$(document).on('submit', '#group_wud_form', function()
	{
	//Button number
	var buttons = cctot.slice(-1);
	if(cctot.length > 4) {buttons = cctot.slice(-2);}
	var count_tag = cctot.substring(0, 3);
	var group_more = document.getElementById("wud_group_more_"+cctot).value;	
	var grid_wud_widget = document.getElementById("grid_wud_widget_"+cctot).value;
	var tiles = document.getElementById("tiles_"+cctot).value;
	var backgroundtile = document.getElementById("background_"+cctot).value;
	var widgetfront = document.getElementById("widgetfront_"+cctot).value;
	var grid_wud_shape = document.getElementById("grid_wud_shape"+cctot).value;
	var args1 = document.getElementById("args1"+cctot).value;
	var args2 = document.getElementById("args2"+cctot).value;
	var args3 = document.getElementById("args3"+cctot).value;
	var args4 = document.getElementById("args4"+cctot).value;
	var args5 = document.getElementById("args5"+cctot).value;
	var args6 = document.getElementById("args6"+cctot).value;
	var args7 = document.getElementById("args7"+cctot).value;
	var args8 = document.getElementById("args8"+cctot).value;
	var args9 = document.getElementById("args9"+cctot).value;
	var args10 = document.getElementById("args10"+cctot).value;	
	var de = document.getElementById("dark_excerpt"+cctot).value;	
	var gridurl1 = document.getElementById("gridurl1"+cctot).value;
	var gridurl2 = document.getElementById("gridurl2"+cctot).value;
	var gridurl3 = document.getElementById("gridurl3"+cctot).value;
	var gridurl4 = document.getElementById("gridurl4"+cctot).value;
	var gridurl5 = document.getElementById("gridurl5"+cctot).value;
	var gridurl6 = document.getElementById("gridurl6"+cctot).value;
	var gridurl7 = document.getElementById("gridurl7"+cctot).value;
	var gridurl8 = document.getElementById("gridurl8"+cctot).value;
	var gridurl9 = document.getElementById("gridurl9"+cctot).value;
	var gridurl10 = document.getElementById("gridurl10"+cctot).value;
	var pop = document.getElementById("grid_wud_or_popup"+cctot).value;
	var gww = document.getElementById("grid_wud_or_woo"+cctot).value;
	
	var grid_wud_button = document.getElementById("grid_wud_button"+cctot).value;
	
	//Prepare data
	var dataString = 'buttons='+ buttons + '& popup='+ pop  + '& grid_wud_or_woo='+ gww  + '& dark_excerpt='+ de + '& group_more='+ group_more + '& grid_wud_widget='+ grid_wud_widget + '& tiles='+ tiles + '& background='+ backgroundtile + '& widgetfront='+ widgetfront + '& count_tag='+ count_tag + '& grid_wud_shape='+ grid_wud_shape + '& args1='+ args1 + '& args2='+ args2 + '& args3='+ args3 + '& args4='+ args4 + '& args5='+ args5 + '& args6='+ args6 + '& args7='+ args7 + '& args8='+ args8 + '& args9='+ args9 + '& args10='+ args10 + '& gridurl1='+ gridurl1+ '& gridurl2='+ gridurl2+ '& gridurl3='+ gridurl3+ '& gridurl4='+ gridurl4+ '& gridurl5='+ gridurl5+ '& gridurl6='+ gridurl6+ '& gridurl7='+ gridurl7+ '& gridurl8='+ gridurl8+ '& gridurl9='+ gridurl9+ '& gridurl10='+ gridurl10+ '& grid_wud_button='+ grid_wud_button;
		
		//Replace the Read More URL if a button is clicked.
		if(buttons==1){$('#group_button_'+count_tag).attr('href',gridurl1);}
		if(buttons==2){$('#group_button_'+count_tag).attr('href',gridurl2);}
		if(buttons==3){$('#group_button_'+count_tag).attr('href',gridurl3);}
		if(buttons==4){$('#group_button_'+count_tag).attr('href',gridurl4);}
		if(buttons==5){$('#group_button_'+count_tag).attr('href',gridurl5);}
		if(buttons==6){$('#group_button_'+count_tag).attr('href',gridurl6);}
		if(buttons==7){$('#group_button_'+count_tag).attr('href',gridurl7);}
		if(buttons==8){$('#group_button_'+count_tag).attr('href',gridurl8);}
		if(buttons==9){$('#group_button_'+count_tag).attr('href',gridurl9);}
		if(buttons==10){$('#group_button_'+count_tag).attr('href',gridurl10);}		
		
		/* Load in div grid_wud_result data with structure from grid-wud-xtra*/
		$.ajax({
		type : 'POST',
		url  : GroupWudIncDir,
		data : dataString,
		cache: false,
		async: true,
		success :  function(data){$(".grid_wud_master_"+cctot.substring(0, 3)).html(data);}
		});	
		
//alert(gridurl2);		
		return false;
	});
	
})(jQuery);
//]]> 
