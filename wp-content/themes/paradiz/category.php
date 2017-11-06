<?php
/*
Theme Name: Paradiz
Theme URI: http://paradiz.loc/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта http://paradiz.loc/
Version: 1.0
*/

get_header(); 
?>
    
	<!-- start main-shares -->
	
	<div class="main-shares">
	
		<!-- start header-banner-block -->
		<?php
			$image_background = getImageLinkCategory('category','image_special_action_category');
		?>
		<div class="header-banner-block header-shares" data-speed="2" data-type="background" style="background-image: url( '<?php echo $image_background ? $image_background : esc_url( get_template_directory_uri() ) . '/images/bg-header-shares.jpg'; ?>' );">
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
					<?php
						echo getDataCategory('category','title_special_action_category');
					?>
					
					<?php
						$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$args = array(
							'tax_query' => array(
								array(
									'taxonomy' => 'category',
									'terms' => getCurrentCatID()
								)
							),
							'post_type'   => 'post',
							'orderby'     => 'date',
							'order'       => 'DESC',
							'posts_per_page' => $GLOBALS['wp_query']->query_vars['posts_per_page'],
							'paged'          => $current_page,

						);
			
						$action_list = get_posts( $args );
					?>
					<ul class="list-shares">
						<?php if($action_list){ ?>
						<?php foreach($action_list as $action){ ?>
						<?php
							$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($action->ID), 'full');
							$descr = wp_trim_words( get_post_meta( $action->ID, 'short_description_special_action_page', $single = true ), 30, '...' );
							$link = get_permalink($action->ID);
							$date_end = get_post_meta( $action->ID, 'end_special_action_page', $single = true );
						?>
						<li>
						<div class="block-photo" style="background-image: url( '<?php echo $image_url[0] ? $image_url[0] : esc_url( get_template_directory_uri() ) . '/images/bg-shares-list.jpg'; ?>' );">
						<a class="button-transparent red-color" href="<?php echo $link; ?>">Подробнее</a>
						</div>
						<div class="description">
						<p class="red-title-second"><a href="<?php echo $link; ?>"><?php echo $action->post_title; ?></a></p>
						<p><?php echo htmlspecialchars_decode($descr); ?></p>
						<?php if($date_end){ ?>
							<p class="p-italic">Действует до <strong><?php echo $date_end; ?></strong></p>
						<?php } ?>
						</div>
						</li>
						<?php } ?>
						<?php wp_reset_postdata(); ?>
						<?php }else{ ?>
						<li>В данной категории акций не найдено!</li>
						<?php } ?>
					</ul>
					<?php
						$defaults = array(
							'type' => 'array',
							'prev_next'    => True,
							'prev_text'    => __(''),
							'next_text'    => __(''),
						);
	
						$pagination = paginate_links($defaults);
						
					if($pagination){
					?>

                    <ul class="bread-crumbs">
						<?php foreach ($pagination as $pag){ ?>
	                        <li><?php echo $pag; ?></li>
						<?php } ?>
                    </ul>
					<?php } ?>
					
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>