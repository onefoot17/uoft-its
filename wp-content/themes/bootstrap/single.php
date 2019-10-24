<?php get_header(); ?>

<div class="row-fluid">

<div class="wrapper">

    <div id="blackboard_container" style="background:none;">

    		<!--blackboard_left_container-->

			<div id="blackboard_right_container">

            		<?php 

					global $post;

					wp_reset_query();

					if (have_posts()) : while (have_posts()) : the_post(); ?>



                    <!--<article class="post" id="post-<?php the_ID(); ?>">-->

            

                        <h2><?php the_title(); ?></h2>

            

                       <!-- <div class="entry-content">-->

            

                        <?php the_content(); ?>

            

                       <!-- </div>-->

            

                    <!--</article>-->

            

                    <?php endwhile; ?>

            

                    <?php //wp_pagenavi(); ?> 

            

                <?php else : ?>

            

                    <h2>Not Found</h2>

            

                <?php endif; ?>



            </div>

    </div>

    

    <!--<div id="slideshow" class="carousel slide clearfix hidden-phone">

       

       <div class="carousel-inner">

		<?php

		

           /* $first = true;

            $the_query = new WP_Query('post_type=slideshow');

            if ($the_query->have_posts()) :

                while ($the_query->have_posts()) : $the_query->the_post()*/

        ?>



		<?php

			/*if ($first == true) {

			    echo '<div class="item active">';

			    $first = false;

			} else {

			    echo '<div class="item">';

			}*/

		?>



			<a href="<?php //echo the_permalink(); ?>" title="<?php //the_title(); ?>"><?php //the_post_thumbnail('slideshow'); ?></a>

			<div class="carousel-caption">

			    <h3><a href="<?php //echo the_permalink(); ?>" title="<?php //the_title(); ?>"><?php ///the_title(); ?></a></h3>

			    <?php //the_excerpt(); ?>            

			</div>

		    </div>

		    <?php

		//endwhile;

		//wp_reset_query();

	    //endif;

	?>

   </div>-->

   

   

</div>

</div>

    



<?php get_footer(); ?>
