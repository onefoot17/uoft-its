<?php 
/*
  Template Name: Project Detail
 */
get_header();

?>
<?php if ( function_exists( 'breadcrumb_trail' ) ) breadcrumb_trail(); ?>
<div class="row-fluid">
	<div class="wrapper">
		<div class="padding">
		<?php while (have_posts()) : the_post(); ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
			<nav class="span3" id="pagelinks">
				<ul>
				</ul>
			</nav>
			<section class="span9">
				<h2>Overview</h2>
				<?php the_content(); ?>
				<?php if (get_field('features_benefits')) { ?>
				<hr />
				<h2>Status</h2>
				<?php $field = get_field_object('status'); $value = get_field('status'); $label = $field['choices'][ $value ]; echo $label; ?>
				<hr />
				<h2>Benefits</h2>
				<?php the_field('benefits'); ?>
				<?php } ?>
				<?php if (get_field('requirements')) { ?>
				<hr />
				<h2>Partnership</h2>
				<?php the_field('partnership'); ?>
				<?php } ?>
				<?php if (get_field('costs')) { ?>
				<hr />
				<h2>Contact for Further Information</h2>
				<?php the_field('costs'); ?>
				<?php } ?>
				<?php if (get_field('further_information')) { ?>
				<hr />
				<h2>Last Update</h2>
				<?php the_field('update'); ?>
				<?php } ?>
				<?php if (get_field('getting_started')) { ?>
				<hr />
				<?php } ?>
			</section>
		<?php endwhile; ?>
		</div>
   </div>
</div>
<?php get_footer(); ?>