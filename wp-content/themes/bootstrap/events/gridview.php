<?php
$tribe_ecp = TribeEvents::instance();
?>	
<div id="tribe-events-content" class="grid">
    <!-- This title is here for pjax loading - do not remove if you wish to use ajax switching between month views -->
    <title><?php wp_title() ?></title>
    <div id='tribe-events-calendar-header' class="clearfix">
        <span class='tribe-events-month-nav'>
            <span class='tribe-events-prev-month'>
                <a href='<?php echo tribe_get_previous_month_link(); ?>'>
                    &#x2190; <?php echo tribe_get_previous_month_text(); ?>
                </a>
            </span>

            <?php tribe_month_year_dropdowns("tribe-events-"); ?>

            <span class='tribe-events-next-month'>
                <a href='<?php echo tribe_get_next_month_link(); ?>'>				
                    <?php echo tribe_get_next_month_text(); ?> &#x2192; 
                </a>
                <img src="<?php echo esc_url(admin_url('images/wpspin_light.gif')); ?>" class="ajax-loading" id="ajax-loading" alt="" style='display: none'/>
            </span>
        </span>

    </div><!-- tribe-events-calendar-header -->
    <?php tribe_calendar_grid(); // See the views/table.php template for customization ?>
    <?php if (function_exists('tribe_get_ical_link')): ?>
        <a title="<?php esc_attr_e('iCal Import', 'tribe-events-calendar') ?>" class="ical" href="<?php echo tribe_get_ical_link(); ?>"><?php _e('iCal Import', 'tribe-events-calendar') ?></a>
    <?php endif; ?>
</div>

