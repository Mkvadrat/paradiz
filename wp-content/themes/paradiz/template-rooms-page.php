<?php
/*
Template name: Rooms page
Theme Name: Paradiz
Theme URI: http://paradiz.loc/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта http://paradiz.loc/
Version: 1.0
*/

get_header(); 
?>

    <!-- start main-rooms -->
	<?php $background_block = getImageLink('background_images_rooms_page'); ?>
    <div class="main-rooms"  style="background-image: url( '<?php echo $background_block ? $background_block : esc_url( get_template_directory_uri() ) . '/images/bg-rooms.jpg'; ?>' );">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php echo get_post_meta( get_the_ID(), 'link_rooms_page', $single = true ); ?>
					
					<div class="description-block">
						<?php if (have_posts()): while (have_posts()): the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; endif; ?>
					</div>
				</div>
			</div>
		</div>
    </div>

    <!-- end main-slider-block -->

<?php get_footer(); ?>