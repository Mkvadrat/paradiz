<?php
/*
Template name: Event page
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
		<div class="header-banner-block header-shares" data-speed="2" data-type="background" style="background-image: url( '<?php echo $image_background[0] ? $image_background[0] : esc_url( get_template_directory_uri() ) . '/wp-content/themes/paradiz/images/bg-first-block.png'; ?>' );">
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
					<?php echo get_post_meta( get_the_ID(), 'title_text_event_page', $single = true ); ?>
					
					<ul class="list-galery">
						<?php
							global $nggdb;
							$slider_id = getNextGallery(get_the_ID(), 'album_event_page');
							$slider_image = $nggdb->get_gallery($slider_id[0]["ngg_id"], 'sortorder', 'ASC', false, 0, 0);
							if($slider_image){
								foreach($slider_image as $image) {
						?>
							<li style="background-image: url( <?php echo nextgen_esc_url($image->imageURL); ?> );">
								<a class="button-transparent red-color fancybox" data-caption="<?php echo htmlspecialchars_decode($image->alttext); ?>"  href="<?php echo nextgen_esc_url($image->imageURL); ?>" data-fancybox="images">Подробнее</a>
							</li>
						<?php
								}
							}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>