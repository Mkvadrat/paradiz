<?php
/*
Template name: Standart page
Theme Name: Paradiz
Theme URI: http://paradiz.loc/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта http://paradiz.loc/
Version: 1.0
*/

get_header(); 
?>

    <!-- start main-galery -->
	
	<div class="main-galery">
	
		<!-- start header-banner-block -->
		<?php
			$image_background = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');
		?>
		<div class="header-banner-block header-shares" data-speed="2" data-type="background" style="background-image: url( '<?php echo $image_background[0] ? $image_background[0] : esc_url( get_template_directory_uri() ) . '/images/bg-first-block.png'; ?>' );">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="title-header-block">
							<p class="title"><?php echo get_title(); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- end header-banner-block -->
		
		<div class="container content-page">
			<div class="row">
				<div class="col-md-12">
					<?php if (have_posts()): while (have_posts()): the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; endif; ?>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>