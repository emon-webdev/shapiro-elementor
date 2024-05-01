<?php
namespace Shapiro_Elementor;


/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin
{

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts()
	{
		wp_enqueue_style('shapiro-plugin-style', plugins_url('assets/css/shapiro-plugin.css', __FILE__));


		wp_register_script('elementor-hello-world', plugins_url('/assets/js/hello-world.js', __FILE__), ['jquery'], false, true);
	}



	/**
	 * Editor scripts
	 *
	 * Enqueue plugin javascripts integrations for Elementor editor.
	 *
	 * @since 1.2.1
	 * @access public
	 */
	public function editor_scripts()
	{
		add_filter('script_loader_tag', [$this, 'editor_scripts_as_a_module'], 10, 2);

		wp_enqueue_script(
			'elementor-hello-world-editor',
			plugins_url('/assets/js/editor/editor.js', __FILE__),
			[
				'elementor-editor',
			],
			'1.2.1',
			true
		);
	}

	/**
	 * Force load editor script as a module
	 *
	 * @since 1.2.1
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return string
	 */
	public function editor_scripts_as_a_module($tag, $handle)
	{
		if ('elementor-hello-world-editor' === $handle) {
			$tag = str_replace('<script', '<script type="module"', $tag);
		}

		return $tag;
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @param Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets($widgets_manager)
	{
		// Its is now safe to include Widgets files
		// require_once(__DIR__ . '/widgets/hello-world.php');
		require_once(__DIR__ . '/widgets/wlc-hero-slider.php');
		// require_once(__DIR__ . '/widgets/content-block.php');
		// require_once(__DIR__ . '/widgets/training-programs.php');
		require_once(__DIR__ . '/widgets/popular-speaker.php');
		require_once(__DIR__ . '/widgets/section-title.php');
		// require_once(__DIR__ . '/widgets/company-logo.php');
		require_once(__DIR__ . '/widgets/shapiro-cta.php');
		require_once(__DIR__ . '/widgets/why-choose.php');
		require_once(__DIR__ . '/widgets/training-programs.php');
		require_once(__DIR__ . '/widgets/about-shapiro.php');
		require_once(__DIR__ . '/widgets/companies-choose.php');
		require_once(__DIR__ . '/widgets/influence-training.php');
		require_once(__DIR__ . '/widgets/hero-area.php');
		// require_once(__DIR__ . '/widgets/choose-sni.php');

		// Register Widgets
		// $widgets_manager->register(new Widgets\Hello_World());
		$widgets_manager->register(new Widgets\shapiro_Wlc_Hero());
		$widgets_manager->register(new Widgets\Shapiro_Hero_Area());
		// $widgets_manager->register(new Widgets\Shapiro_Content_Blog());
		// $widgets_manager->register(new Widgets\Shapiro_Training_Programs());
		$widgets_manager->register(new Widgets\Shapiro_Popular_Speaker());
		$widgets_manager->register(new Widgets\Shapiro_Section_Title());
		// $widgets_manager->register(new Widgets\Shapiro_Company_Logo());
		$widgets_manager->register(new Widgets\Shapiro_Cta());
		$widgets_manager->register(new Widgets\Shapiro_Why_Choose());
		$widgets_manager->register(new Widgets\Shapiro_Training_Programs());
		$widgets_manager->register(new Widgets\Shapiro_About());
		$widgets_manager->register(new Widgets\Shapiro_Companines_Choose());
		$widgets_manager->register(new Widgets\Shapiro_Influence_Training());
		// $widgets_manager->register(new Widgets\Shapiro_Choose_SNI());
	}

	function shapiro_enqueue_scripts()
	{
		// wp_enqueue_style('isbs-addons-style', plugins_url('assets/css/addons-style.css', __FILE__), array(), '0.1.0', 'all');
		// wp_enqueue_style('owl-carousel', plugins_url('assets/css/owl.carousel.min.css', __FILE__));
		// wp_enqueue_script('owl-carousel', plugins_url('assets/js/owl.carousel.min.js', __FILE__), array('jquery'), '2.3.4', true);
	}


	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct()
	{

		// Register widget scripts
		add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);

		// Register widgets
		add_action('elementor/widgets/register', [$this, 'register_widgets']);


		add_action('elementor/elements/categories_registered', [$this, 'shapiro_widget_add_category']);


		// Register editor scripts
		add_action('elementor/editor/after_enqueue_scripts', [$this, 'editor_scripts']);


		add_action('wp_enqueue_scripts', array($this, 'shapiro_enqueue_scripts'));

		// $this->add_page_settings_controls();
	}


	public function shapiro_widget_add_category($elements_manager)
	{
		$categories = [];
		$categories['shapiroservices'] = [
			'title' => 'Shapiro Services',
			'icon' => 'fa fa-plug',
		];

		$old_categories = $elements_manager->get_categories();
		$categories = array_merge($categories, $old_categories);

		$set_categories = function ($categories) {
			$this->categories = $categories;
		};

		$set_categories->call($elements_manager, $categories);
	}


}

// Instantiate Plugin Class
Plugin::instance();