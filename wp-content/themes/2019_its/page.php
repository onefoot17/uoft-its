<?php
    get_header();

    if(count($post->ancestors)==3) {
        $varParent = $post->ancestors[1];
        
        $varCurrentID = $post->ancestors[0];
        $varDepth2 = 1;
    } elseif(count($post->ancestors)==2) {
        $varParent = $post->ancestors[0];
        $varDepth2 = 1;
        $varCurrentID = $post->ID;
    } else {
        $varParent = $post->ID;		
        $varDepth1 = $post->ID;
    }
?>

<main class="content legacy">
    <section class="section__width">
        <?php if ( function_exists( 'breadcrumb_trail' ) ) breadcrumb_trail(); ?>

        <div id="quick_nav_container" class="featured" style="display:none;">
            <?php
                $args = array('sort_order' => 'ASC','child_of' => $varParent, 'parent' => -1, 'offset' => 0, 'post_type' => 'page', 'post_status' => 'publish' ); 
                    
                $FeaturedPage = get_pages($args); 
                
                global $wpdb;

                foreach( $FeaturedPage as $valPage ) {
                    if ( get_depth( $valPage -> ID) == 2 ) {
                        $varQueryStr = "SELECT post_id FROM  $wpdb->postmeta where post_id='$valPage->ID'  && meta_key='dbt_checkbox'";

                        $newsFeaturedPage  = $wpdb->get_results($varQueryStr, OBJECT);

                        if($newsFeaturedPage[0]->post_id && count($post->ancestors) > 0) {
                            $varArrdept2Page[] = $valPage->ID;	
                        }else {
                            $Arrdept2Page[] = $valPage->ID;
                        }
                    }
                }

                if($varArrdept2Page) {
                    $varArrdept2PageIDS	= implode(",",$varArrdept2Page);
                }
                
                if($varArrdept2PageIDS) {
                    $args = array('sort_order' => 'ASC', 'hierarchical' => 2,'meta_key' => 'dbt_checkbox', 'include' => $varArrdept2PageIDS, 'parent' => -1,        'offset' => 0, 'post_type' => 'page', 'post_status' => 'publish' ); 
                    $FeaturedPage = get_pages($args); 
            ?>

            <ul>
                <?php
                    $i = 1;

                    foreach($FeaturedPage as $post) : setup_postdata($post);
                    
                    $newsFeaturedpageImage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );

                    $arrFeaturedID[] = $post->ID;

                    if($i>4) break;
                ?>

                <li> 
                    <figure>
                        <?php if( $newsFeaturedpageImage[0] ){?>
                            <img src="<?php echo $newsFeaturedpageImage[0];?>" alt="" title=""/>
                            <?php } else { ?>

                            <img src="<?php bloginfo('template_directory');?>/images/default.jpg" alt="" title="" />
                        <?php } ?>
                    </figure>

                    <span>
                        <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
                    </span>
                    
                    <?php
                        $varQueryStr2 = "SELECT ID FROM $wpdb->posts where post_parent='$post->ID' && post_status='publish' ORDER BY `$wpdb->posts`.`ID` DESC ";

                        $newsFeaturedSubPage  = $wpdb->get_results($varQueryStr2, OBJECT);
                    
                        if( $newsFeaturedSubPage ) {
                    ?>
                    
                    <a href="#">
                        <img src="<?php bloginfo('template_directory'); ?>/images/aero_img.png" class="aero" />
                    </a>
        
                    <ul style="display:none;">
                        <?php foreach( $newsFeaturedSubPage as $subpages ){ 
                            $varSubPage = get_post( $subpages->ID );
                                if($varSubPage->post_title) {
                        ?>
                        <li><span><a href="<?php echo get_page_link($subpages->ID); ?>"><?php echo $varSubPage->post_title;?></a></span></li>
                        <?php }
                        
                        } ?>                  
                    </ul>
                    
                    <?php } ?>
                </li>

                <?php
                    $i++;
                    endforeach;
                ?>
            </ul>
            <?php } ?>
        </div><!--quick_nav_container-->

        <?php
			if($Arrdept2Page) {
		?>
        <div id="blackboard_container">
			<div id="blackboard_left_container">
				<!-- Below mentioned code for depth 1 or greater -->
				<?php if( count($post->ancestors) > 0 ) { ?>
                    <ul class="left_ul">
                        <?php
                            $varIncludeIDs = implode(",",$Arrdept2Page);
                        
                            $args = array(
                                'sort_order' => 'ASC',
                                'include' => $varIncludeIDs,
                                'parent' => -1,
                                'offset' => 0,
                                'post_type' => 'page',
                                'post_status' => 'publish'
                            );

                            $Page = get_pages($args);
                            
                            foreach($Page as $post) {
                                setup_postdata($post);
                                
                                $varQueryStr2 = "SELECT ID FROM $wpdb->posts where post_parent='$post->ID' and post_status='publish' ORDER BY `$wpdb->posts`.`ID` DESC ";

                                $newsFeaturedSubPage  = $wpdb->get_results($varQueryStr2, OBJECT);
                        ?>

                        <li>
                            <?php 
                                if( $newsFeaturedSubPage ) { ?>
                                    <?php if( $varDepth2 != "" && $varCurrentID == $post -> ID ){?>
                                        <i class="fas fa-angle-down"></i>
                                    <?php } else { ?>
                                        <i class="fas fa-angle-right"></i>
                                    <?php } ?>
                                <?php } else { ?>
                                    <i class="fas fa-square"></i>
                                <?php } ?>

                                <a href="<?php the_permalink(); ?>#<?php echo $post->ID;?>"><?php the_title(); ?></a>
                            </li>
                                    
                            <?php if( $newsFeaturedSubPage ) { ?>
                                <li><ul class="sub_list" <?php if( $varDepth2 != "" && $varCurrentID == $post -> ID ){ ?>style="display:block;"<?php } else { ?>style="display:none;"<?php } ?>
                            >

                            <?php foreach( $newsFeaturedSubPage as $subpages ){
                                $varSubPage = get_post($subpages->ID);
                                    if($varSubPage->post_title) {
                                ?>

                                <li>
                                    <i class="fas fa-angle-right"></i>
                                    
                                    <a href="<?php echo get_page_link($varSubPage->ID); ?>#<?php echo $subpages->ID;?>"><?php echo $varSubPage->post_title; ?></a>
                                </li>
                            <?php } 
                            }
                        ?> 
                    </ul></li>
                    <?php } ?> 
                </li>
                    <?php } ?>
                </ul>  
			<?php } else { ?>
                <!-- Below mentioned code for Root pages -->
                    <ul class="left_ul">
                        <?php
                            $args = array(
                                'sort_order' => 'ASC',
                                'child_of' => $varParent,
                                'depth' => 1,
                                'parent' => $varParent,
                                'offset' => 0,
                                'post_type' => 'page',
                                'post_status' => 'publish'
                            );
                            
                            $Page = get_pages($args); 
                            
                            foreach( $Page as $post ) {
                                setup_postdata($post);
                        ?>

                            <li>
                                <small>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </small>
                            </li>
                        </li>
                    <?php } ?>
                </ul>

			<?php } ?>
			</div>

			<div id="blackboard_right_container">
				<?php 
					wp_reset_query();

					if (have_posts()) : while (have_posts()) : the_post();
				?>

				<a id="<?php echo $post->ID;?>" name="<?php echo $post->ID;?>" ></a>

                    <h2><?php the_title(); ?></h2>
				
					<?php the_content(); ?>
				
					<?php endwhile; ?>
					<?php else : ?>
						<h2>Not Found</h2>
					<?php endif; ?>
				</div><!--blackboard_left_container-->
		</div>
		<?php  } else { ?>
			<div id="blackboard_container">
				<div id="blackboard_right_container">
					<?php 
						wp_reset_query();

						if (have_posts()) : while (have_posts()) : the_post();
					?>

                        <h2><?php the_title(); ?></h2>
                        
                        <?php the_content(); ?>
					<?php endwhile; ?>

					<?php else : ?>
						<h2>Not Found</h2>
					<?php endif; ?>
				</div>		
			</div>           
		<?php } ?>
    </section>
</main>

<?php get_footer(); ?>
