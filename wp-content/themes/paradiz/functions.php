<?php
/*
Theme Name: Paradiz
Theme URI: http://paradiz.loc/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта http://paradiz.loc/
Version: 1.0
*/

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
****************************************************************************НАСТРОЙКИ ТЕМЫ*****************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
//Регистрируем название сайта
function paradiz_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	$title .= get_bloginfo( 'name', 'display' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'ug' ), max( $paged, $page ) );
	}

	if ( is_404() ) {
        $title = '404';
    }

	return $title;
}
add_filter( 'wp_title', 'paradiz_wp_title', 10, 2 );

//Регистрируем меню
if(function_exists('register_nav_menus')){
	register_nav_menus(
		array(
		  'header_menu' => 'Меню в шапке',
		  'mobile_menu' => 'Меню для мобильных устройств',
		  'footer_menu' => 'Меню в подвале',
		)
	);
}

//Вывод id категории
function getCurrentCatID(){
	global $wp_query;
	if(is_category()){
		$cat_ID = get_query_var('cat');
	}
	return $cat_ID;
}

//Отключить редактор
add_filter('use_block_editor_for_post', '__return_false');

//Добавление в тему миниатюры записи и страницы
if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
}

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
****************************************************************************МЕНЮ САЙТА*********************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
// Добавляем свой класс для пунктов меню:
class header_menu extends Walker_Nav_Menu {

	// Добавляем классы к вложенным ul
	function start_lvl( &$output, $depth ) {
		// Глубина вложенных ul
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'',
			( $display_depth % 2  ? '' : '' ),
			( $display_depth >=2 ? '' : '' ),
			''
			);
		$class_names = implode( ' ', $classes );
	
