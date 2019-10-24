<?php 
/*
  Template Name: Projects
 */
get_header();

?>
<?php if ( function_exists( 'breadcrumb_trail' ) ) breadcrumb_trail(); ?>
<div class="row-fluid">
	<div class="wrapper">
		<div class="padding">
		<?php while (have_posts()) : the_post(); ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
			<?php the_content(); ?>
		<?php
			$args = array('sort_order' => 'ASC', 'post_parent' => $post->ID, 'post_type' => 'page', 'post_status' => 'publish' ); 		
			$s = new WP_Query($args); 
		?>	
		<ul class="services-list">
			<li class="services-table-heading">
				<dl class="row">
					<dt class="span2">Status</dt>
					<dt class="span3">Project</dt>
					<dd class="span7">Summary</dd>
				</dl>
			</li>
			</li>
			<?php while ($s->have_posts()) : $s->the_post(); ?>
			<li>
				<dl>
					<dt class="span2"><?php $field = get_field_object('status'); $value = get_field('status'); $label = $field['choices'][ $value ]; echo $label; ?></dt>
					<dt class="span3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dt>
					<dd class="span7"><?php echo get_the_excerpt(); ?></dd>
				</dl>
			</li>
			<?php endwhile; ?>
		</ul>
		<?php endwhile; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
