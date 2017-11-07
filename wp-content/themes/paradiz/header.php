<?php
/*
Theme Name: Paradiz
Theme URI: http://paradiz.loc/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта http://paradiz.loc/
Version: 1.0
*/
?>

<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo paradiz_wp_title('','', true, 'right'); ?></title>
	<base href="#">
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"> 
	
	<!-- MMENU -->
	<link type="text/css" rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/demo.css" />
	
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/reset.css">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/fonts.css">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/styles.css">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/media.css">
	
	<!-- HTML5 for IE -->
	<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!-- Bootstrap -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	
	<!-- Font awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	
	<!-- OWL-CAROUSEL -->
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/owl.carousel.min.js"></script>
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/owl.theme.default.min.css">
	
	<!-- FANCYBOX -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.20/jquery.fancybox.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.20/jquery.fancybox.min.js"></script>
	
	<!-- MMENU -->
	<link type="text/css" rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/jquery.mmenu.all.css" />
	<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.mmenu.all.js"></script>
	
	<!-- common js -->
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/common.js"></script>
	
	<!-- sweetalert -->
	<link type="text/css" rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/sweetalert.css" />
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/sweetalert.min.js"></script>
	
	<!-- mask -->
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/mask.js"></script>
	
	<!-- timepicker -->
	<link type="text/css" rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/jquery.timepicker.css" />
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.timepicker.min.js"></script>
	
	<!-- jquery ui -->
	<link type="text/css" rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery-ui-1.12.1/jquery-ui.min.css" />
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery-ui-1.12.1/jquery-ui.min.js"></script>

	<?php wp_head(); ?>

</head>
<body>
	
	<!-- start mobile header -->

	<div id="page">
		<div class="header-mobile">
			<div class="header">
				<a href="#menu"><span></span></a>
				Demo
			</div>
			<nav id="menu">
				<ul>
					<li><a href="#">кампании</a></li>
					<li><a href="#contact">брендинг</a></li>
					<li><a href="#contact">фестивали</a></li>
					<li><a href="#contact">кадры</a></li>
					<li><a href="#contact">рейтинги</a></li>
					<li><a href="#contact">статьи</a></li>
					<li><a href="#contact">дежавю</a></li>
					<li><a href="#contact">золото</a></li>
					<li><a href="#contact">топпроект</a></li>
				</ul>
			</nav>
		</div>
	
		<!-- end mobile header -->
	
		<div id="toTop" ><i class="fa fa-arrow-circle-up" aria-hidden="true"></i></div>
		
		<?php echo getMeta('social_links_main_page'); ?>
		
		<?php if( is_front_page() ) { ?>
			<!-- start header -->
			
			<header class="header-page-main">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<!-- start top-line -->
							<div class="top-line">
								<div class="left-block">
									
									<div class="logo-block">
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
											<img src="<?php echo getImageLink('primary_logotype_main_page'); ?>" alt="<?php echo getAltImage('primary_logotype_main_page'); ?>">
										</a>
									</div>
									
									<div class="description-logo">
										<?php echo getMeta('slogan_site_main_page'); ?>
									</div>
									
								</div>
								<div class="right-block">
									
									<?php echo getMeta('reservation_links_main_page'); ?>
									
									<div class="phones-block">
										<?php echo getMeta('contact_informations_main_page'); ?>
									</div>
								</div>
							</div>
							<!-- end top-line -->
						</div>
						<div class="col-md-12">
							<!-- start bottom-line (menu) -->
							
							<?php
								if (has_nav_menu('header_menu')){
									wp_nav_menu( array(
										'theme_location'  => 'header_menu',
										'menu'            => '',
										'container'       => false,
										'container_class' => '',
										'container_id'    => '',
										'menu_class'      => '',
										'menu_id'         => '',
										'echo'            => true,
										'fallback_cb'     => 'wp_page_menu',
										'before'          => '',
										'after'           => '',
										'link_before'     => '',
										'link_after'      => '',
										'items_wrap'      => '<nav class="menu"><ul>%3$s</ul></nav>',
										'depth'           => 3,
										'walker'          => new header_menu(),
									) );
								}
							?>
	
							<!-- end bottom-line (menu) -->
						</div>
					</div>
				</div>
			</header>
			
			<!-- end header -->
		<?php }else{ ?>
		
			<header class="header-page-main header-other-page">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<!-- start top-line -->
							<div class="top-line">
								<div class="left-block">
									<div class="logo-block">
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
											<img src="<?php echo getImageLink('second_logotype_main_page'); ?>" alt="<?php echo getAltImage('second_logotype_main_page'); ?>">
										</a>
									</div>
									<div class="description-logo">
										<?php echo getMeta('slogan_site_main_page'); ?>
									</div>
								</div>
								<div class="right-block">
									
									<?php echo getMeta('reservation_links_main_page'); ?>
									
									<div class="phones-block">
										<?php echo getMeta('contact_informations_main_page'); ?>
									</div>
								</div>
							</div>
							<!-- end top-line -->
						</div>
						<div class="col-md-12">
							<!-- start bottom-line (menu) -->
							
							<?php
								if (has_nav_menu('header_menu')){
									wp_nav_menu( array(
										'theme_location'  => 'header_menu',
										'menu'            => '',
										'container'       => false,
										'container_class' => '',
										'container_id'    => '',
										'menu_class'      => '',
										'menu_id'         => '',
										'echo'            => true,
										'fallback_cb'     => 'wp_page_menu',
										'before'          => '',
										'after'           => '',
										'link_before'     => '',
										'link_after'      => '',
										'items_wrap'      => '<nav class="menu"><ul>%3$s</ul></nav>',
										'depth'           => 3,
										'walker'          => new header_menu(),
									) );
								}
							?>
							
							<!-- end bottom-line (menu) -->
						</div>
					</div>
				</div>
			</header>
		<?php } ?>