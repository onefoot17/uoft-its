<?php 
/*
Template Name: ITS ESC Help Landing Template
*/
?>

<?php get_header(); ?>

<main class="content legacy">
    <?php $has_notice_alert_box = get_field( "notice_alert_box" ); ?>
    <?php $has_left_column_content = get_field( "left_column_content" ); ?>
    <?php $has_right_column_content = get_field( "right_column_content" ); ?>

    <?php if ( function_exists( 'breadcrumb_trail' ) ) breadcrumb_trail(); ?>

    <style type="text/css">
        
        .alert p:last-child {
            margin-bottom: 0;
        }

        .alert-info {
            color: #333333; /*For proper colour contrast with the background*/
        }

        .btn-primary-uoft {
            background-color: #002A5C !important;
            background-image: none;
        }

        .column-divider {
            border-top: 1px solid #666;
            padding-top: 20px;
        }

        @media (min-width: 767px) {
            .column-divider {
                border-top: none;
                border-left: 1px solid #666; 
                padding-left: 40px;
                padding-top: 0;
            }

            .column-divider-space-only {
                padding-right: 40px;
            }
        }
        
    </style>

    <div class="row-fluid">
        <div class="span12">
            <?php if($has_notice_alert_box): ?>
                <div class="alert alert-info" style="margin-top: 15px;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php the_field('notice_alert_box'); ?>
                </div>
            <?php endif; ?>
        </div>


        <div class="span12">
            <h2><?php the_title(); ?></h2>
            <?php the_content(); ?>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span6 column-divider-space-only">
            <?php the_field('left_column_content'); ?>
        </div>

        <div class="span6 column-divider">
            <?php the_field('right_column_content'); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>

<script type="text/javascript">
    jQuery(".alert").alert();
</script>
