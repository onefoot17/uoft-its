 <?php
 /*
=== Grid WUD ===
 * Contributors: wistudatbe
 * Author: Danny WUD
 */
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( filter_var($parse_uri[0] . 'wp-load.php', FILTER_SANITIZE_STRING) );	
//Let's start again from here!
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
	if($_POST){	$grid_wud_or_popup = trim(filter_var($_POST['popup'], FILTER_SANITIZE_STRING));	}
	if (get_option('grid_wud_popup')=='1' || $grid_wud_or_popup =='1'){
		$jquerywud = get_option('grid_wud_def_jq');
		$jq_script = '<script type="text/javascript" src="'.$jquerywud.'"></script>';
		echo $jq_script;
	}
	if($_POST)
	{
		$buttons = trim(filter_var($_POST['buttons'], FILTER_SANITIZE_STRING));
		$group_more = explode(" ",filter_var($_POST['group_more'], FILTER_SANITIZE_STRING));
		$grid_wud_widget = trim(filter_var($_POST['grid_wud_widget'], FILTER_SANITIZE_STRING));
		$tiles = trim(filter_var($_POST['tiles'], FILTER_SANITIZE_STRING));
		$background = trim(filter_var($_POST['background'], FILTER_SANITIZE_STRING));
		$widgetfront = trim(filter_var($_POST['widgetfront'], FILTER_SANITIZE_STRING));
		$count_tag = trim(filter_var($_POST['count_tag'], FILTER_SANITIZE_STRING));
		$dark_excerpt = trim(filter_var($_POST['dark_excerpt'], FILTER_SANITIZE_STRING));
		$grid_wud_shape = trim(filter_var($_POST['grid_wud_shape'], FILTER_SANITIZE_STRING));
		$args1 = unserialize(base64_decode(filter_var($_POST['args1'], FILTER_SANITIZE_STRING)));
		$args2 = unserialize(base64_decode(filter_var($_POST['args2'], FILTER_SANITIZE_STRING)));
		$args3 = unserialize(base64_decode(filter_var($_POST['args3'], FILTER_SANITIZE_STRING)));
		$args4 = unserialize(base64_decode(filter_var($_POST['args4'], FILTER_SANITIZE_STRING)));
		$args5 = unserialize(base64_decode(filter_var($_POST['args5'], FILTER_SANITIZE_STRING)));
		$args6 = unserialize(base64_decode(filter_var($_POST['args6'], FILTER_SANITIZE_STRING)));
		$args7 = unserialize(base64_decode(filter_var($_POST['args7'], FILTER_SANITIZE_STRING)));
		$args8 = unserialize(base64_decode(filter_var($_POST['args8'], FILTER_SANITIZE_STRING)));
		$args9 = unserialize(base64_decode(filter_var($_POST['args9'], FILTER_SANITIZE_STRING)));
		$args10 = unserialize(base64_decode(filter_var($_POST['args10'], FILTER_SANITIZE_STRING)));		
		$grid_wud_button = trim(filter_var($_POST['grid_wud_button'], FILTER_SANITIZE_STRING));
		$grid_wud_or_woo = trim(filter_var($_POST['grid_wud_or_woo'], FILTER_SANITIZE_STRING));
		echo wud_grid_wud__group();
		echo '</div>';
	}

// Get the 'see more' image
	function wud_grid_wud__group(){

		global $gwfuncs, $grid_wud_or_woo, $grid_wud_or_popup, $tiles, $grid_wud_widget, $grid_wud_button, $result, $buttons, $posts, $args1, $args2, $args3, $args4, $args5, $args6, $args7, $args8, $args9, $args10, $count_tag, $dark_excerpt;
			    if($buttons==1){$posts = query_posts($args1);}	
			elseif($buttons==2){$posts = query_posts($args2);}	
			elseif($buttons==3){$posts = query_posts($args3);}
			elseif($buttons==4){$posts = query_posts($args4);}
			elseif($buttons==5){$posts = query_posts($args5);}
			elseif($buttons==6){$posts = query_posts($args6);}	
			elseif($buttons==7){$posts = query_posts($args7);}	
			elseif($buttons==8){$posts = query_posts($args8);}
			elseif($buttons==9){$posts = query_posts($args9);}
			elseif($buttons==10){$posts = query_posts($args10);}
			
			if(intval($grid_wud_widget)==0){$grid_wud_widget=0;}
			$collection=collectgrids($posts);
			$result .= $collection; 
			return $result;	
	}	
	
?>