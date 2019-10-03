<?php get_header(); ?>

<div class="row-fluid">

    <div class="span12">

        <?php
        the_post();
        global $post;
        ?>
        <div id="post-<?php the_ID() ?>" <?php post_class() ?>>
            <?php include(tribe_get_current_template()) ?>

        </div><!-- post -->
        <?php
        if (tribe_get_option('showComments', 'no') == 'yes') {
            comments_template();
        }
        ?>

    </div> <!-- end span12 -->
</div> <!-- end row -->


<?php get_footer() ?>