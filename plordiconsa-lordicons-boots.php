<?php
namespace plordiconsa_lordicons_namespace;

use plordiconsa_lordicons_namespace\PageSettings\Page_Settings;
define( "PLORDICONSA_ASFSK_ASSETS_PUBLIC_DIR_FILE", plugin_dir_url( __FILE__ ) . "assets/public" );
define( "PLORDICONSA_ASFSK_ASSETS_ADMIN_DIR_FILE", plugin_dir_url( __FILE__ ) . "assets/admin" );
class Classplordiconsaeffective {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function plordiconsa_admin_editor_scripts() {
		add_filter( 'script_loader_tag', [ $this, 'plordiconsa_admin_editor_scripts_as_a_module' ], 10, 2 );
	}

	public function plordiconsa_admin_editor_scripts_as_a_module( $tag, $handle ) {
		if ( 'plordiconsa_effective_editor' === $handle ) {
			$tag = str_replace( '<script', '<script type="module"', $tag );
		}

		return $tag;
	}

	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/plordiconsa-lordicons-widget.php' );
	}

	public function plordiconsa_register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register WidgetsF
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PLORDICONSA_Effective_widgets());
	}

	private function add_page_settings_controls() {
		require_once( __DIR__ . '/page-settings/plordiconsa-lordicons-manager.php' );
		new Page_Settings();
	}

	// Register Category
	function plordiconsa_add_elementor_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'bwdthebest_general_category',
			[
				'title' => esc_html__( 'BWD General Group', 'powerful-lordicons-animation' ),
				'icon' => 'eicon-person',
			]
		);
	}

	//css-js-link-here with php
	public function plordiconsa_all_assets_for_the_public(){
		wp_enqueue_style( 'plordiconsa-effective-style', plugin_dir_url( __FILE__ ) . 'assets/public/css/style.css', null, '1.0', 'all' );
		wp_enqueue_script( 'plordiconsa-effective-lordicons', plugin_dir_url( __FILE__ ) . 'assets/public/js/lordicons.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'plordiconsa-effective-min-lordicons', plugin_dir_url( __FILE__ ) . 'assets/public/js/lordicons.min.js', array('jquery'), '1.0', true );
	}

	//admin-icon
	public function plordiconsa_all_assets_for_elementor_editor_admin(){
		$all_css_js_file = array(
			'plordiconsa_effective_admin_main_css' => array('plordiconsa_path_admin_define'=>PLORDICONSA_ASFSK_ASSETS_ADMIN_DIR_FILE . '/icon.css'),
		);
		foreach($all_css_js_file as $handle => $fileinfo){
			wp_enqueue_style( $handle, $fileinfo['plordiconsa_path_admin_define'], null, '1.0', 'all');
		}
	}
	
	public function __construct() {

		// For public assets
		add_action('wp_enqueue_scripts', [$this, 'plordiconsa_all_assets_for_the_public']);

		// For Elementor Editor
		add_action('elementor/editor/before_enqueue_scripts', [$this, 'plordiconsa_all_assets_for_elementor_editor_admin']);
		
		// Register Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'plordiconsa_add_elementor_widget_categories' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'plordiconsa_register_widgets' ] );

		// Register editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'plordiconsa_admin_editor_scripts' ] );
		
		$this->add_page_settings_controls();
	}
}

// Instantiate Plugin Class
Classplordiconsaeffective::instance();