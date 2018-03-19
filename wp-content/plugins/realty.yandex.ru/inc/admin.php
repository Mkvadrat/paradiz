<?php 
if(!defined('ABSPATH')) die; // Die if accessed directly

/**
 * Admin setup
 **/

class La_Yandex_Feed_Admin {
	
	private static $instance = NULL; //instance store
	
	
	private function __construct() {
				
		/* options page */
		add_action( 'admin_menu', array( $this, 'admin_menu' ));
		
		/* options */
		add_action( 'admin_init', array($this, 'settings_init'));
						
		/* style */
		add_action('admin_enqueue_scripts', array($this, 'enqueue_cssjs'));
		
		/* links in description */
		add_filter('plugin_row_meta', array($this, 'plugin_links'), 10, 2);

    }
		
		
	/** instance */
    public static function get_instance(){
        
        if (NULL === self :: $instance)
			self :: $instance = new self;
					
		return self :: $instance;
    }	
	
	/** settings */
	function admin_menu() {
		
		add_options_page(
			__('Яндекс недвижимость', 'layf'),
			__('Яндекс недвижимость', 'layf'),
			'manage_options',
			'layf_settings',
			array($this,'layf_settings_screen')
		);
	}
	
	function settings_init() {
 	 	
		add_settings_section(
			'layf_base',
			__('Настройки', 'layf'),
			array($this, 'layf_base_section_screen'),
			'layf_settings'
		);
		
		add_settings_field(
			'layf_custom_url',
			__('URL страницы', 'layf'),
			array($this, 'settngs_custom_url_callback'),
			'layf_settings',
			'layf_base'
		);
		
		register_setting( 'layf_settings', 'layf_custom_url' );
	}
		
	function layf_settings_screen(){
		
	?>
		<div class="wrap">
			<h2><?php _e('Яндекс недвижимости', 'layf');?></h2>
			
			<div class="layf-columns">
				<div class="layf-form">
					<form method="POST" action="options.php">
					<?php
						settings_fields( 'layf_settings' );	
						do_settings_sections( 'layf_settings' ); 	
						submit_button();
					?>
					</form>
				</div>
			</div>
		</div>
	<?php	
	}
	
	function layf_base_section_screen($args) {
		//may be some description
	}
	
	function settngs_custom_url_callback() {
		
		$value = trailingslashit(get_option('layf_custom_url', 'yandex/news'));
			
		update_option('layf_permalinks_flushed', 0); //is it ok?
		
	?>
		<label for="layf_custom_url">
			<?php echo home_url('/');?><input name="layf_custom_url" id="layf_custom_url" type="text" class="regular-text code" value="<?php echo $value;?>"> </label>
		<p class="description"><?php _e('Измените эту ссылку если требуется', 'layf');?></p>
	<?php	
	}
 	
	/* styles */
	function enqueue_cssjs() {
		
		$screen = get_current_screen(); 
		if('settings_page_layf_settings' != $screen->id)
			return;
      
        wp_enqueue_style('layf-admin', LAYF_PLUGIN_BASE_URL.'css/admin.css', array(), LAYF_VERSION);
	}		
}