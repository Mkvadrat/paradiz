<?php
/*
Plugin Name: Яндекс недвижимость
Description: Плагин создает фид для яндекс недвижимости
Version: 1.0.0
Author: Владимир Яковлев
Author URI: http://www.sominus.ru
*/

if(!defined('ABSPATH')) die; // Die if accessed directly

// Plugin version:
if( !defined('LAYF_VERSION') )
    define('LAYF_VERSION', '1.8.5');
	
// Plugin DIR, with trailing slash:
if( !defined('LAYF_PLUGIN_DIR') )
    define('LAYF_PLUGIN_DIR', plugin_dir_path( __FILE__ ));

// Plugin URL:
if( !defined('LAYF_PLUGIN_BASE_URL') )
    define('LAYF_PLUGIN_BASE_URL', plugin_dir_url(__FILE__));
	
// Plugin ID:
if( !defined('LAYF_PLUGIN_BASE_NAME') )
    define('LAYF_PLUGIN_BASE_NAME', plugin_basename(__FILE__));


/** Init **/
require_once(plugin_dir_path(__FILE__).'inc/yandex-feed-core.php');

$layf = La_Yandex_Feed_Core::get_instance();


register_activation_hook( __FILE__, array( 'La_Yandex_Feed_Core', 'on_activation' ));
register_deactivation_hook(__FILE__, array( 'La_Yandex_Feed_Core', 'on_deactivation' ));


/** strings to be translated **/
$strings = array(
__('The plugin creates feed for Yandex.News service', 'layf'),
__('Teplitsa', 'layf'),
);