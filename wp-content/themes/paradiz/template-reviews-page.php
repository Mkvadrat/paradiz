<?php

/*

Template name: Reviews page

Theme Name: Paradiz

Theme URI: http://paradiz.loc/

Author: M2

Author URI: http://mkvadrat.com/

Description: Тема для сайта http://paradiz.loc/

Version: 1.0

*/



get_header(); 

?>



	<!-- start main-reviews -->

	

	<div class="main-reviews">

	

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

					<?php echo get_post_meta( get_the_ID(), 'title_text_reviews_page', $single = true ); ?>

				</div>

				<div class="col-md-4">

					<aside class="sidebar">

						<div class="form-block">

							<p class="title-sidebar">ОСТАВИТЬ ОТЗЫВ</p>

							<form class="reviews-form" id="commentform">

								<label for="name">Ваше имя*</label>

								<input name="author" id="author" type="text">
								
								<label for="email">Ваш Email*</label>

								<input name="email" id="email" type="text">

								<label for="text-review">Текст отзыва*</label>

								<textarea name="comment" id="comment"></textarea>

								<?php echo get_post_meta( get_the_ID(), 'link_personal_data_reviews_page', $single = true ); ?>

								<?php echo comment_id_fields(); ?> 

							</form>

							<div class="respond"></div>

							<input type="submit" onclick="submit();" value="оставить отзыв">

						</div>

					</aside>

				</div>

			<div class="col-md-8">

				<?php 

				

					define( 'DEFAULT_COMMENTS_PER_PAGE', $GLOBALS['wp_query']->query_vars['comments_per_page']);

				

					$page = (get_query_var('page')) ? get_query_var('page') : 1;

				

					$limit = DEFAULT_COMMENTS_PER_PAGE;

				

					$offset = ($page * $limit) - $limit;

				

					$param = array(

						'status'	=> 'approve',

						'offset'	=> $offset,

						'number'	=> $limit

					);

				

					$total_comments = get_comments(array(

						'orderby' => 'comment_date',

						'order'   => 'ASC',

						'status'  => 'approve',

						'parent'  => 0

				

					));

				

					$pages = ceil(count($total_comments)/DEFAULT_COMMENTS_PER_PAGE);

				

					$comments = get_comments( $param );

				

					$args = array(

						'base'         => @add_query_arg('page','%#%'),

						'format'       => '?page=%#%',

						'total'        => $pages,

						'current'      => $page,

						'show_all'     => false,

						'mid_size'     => 4,

						'prev_next'    => true,

						'prev_text'    => __(''),

						'next_text'    => __(''),

						//'type'         => 'comment'

						'type' => 'array'

					);

					

					if($comments){

				?>

				<ul class="list-reviews">

					<?php

						foreach($comments as $comment){

							global $cnum;

					

							// определяем первый номер, если включено разделение на страницы

					

							$per_page = $limit;

					

							if( $per_page && !isset($cnum) ){

								$com_page = $page;

								if($com_page>1)

									$cnum = ($com_page-1)*(int)$per_page;

							}

							// считаем

							$cnum = isset($cnum) ? $cnum+1 : 1;

					?>

					<li>
						<?php
							$image_link = getImageComments($comment->comment_ID);
							if($image_link){
						?>
							<a class="fancybox" href="<?php echo $image_link; ?>"><img src="<?php echo $image_link; ?>" alt="" style="width: 100px;"></a>
						<?php } ?>
						
						<div class="description">
							
							<p class="title"><?php echo get_comment_author($comment->comment_ID); ?></p>

							<p><?php echo $comment->comment_content; ?></p>

							<time><?php comment_date( 'd.m.y', $comment->comment_ID ); ?></time>

						</div>

					</li>

					<?php } ?>

					

					<?php } ?>

				</ul>

			</div>

			<?php

				$pagination = paginate_links($args);

						

				if($pagination){

			?>

			<div class="col-md-12">

				<ul class="bread-crumbs">

					<?php foreach ($pagination as $pag){ ?>

						<li><?php echo $pag; ?></li>

					<?php } ?>

				</ul>

			</div>

			<?php } ?>

			</div>

		</div>

	</div>

	

<script language="javascript">

    function submit(){

        $(".reviews-form").submit();

    }

</script>



<?php get_footer(); ?>