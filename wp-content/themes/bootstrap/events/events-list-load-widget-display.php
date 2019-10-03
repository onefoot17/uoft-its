<?php

$event = array();
$tribe_ecp = TribeEvents::instance();
reset($tribe_ecp->metaTags);
foreach ($tribe_ecp->metaTags as $tag) {
    $var_name = str_replace('_Event', '', $tag);
    $event[$var_name] = tribe_get_event_meta($post->ID, $tag, true);
}

$event = (object) $event; //Easier to work with.

ob_start();
if (!isset($alt_text)) {
    $alt_text = '';
}
post_class($alt_text, $post->ID);
$class = ob_get_contents();
ob_end_clean();
?>
<li <?php echo $class ?>>
    <div class="event_date">
	<?php
	$date = strtotime(tribe_get_start_date($post->ID));
	echo date('M d, Y', $date);
	?> 
    </div>
    <div class="event_title">
	<a href="<?php echo get_permalink($post->ID) ?>"><?php echo $post->post_title ?></a>
    </div>
</li>
<br/>
<?php $alt_text = ( empty($alt_text) ) ? 'alt' : ''; ?>