		// build html
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}

	// Добавляем классы к вложенным li
	function start_el( &$output, $item, $depth, $args ) {
		global $wpdb;
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
	
		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'has-sub' : '' ),
			( $depth >=2 ? '' : '' ),
			( $depth % 2 ? '' : '' ),
			'menu-item-depth-' . $depth
		);
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
	
		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
	
		$mycurrent = ( $item->current == 1 ) ? ' active' : '';
	
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
	
		$output .= $indent . '<li class="sub-menu">';
	
		// Добавляем атрибуты и классы к элементу a (ссылки)
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : ''; 
		$attributes .= ' class="menu-link ' . ( $depth == 0 ? 'parent' : '' ) . ( $depth == 1 ? 'child' : '' ) . ( $depth >= 2 ? 'sub-child' : '' ) . '"';
		
		if($depth == 0){
			$has_children = $wpdb->get_results( $wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = %s AND meta_key = '_menu_item_menu_item_parent'", $item->ID), ARRAY_A);
			
			$link  =  $item->url;
			$title = apply_filters( 'the_title', $item->title, $item->ID );
					
			if(!empty($has_children)){
				$item_output = '<a href="'. $link .'" class="drop-link">' . $title .' </a>';
			}else{
				$item_output = '<a href="'. $link .'">' . $title .'</a>';
			}
		}else if($depth == 1){
			$has_children = $wpdb->get_results( $wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = %s AND meta_key = '_menu_item_menu_item_parent'", $item->ID), ARRAY_A);
			
			$link  =  $item->url;
			$title = apply_filters( 'the_title', $item->title, $item->ID );
					
			if(!empty($has_children)){
				$item_output = '<a href="'. $link .'">' . $title .' </a>';
			}else{
				$item_output = '<a href="'. $link .'">' . $title .'</a>';
			}

		}else if($depth >= 2){
			$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
				$args->before,
				$attributes,
				$args->link_before,
				apply_filters( 'the_title', $item->title, $item->ID ),
				$args->link_after,
				$args->after
			);
		}
	
		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
**************************************************************************ЗАГОЛОВОК************************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/

function get_title($display = true) {
    global $wp_locale;
 
    $m        = get_query_var( 'm' );
    $year     = get_query_var( 'year' );
    $monthnum = get_query_var( 'monthnum' );
    $day      = get_query_var( 'day' );
    $search   = get_query_var( 's' );
    $title    = '';
 
    $t_sep = '%WP_TITLE_SEP%'; // Temporary separator, for accurate flipping, if necessary
 
    // If there is a post
    if ( is_single() || ( is_home() && ! is_front_page() ) || ( is_page() && ! is_front_page() ) ) {
        $title = single_post_title( '', false );
    }
 
    // If there's a post type archive
    if ( is_post_type_archive() ) {
        $post_type = get_query_var( 'post_type' );
        if ( is_array( $post_type ) ) {
            $post_type = reset( $post_type );
        }
        $post_type_object = get_post_type_object( $post_type );
        if ( ! $post_type_object->has_archive ) {
            $title = post_type_archive_title( '', false );
        }
    }
 
    // If there's a category or tag
    if ( is_category() || is_tag() ) {
        $title = single_term_title( '', false );
    }
 
    // If there's a taxonomy
    if ( is_tax() ) {
        $term = get_queried_object();
        if ( $term ) {
            $title = single_term_title( $t_sep, false );
        }
    }
 
    // If there's an author
    if ( is_author() && ! is_post_type_archive() ) {
        $author = get_queried_object();
        if ( $author ) {
            $title = $author->display_name;
        }
    }
 
    // Post type archives with has_archive should override terms.
    if ( is_post_type_archive() && $post_type_object->has_archive ) {
        $title = post_type_archive_title( '', false );
    }
 
    // If there's a month
    if ( is_archive() && ! empty( $m ) ) {
        $my_year  = substr( $m, 0, 4 );
        $my_month = $wp_locale->get_month( substr( $m, 4, 2 ) );
        $my_day   = intval( substr( $m, 6, 2 ) );
        $title    = $my_year . ( $my_month ? $t_sep . $my_month : '' ) . ( $my_day ? $t_sep . $my_day : '' );
    }
 
    // If there's a year
    if ( is_archive() && ! empty( $year ) ) {
        $title = $year;
        if ( ! empty( $monthnum ) ) {
            $title .= $t_sep . $wp_locale->get_month( $monthnum );
        }
        if ( ! empty( $day ) ) {
            $title .= $t_sep . zeroise( $day, 2 );
        }
    }
 
    // If it's a search
    if ( is_search() ) {
        /* translators: 1: separator, 2: search phrase */
        $title = sprintf( __( 'Search Results %1$s %2$s' ), $t_sep, strip_tags( $search ) );
    }
 
    // If it's a 404 page
    if ( is_404() ) {
        $title = __( 'Page not found' );
    }
 
    $prefix = '';
    if ( ! empty( $title ) ) {
        $prefix = " $sep ";
    }
 
    $title_array = apply_filters( 'wp_title_parts', explode( $t_sep, $title ) );
 
    // Determines position of the separator and direction of the breadcrumb
    if ( 'right' == $seplocation ) { // sep on right, so reverse the order
        $title_array = array_reverse( $title_array );
        $title       = implode( " $sep ", $title_array ) . $prefix;
    } else {
        $title = $prefix . implode( " $sep ", $title_array );
    }
 
    $title = apply_filters( '', $title, $sep, $seplocation );
 
    // Send it out
    if ( $display ) {
        echo $title;
    } else {
        return $title;
    }
}

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
*********************************************************************РАБОТА С METAПОЛЯМИ*******************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
//Вывод данных из произвольных полей для всех страниц сайта
function getMeta($meta_key){
	global $wpdb;
	
	$value = $wpdb->get_var( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = %s ORDER BY meta_id DESC LIMIT 1", $meta_key) );
	
	return $value;
}

//Получить урл изображения из произвольных полей
function getImageLink($meta_key){
	global $wpdb;
		
	$value = $wpdb->get_var( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = %s ORDER BY meta_id DESC LIMIT 1" , $meta_key));
	
	$link = $wpdb->get_var( $wpdb->prepare("SELECT guid FROM $wpdb->postmeta JOIN $wpdb->posts ON %s = ID AND meta_key = %d ORDER BY meta_id DESC LIMIT 1", $value, $meta_key));
			
	return $link;
}

function getNextGallery($post_id, $meta_key){
	global $wpdb;
	
	$value = $wpdb->get_var( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta AS pm JOIN $wpdb->posts AS p ON (pm.post_id = p.ID) AND (pm.post_id = %s) AND meta_key = %s ORDER BY pm.post_id DESC LIMIT 1", $post_id, $meta_key) );
	
	$unserialize_value = unserialize($value);
	
	return $unserialize_value;	
}

//Получить урл изображения из произвольных полей для таксономии рубрики
function getImageLinkCategory($taxonomy, $meta_key){
	global $wpdb;
	
	$term = get_queried_object();
	
	$cat_id = $term->term_id;
	
	$cat_data = get_option($taxonomy . '_' . $cat_id . '_' . $meta_key);
	var_dump($cat_data);
		
	$link = $wpdb->get_var( $wpdb->prepare("SELECT guid FROM $wpdb->posts WHERE ID = %s", $cat_data));
	
	return $link;
}

//Получить урл изображения из произвольных полей для таксономии single
function getImageLinkSingle($post_id, $meta_key){
	global $wpdb;
	
	$value = $wpdb->get_var( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = %s AND post_id = %d" , $meta_key, $post_id));
	
	$link = $wpdb->get_var( $wpdb->prepare("SELECT guid FROM $wpdb->posts WHERE ID = %s", $value));
	
	return $link;
}

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
*******************************************************************SEO PATH FOR IMAGE**********************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
function getAltImage($meta_key){
	global $wpdb;

	$post_id = $wpdb->get_var( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = %s ORDER BY meta_id DESC LIMIT 1" , $meta_key));

	$attachment = get_post( $post_id );

	return get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );
}

function getTitleImage($meta_key){
	global $wpdb;

	$post_id = $wpdb->get_var( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = %s ORDER BY meta_id DESC LIMIT 1" , $meta_key));

	$attachment = get_post( $post_id );

	return $attachment->post_title;
}

//Получить данные из произвольных полей для таксономии
function getDataCategory($taxonomy, $meta_key){
	global $wpdb;
	
	$term = get_queried_object();
	
	$cat_id = $term->term_id;
	
	$cat_data = get_option($taxonomy . '_' . $cat_id . '_' . $meta_key);
			
	return $cat_data;
}

//Получение изображения комментария
function getImageComments($comment_id){
	$post_id = get_comment_meta($comment_id, 'image_comments',true);
	
	$value = wp_get_attachment_image_src( $post_id, 'full' );
	
	return $value[0];
}

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
************************************************************ПЕРЕИМЕНОВАВАНИЕ ЗАПИСЕЙ В АКЦИИ***************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
function change_post_menu_label() {
    global $menu, $submenu;
    $menu[5][0] = 'Акции';
    $submenu['edit.php'][5][0] = 'Акции';
    $submenu['edit.php'][10][0] = 'Добавить акцию';
    $submenu['edit.php'][16][0] = 'Акционные метки';
    echo '';
}
add_action( 'admin_menu', 'change_post_menu_label' );

function change_post_object_label() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Акции';
    $labels->singular_name = 'Акции';
    $labels->add_new = 'Добавить акцию';
    $labels->add_new_item = 'Добавить акцию';
    $labels->edit_item = 'Редактировать акцию';
    $labels->new_item = 'Добавить акцию';
    $labels->view_item = 'Посмотреть акцию';
    $labels->search_items = 'Найти акцию';
    $labels->not_found = 'Не найдено';
    $labels->not_found_in_trash = 'Корзина пуста';
}
add_action( 'init', 'change_post_object_label' );

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
********************************************************************ФОРМЫ ОБРАТНОЙ СВЯЗИ*******************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
//Форма обратной связи для страницы контакты
function SendForm(){

	$form_adress = get_option('admin_email') . ', hotel-hersones@mail.ru';
	
	$site_url = $_SERVER['SERVER_NAME'];

	$alert = array(
		'status' => 0,
		'message' => ''
	);

	if (isset($_POST['name'])) {$name = $_POST['name']; if ($name == '') {unset($name);}}
	if (isset($_POST['surname'])) {$surname = $_POST['surname']; if ($surname == '') {unset($surname);}}
	if (isset($_POST['phone'])) {$phone = $_POST['phone']; if ($phone == '') {unset($phone);}}
	if (isset($_POST['email'])) {$email = $_POST['email']; if ($email == '') {unset($email);}}
	if (isset($_POST['guests'])) {$guests = $_POST['guests']; if ($guests == '') {unset($guests);}}
	if (isset($_POST['hall'])) {$hall = $_POST['hall']; if ($hall == '') {unset($hall);}}
	if (isset($_POST['date'])) {$date = $_POST['date']; if ($date == '') {unset($date);}}
	if (isset($_POST['time'])) {$time = $_POST['time']; if ($time == '') {unset($time);}}
	if (isset($_POST['message'])) {$message = $_POST['message']; if ($message == '') {unset($message);}}

	if (isset($name) && isset($surname) && isset($phone) && isset($guests) && isset($hall) && isset($date) && isset($time)){

		$address = $form_adress . ', megkvadrat@ya.ru';

		$headers  = "Content-type: text/html; charset=UTF-8 \r\n";
		$headers .= "From: $site_url\r\n";
		$headers .= "Bcc: birthday-archive@example.com\r\n";
		
		//$mes = "Имя: $name \nEmail: $email \nСообщение: $comment";
		
		$mes = '<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta name="viewport" content="width=device-width" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>ZURBemails</title>
		<style>
		img {
		max-width: 100%;
		}
		.collapse {
		margin:0;
		padding:0;
		}
		body {
		-webkit-font-smoothing:antialiased;
		-webkit-text-size-adjust:none;
		width: 100%!important;
		height: 100%;
		}

		a { color: #2BA6CB;}

		.btn {
		text-decoration:none;
		color: #FFF;
		background-color: #666;
		padding:10px 16px;
		font-weight:bold;
		margin-right:10px;
		text-align:center;
		cursor:pointer;
		display: inline-block;
		}

		p.callout {
		padding:15px;
		background-color:#ECF8FF;
		margin-bottom: 15px;
		}
		.callout a {
		font-weight:bold;
		color: #2BA6CB;
		}

		table.social {
		background-color: #ebebeb;

		}
		.social .soc-btn {
		padding: 3px 7px;
		font-size:12px;
		margin-bottom:10px;
		text-decoration:none;
		color: #FFF;font-weight:bold;
		display:block;
		text-align:center;
		}
		a.fb { background-color: #3B5998!important; }
		a.tw { background-color: #1daced!important; }
		a.gp { background-color: #DB4A39!important; }
		a.ms { background-color: #000!important; }

		.sidebar .soc-btn {
		display:block;
		width:100%;
		}

		table.head-wrap { width: 100%;}

		.header.container table td.logo { padding: 15px; }
		.header.container table td.label { padding: 15px; padding-left:0px;}

		table.body-wrap { width: 100%;}

		table.footer-wrap { width: 100%;	clear:both!important;
		}
		.footer-wrap .container td.content  p { border-top: 1px solid rgb(215,215,215); padding-top:15px;}
		.footer-wrap .container td.content p {
		font-size:10px;
		font-weight: bold;

		}

		h1,h2,h3,h4,h5,h6 {
		font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;
		}
		h1 small, h2 small, h3 small, h4 small, h5 small, h6 small { font-size: 60%; color: #6f6f6f; line-height: 0; text-transform: none; }

		h1 { font-weight:200; font-size: 44px;}
		h2 { font-weight:200; font-size: 37px;}
		h3 { font-weight:500; font-size: 27px;}
		h4 { font-weight:500; font-size: 23px;}
		h5 { font-weight:900; font-size: 17px;}
		h6 { font-weight:900; font-size: 14px; text-transform: uppercase; color:#ffffff;}

		.collapse { margin:0!important;}

		p, ul {
		font-family: Helvetica, Arial, "Lucida Grande", sans-serif;
		margin-bottom: 10px;
		font-weight: normal;
		font-size:14px;
		line-height:1.6;
		}
		p.lead { font-size:17px; }
		p.last { margin-bottom:0px;}

		ul li {
		font-family: Helvetica, Arial, "Lucida Grande", sans-serif;
		margin-left:5px;
		list-style-position: inside;
		}

		ul.sidebar {
		font-family: Helvetica, Arial, "Lucida Grande", sans-serif;
		background:#ebebeb;
		display:block;
		list-style-type: none;
		}
		ul.sidebar li { display: block; margin:0;}
		ul.sidebar li a {
		text-decoration:none;
		color: #666;
		padding:10px 16px;
		margin-right:10px;
		cursor:pointer;
		border-bottom: 1px solid #777777;
		border-top: 1px solid #FFFFFF;
		display:block;
		margin:0;
		}
		ul.sidebar li a.last { border-bottom-width:0px;}
		ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p { margin-bottom:0!important;}

		.container {
		font-family: Helvetica, Arial, "Lucida Grande", sans-serif;
		display:block!important;
		max-width:600px!important;
		margin:0 auto!important;
		clear:both!important;
		}

		.content {
		padding:15px;
		max-width:600px;
		margin:0 auto;
		display:block;
		}

		.content table { width: 100%; }

		.column {
		width: 300px;
		float:left;
		}
		.column tr td { padding: 15px; }
		.column-wrap {
		padding:0!important;
		margin:0 auto;
		max-width:600px!important;
		}
		.column table { width:100%;}
		.social .column {
		width: 280px;
		min-width: 279px;
		float:left;
		}


		.clear { display: block; clear: both; }

		@media only screen and (max-width: 600px) {

		a[class="btn"] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}

		div[class="column"] { width: auto!important; float:none!important;}

		table.social div[class="column"] {
		width:auto!important;
		}

		}
		</style>

		</head>

		<body bgcolor="#FFFFFF">

		<!-- HEADER -->
		<table class="head-wrap" bgcolor="#003576">
		<tr>
		<td></td>
		<td class="header container" >

		<div class="content">
		<table>
		<tr>

		<td align="left"><h6 class="collapse" style="font-weight: 900; font-size: 14px; text-transform: uppercase; color: #ffffff;">Ресторан "Парадиз"</td>
		<td align="right"><h6 class="collapse" style="font-weight: 900; font-size: 14px; text-transform: uppercase; color: #ffffff;">Обратная связь</h6></td>
		</tr>
		</table>
		</div>

		</td>
		<td></td>
		</tr>
		</table>

		<table class="body-wrap">
		<tr>
		<td></td>
		<td class="container" bgcolor="#FFFFFF">

		<div class="content">
		<table>
		<tr>
		<td>
		<!--<h3>Тема сообщения</h3>-->
		
		<p>Количество гостей: '.$guests.'</p>
		<p>Зал: '.$hall.'</p>
		<p>Дата и время визита: '.$date.', '.$time.'</p>
		<p>Коментарий: '.$message.'</p>
		<!-- Callout Panel -->
		<!-- social & contact -->
		<table class="social" width="100%">
		<tr>
		<td>
		<table align="left" class="column">
		<tr>
		<td>

		<h5 class="">Контактная информация:</h5>
		<br/>
		
		<p>Имя: <strong>'.$name.'</strong></p>
		<p>Фамилия: <strong>'.$surname.'</strong></p>
		<p>Email: <strong>'.$email.'</strong></p>
		<p>Телефон: <strong>'.$phone.'</strong></p>
		</td>
		</tr>
		</table>

		<span class="clear"></span>

		</td>
		</tr>
		</table>

		</td>
		</tr>
		</table>
		</div>

		</td>
		<td></td>
		</tr>
		</table>

		<table class="footer-wrap">
		<tr>
		<td></td>
		<td class="container"></td>
		<td></td>
		</tr>
		</table>

		</body>
		</html>';

		$send = mail($address, $email, $mes, $headers);

		if ($send == 'true'){
			$alert = array(
				'status' => 200,
				'message' => 'Ваше сообщение отправлено'
			);
		}else{
			$alert = array(
				'status' => 1,
				'message' => 'Ошибка, сообщение не отправлено!'
			);
		}
	}
	
	if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['phone']) && isset($_POST['guests'])
		&& isset($_POST['hall']) && isset($_POST['date']) && isset($_POST['time'])){
			
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$phone = $_POST['phone'];
		$guests = $_POST['guests'];
		$hall = $_POST['hall'];
		$date = $_POST['date'];
		$time = $_POST['time'];
				
		if ($name == '' || $surname == '' || $phone == '' || $guests == '' || $hall == '' || $date == '' || $time == '') {
			unset($name);
			unset($surname);
			unset($phone);
			unset($guests);
			unset($hall);
			unset($date);
			unset($time);
			
			$alert = array(
				'status' => 1,
				'message' => 'Ошибка, сообщение не отправлено! Заполните все поля!'
			);
		}
	}

	echo wp_send_json($alert);

	wp_die();
}
add_action('wp_ajax_SendForm', 'SendForm');
add_action('wp_ajax_nopriv_SendForm', 'SendForm');

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
***********************************************************************КОММЕНТАРИИ*************************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
//Ajax функция добавления комментариев
function true_add_ajax_comment(){
	global $wpdb;
	$comment_post_ID = isset($_POST['comment_post_ID']) ? (int) $_POST['comment_post_ID'] : 0;

	$post = get_post($comment_post_ID);

	if ( empty($post->comment_status) ) {
		do_action('comment_id_not_found', $comment_post_ID);
		exit;
	}

	$status = get_post_status($post);

	$status_obj = get_post_status_object($status);

	/*
	 * различные проверки комментария
	 */
	if ( !comments_open($comment_post_ID) ) {
		do_action('comment_closed', $comment_post_ID);
		wp_die( __('Sorry, comments are closed for this item.') );
	} elseif ( 'trash' == $status ) {
		do_action('comment_on_trash', $comment_post_ID);
		exit;
	} elseif ( !$status_obj->public && !$status_obj->private ) {
		do_action('comment_on_draft', $comment_post_ID);
		exit;
	} elseif ( post_password_required($comment_post_ID) ) {
		do_action('comment_on_password_protected', $comment_post_ID);
		exit;
	} else {
		do_action('pre_comment_on_post', $comment_post_ID);
	}

	$comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
	$comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
	$comment_content      = ( isset($_POST['comment']) ) ? trim($_POST['comment']) : null;

	/*
	 * проверяем, залогинен ли пользователь
	 */
	$error_comment = array();

	$user = wp_get_current_user();
	if ( $user->exists() ) {
		if ( empty( $user->display_name ) )
			$user->display_name=$user->user_login;
		$comment_author       = $wpdb->escape($user->display_name);
		$comment_author_email = $wpdb->escape($user->user_email);
		$user_ID = get_current_user_id();
		if ( current_user_can('unfiltered_html') ) {
			if ( wp_create_nonce('unfiltered-html-comment_' . $comment_post_ID) != $_POST['_wp_unfiltered_html_comment'] ) {
				kses_remove_filters(); // start with a clean slate
				kses_init_filters(); // set up the filters
			}
		}
	} else {
		if ( get_option('comment_registration') || 'private' == $status )
			$error_comment['error'] = wp_die( 'Ошибка: Вы должны зарегистрироваться или войти, чтобы оставлять комментарии.' );
	}

	$comment_type = '';

	/*
	 * проверяем, заполнил ли пользователь все необходимые поля
 	 */
	if ( '' == trim($comment_author) ||  '<p><br></p>' == $comment_author ){
		$error_comment['error'] = wp_die( 'Ошибка: Вы не ввели имя.' );
	}
	
	if ( get_option('require_name_email') && !$user->exists() ) {
		if ( 6 > strlen($comment_author_email) || '' == $comment_author_email ){
			$error_comment['error'] = wp_die( 'Ошибка: заполните необходимые поля (Имя, Email).' );
		}elseif ( !is_email($comment_author_email)){
			$error_comment['error'] = wp_die( 'Ошибка: введенный вами email некорректный.' );
		}
	}

	if ( '' == trim($comment_content) ||  '<p><br></p>' == $comment_content ){
		$error_comment['error'] = wp_die( 'Ошибка: Вы забыли про комментарий.' );
	}

	wp_json_encode($error_comment);

	/*
	 * добавляем новый коммент и сразу же обращаемся к нему
	 */
	$comment_parent = isset($_POST['comment_parent']) ? absint($_POST['comment_parent']) : 0;
	$commentdata = compact('comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_type', 'comment_parent', 'user_ID');
	$comment_id = wp_new_comment( $commentdata );
	$comment = get_comment($comment_id);

	die();
}
add_action('wp_ajax_ajaxcomments', 'true_add_ajax_comment'); // wp_ajax_{значение параметра action}
add_action('wp_ajax_nopriv_ajaxcomments', 'true_add_ajax_comment'); // wp_ajax_nopriv_{значение параметра action}

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
*******************************************************************ИЗОБРАЖЕНИЕ К КОММЕНТАРИЯМ**************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
// для добовления фото
function true_include_myuploadscript() {
// у вас в админке уже должен быть подключен jQuery, если нет - раскомментируйте следующую строку:
// wp_enqueue_script('jquery');
// дальше у нас идут скрипты и стили загрузчика изображений WordPress
if ( ! did_action( 'wp_enqueue_media' ) ) {
wp_enqueue_media();
}
// само собой - меняем admin.js на название своего файла
wp_enqueue_script( 'myuploadscript', get_stylesheet_directory_uri() . '/js/admin.js', array('jquery'), null, false );
}
 
add_action( 'admin_enqueue_scripts', 'true_include_myuploadscript' );

// Добавляем новый метабокс на страницу редактирования комментария
function extend_comment_add_meta_box(){
	add_meta_box( 'title', __( 'Изображение комментария' ), 'extend_comment_meta_box', 'comment', 'normal', 'high' );
}
add_action( 'add_meta_boxes_comment', 'extend_comment_add_meta_box' );

// Отображаем наши поля
function extend_comment_meta_box( $comment ){
	if( function_exists( 'true_image_uploader_field' ) ) {
		true_image_uploader_field( 'image_comments', get_comment_meta($comment->comment_ID, 'image_comments',true) );
	}
}

// Сохраняем данные метаполей, заполенных в админке на странице редактирования комментария
function extend_comment_edit_meta_data( $comment_id ) {
	if( !empty($_POST['image_comments']) ){
		$image = sanitize_text_field($_POST['image_comments']);
		update_comment_meta( $comment_id, 'image_comments', $image );
	}else{
		delete_comment_meta( $comment_id, 'image_comments');
	}
}
add_action( 'edit_comment', 'extend_comment_edit_meta_data' );

function true_image_uploader_field( $name, $value = '', $w = 115, $h = 90) {
	$default = get_stylesheet_directory_uri() . '/images/no-image.png';
	if( $value ) {
		$image_attributes = wp_get_attachment_image_src( $value, array($w, $h) );
		$src = $image_attributes[0];
	} else {
		$src = $default;
	}
	echo '
		<div>
			<img data-src="' . $default . '" src="' . $src . '" width="' . $w . 'px" height="' . $h . 'px" />
			<div>
				<input type="hidden" name="' . $name . '" id="' . $name . '" value="' . $value . '" />
				<button type="submit" class="upload_image_button button">Загрузить</button>
				<button type="submit" class="remove_image_button button">&times;</button>
			</div>
		</div>
	';
}

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
*******************************************************************ПРИВАТНОСТЬ ПОСТОВ ФИКС*****************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
function no_privates($where) {
    if( is_admin() ) return $where;

    global $wpdb;
    return " $where AND {$wpdb->posts}.post_status != 'private' ";
}
add_filter('posts_where', 'no_privates');