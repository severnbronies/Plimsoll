<?php

require get_template_directory() . '/inc/footer.php';
require get_template_directory() . '/inc/helpers.php';
require get_template_directory() . '/inc/image-copyright.php';
require get_template_directory() . '/inc/images.php';
require get_template_directory() . '/inc/location.php';
require get_template_directory() . '/inc/logo.php';
require get_template_directory() . '/inc/meet.php';
require get_template_directory() . '/inc/meet-archive.php';
require get_template_directory() . '/inc/meet-runners.php';
require get_template_directory() . '/inc/navigations.php';
require get_template_directory() . '/inc/phase-banner.php';
require get_template_directory() . '/inc/search.php';
require get_template_directory() . '/inc/site-description.php';

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if (!class_exists('Timber')) {
	add_action('admin_notices', function () {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' .
			esc_url(admin_url('plugins.php#timber')) .
			'">' .
			esc_url(admin_url('plugins.php')) .
			'</a></p></div>';
	});

	add_filter('template_include', function ($template) {
		return get_stylesheet_directory() . '/static/no-timber.html';
	});
	return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = ['views'];

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;

/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class Plimsoll extends Timber\Site
{
	/** Add timber support. */
	public function __construct()
	{
		add_action('after_setup_theme', [$this, 'theme_supports']);
		add_filter('timber/loader/loader', function ($loader) {
			$loader->addPath(__DIR__ . "/components", "components");
			return $loader;
		});
		add_filter('timber/context', [$this, 'add_to_context']);
		add_filter('timber/twig', [$this, 'add_to_twig']);
		add_action('init', [$this, 'register_post_types']);
		add_action('init', [$this, 'register_taxonomies']);
		parent::__construct();
	}

	/** This is where you can register custom post types. */
	public function register_post_types()
	{
	}

	/** This is where you can register custom taxonomies. */
	public function register_taxonomies()
	{
	}

	/** This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context($context)
	{
		$context['primary_navigation'] = new Timber\Menu('primary', [
			'depth' => 1,
		]);
		$context['phase_banner_title'] = get_field(
			'phase_banner_title',
			'option'
		);
		$context['phase_banner_subtitle'] = get_field(
			'phase_banner_subtitle',
			'option'
		);
		$context['phase_banner_description'] = get_field(
			'phase_banner_description',
			'option'
		);
		$context['footer_navigation'] = new Timber\Menu('footer');
		$context['footer_boilerplate'] = get_theme_mod('footer_boilerplate');
		$context['site'] = $this;
		return $context;
	}

	public function theme_supports()
	{
		add_filter("show_admin_bar", "__return_false");
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_theme_support('menus');
	}

	/**
	 * For some reason custom fields are janked, with some stored as strings
	 * and others as arrays. This is a temporary workaround For this issue.
	 */
	public function normaliseCustomField($obj)
	{
		if (is_array($obj)) {
			return $obj[0];
		}
		return $obj;
	}

	function twig_merge_function()
	{
		$get_args = func_get_args();
		$return_array_data = [];
		foreach ($get_args as $arg) {
			$return_array_data = array_merge_recursive(
				$return_array_data,
				$arg
			);
		}
		return $return_array_data;
	}

	/** This is where you can add your own functions to twig.
	 *
	 * @param string $twig get extension.
	 */
	public function add_to_twig($twig)
	{
		$twig->addExtension(new Twig\Extension\StringLoaderExtension());
		$twig->addFilter(
			new Twig\TwigFilter('normaliseCustomField', [
				$this,
				'normaliseCustomField',
			])
		);
		$twig->addFilter(
			new Twig\TwigFilter('parseCustomField', [$this, 'parseCustomField'])
		);
		$twig->addFunction(
			new Timber\Twig_Function('sb_location', [
				$this,
				'sb_location_twig_function',
			])
		);
		$twig->addFunction(
			new Timber\Twig_Function('merge', [$this, 'twig_merge_function'])
		);
		return $twig;
	}
}

new Plimsoll();
