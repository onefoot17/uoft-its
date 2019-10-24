/**
=== Grid WUD ===
Contributors: wistudat.be
Plugin Name: Grid WUD
Description: Adds 100% responsive, customizable and dynamic grids to WordPress posts and pages.
Author: Danny WUD
Author URI: https://wud-plugins.com
 */
 jQuery(document).ready(function($){

  var mediaUploader;

  $('#upload-button').click(function(e) {
    e.preventDefault();
    // If the uploader object has already been created, reopen the dialog
      if (mediaUploader) {
      mediaUploader.open();
      return;
    }
    // Extend the wp.media object
    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose Image',
      button: {
      text: 'Choose Image'
    }, multiple: false });

    // When a file is selected, grab the URL and set it as the text field's value
    mediaUploader.on('select', function() {
      attachment = mediaUploader.state().get('selection').first().toJSON();
	  $('#image-src').attr('src', attachment.url);
	  $('#image-url').val(attachment.url);
    });
    // Open the uploader dialog 
    mediaUploader.open();
  });
  
  // Clear button Media
  $('#clear-button').click(function(e) { 
	var my_url = document.getElementById("grid_img").value;;
	$('#image-src').attr('src', my_url);
	$('#image-url').val('');
  });
  
  // Title only on grid: Changed value
  $("select").change(function(){
	  if ($("select[name=grid_wud_show_excerpt] option:selected").val() == '4') {
			 $("#txtonly").show();
			 $("#topbot").show();
	   }
	   else{
			 $("#txtonly").hide();
			 $("#topbot").hide();	   
	   }
    }).change();	
  // Title only on grid: Onload value
  if ($("select[name=grid_wud_show_excerpt] option:selected").val() == '4') {
         $("#txtonly").show();
		 $("#topbot").show();
   }

//Sort order or random
  $("select").change(function(){
	  if ($("select[name=grid_wud_set_order_grid] option:selected").val() == 'rand') {
			 $("#not_99").hide();
	   }
	   else{
			 $("#not_99").show();
	   }
    }).change();
	

  if ($("select[name=grid_wud_set_order_grid] option:selected").val() == 'rand') {
         $("#not_99").hide();
   }
 
//Shadow by grids 
$('#grid_wud_img_split').click(function() {
    if ($('#grid_wud_img_split').is(":checked")){
		$("#tilesshadow").show();
	}
	else{
		$("#tilesshadow").hide();
	}
});

if ($('#grid_wud_img_split').is(":checked")){
		$("#tilesshadow").show();
	}
	else{
		$("#tilesshadow").hide();
	}

	//Size grids 
$('#grid_wud_size_split').click(function() {
    if ($('#grid_wud_size_split').is(":checked")){
		$("#wud_sizer9hs").hide();
		$("#wud_sizer11hs").show();
	}
	else{
		$("#wud_sizer9hs").show();
		$("#wud_sizer11hs").hide();
	}
});

if ($('#grid_wud_size_split').is(":checked")){
		$("#wud_sizer9hs").hide();
		$("#wud_sizer11hs").show();
	}
	else{
		$("#wud_sizer9hs").show();
		$("#wud_sizer11hs").hide();
	}
	
	
});