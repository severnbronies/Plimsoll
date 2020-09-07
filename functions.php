<?php

// ACF configuration
function my_acf_init()
{
	acf_update_setting(
		'google_api_key',
		get_field('api_google_maps', 'option')
	);
}
add_action('acf/init', 'my_acf_init');

// This page is used by multiple of the requires below, so let's just stick it here.
if (function_exists('acf_add_options_page')) {
	acf_add_options_page([
		'page_title' => 'Website Settings',
		'menu_title' => 'Website Settings',
		'menu_slug' => 'website-settings',
		'capability' => 'edit_posts',
	]);
}

require get_template_directory() . '/inc/about.php';
require get_template_directory() . '/inc/apis.php';
require get_template_directory() . '/inc/blocks.php';
require get_template_directory() . '/inc/error-page.php';
require get_template_directory() . '/inc/footer.php';
require get_template_directory() . '/inc/header.php';
require get_template_directory() . '/inc/image-copyright.php';
require get_template_directory() . '/inc/images.php';
require get_template_directory() . '/inc/location.php';
require get_template_directory() . '/inc/logo.php';
require get_template_directory() . '/inc/meet.php';
require get_template_directory() . '/inc/meet-archive.php';
require get_template_directory() . '/inc/meet-runners.php';
require get_template_directory() . '/inc/navigations.php';
require get_template_directory() . '/inc/news.php';
require get_template_directory() . '/inc/phase-banner.php';
require get_template_directory() . '/inc/search.php';
require get_template_directory() . '/inc/signposts.php';
require get_template_directory() . '/inc/site-description.php';
require get_template_directory() . '/inc/stream-team.php';

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
		// API keys
		$context['api_google_maps'] = get_field('api_google_maps', 'option');

		// Header
		$context['primary_navigation'] = new Timber\Menu('primary', [
			'depth' => 1,
		]);

		// Phase banner
		$context['phase_banner_visible'] = get_field(
			'phase_banner_visible',
			'option'
		);
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

		// Notification banners
		$context['banners'] = get_field('banners', 'option');

		// Footer
		$context['footer_navigation'] = new Timber\Menu('footer');
		$context['footer_legal_copy'] = get_field(
			'footer_legal_copy',
			'option'
		);

		// Footer - Newsletter sign up
		$context['newsletter_show'] =
			get_field('footer_newsletter_visible', 'option') == 'true'
				? true
				: false;
		$context['newsletter_heading'] = get_field(
			'footer_newsletter_heading',
			'option'
		);
		$context['newsletter_description'] = get_field(
			'footer_newsletter_description',
			'option'
		);
		$context['newsletter_placeholder'] = get_field(
			'footer_newsletter_placeholder',
			'option'
		);

		// Asset cachebusting
		$context['cachebust_css_version'] = filemtime(
			get_stylesheet_directory() . '/dist/css/all.css'
		);
		$context['cachebust_js_version'] = filemtime(
			get_stylesheet_directory() . '/dist/js/all.js'
		);

		// Everything else
		$context['site'] = $this;
		return $context;
	}

	public function theme_supports()
	{
		/**
		 * Turn stuff on
		 */
		// Enabled auto-generated <title> tag
		add_theme_support('title-tag');
		// Enable post thumbnails
		add_theme_support('post-thumbnails');
		// Enable CMS-manageable navigation
		add_theme_support('menus');

		/**
		 * Turn stuff off
		 */
		// Disable WP emoji
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('wp_print_styles', 'print_emoji_styles');
		// Disable admin bar
		add_filter("show_admin_bar", "__return_false");
		// Disable oEmbed support
		add_filter('embed_oembed_discover', '__return_false');
		remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
		remove_action('wp_head', 'wp_oembed_add_discovery_links');
		remove_action('wp_head', 'wp_oembed_add_host_js');
		if (function_exists('disable_embeds_rewrites')) {
			add_filter('rewrite_rules_array', 'disable_embeds_rewrites');
		}
		// Disable WP blocks CSS
		add_action(
			'wp_enqueue_scripts',
			function () {
				wp_dequeue_style('wp-block-library'); // WordPress core
				wp_dequeue_style('wp-block-library-theme'); // WordPress core
			},
			100
		);
		// Disable taxonomy and users sitemaps introduced in WordPress 5.5
		add_filter('wp_sitemaps_taxonomies', function ($taxonomies) {
			unset($taxonomies['category']);
			return $taxonomies;
		});
		add_filter(
			'wp_sitemaps_add_provider',
			function ($provider, $name) {
				if ($name === 'users') {
					return false;
				}
				return $provider;
			},
			10,
			2
		);
	}

	/**
	 * For some reason custom fields are janked, with some stored as strings
	 * and others as arrays. This is a temporary workaround For this issue.
	 */
	public function twig_normalise_custom_field_filter($obj)
	{
		if (is_array($obj)) {
			return $obj[0];
		}
		return $obj;
	}

	/**
	 * Function for merging multiple arrays together (useful for setting
	 * default or overriding parameters).
	 */
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

	/** Function for casting PHP objects to associative arrays, as Twig cannot
	 * iterate over objects. HT: https://stackoverflow.com/a/17306423
	 */
	function twig_cast_to_array($stdClassObject)
	{
		return (array) $stdClassObject;
	}

	/**
	 * See if a named cookie has been set and, if so, what the value is.
	 */
	function twig_cookie_value_function($cookieName)
	{
		if (isset($_COOKIE[$cookieName])) {
			return $_COOKIE[$cookieName];
		} else {
			return false;
		}
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
				'twig_normalise_custom_field_filter',
			])
		);
		$twig->addFilter(
			new Twig\TwigFilter('castToArray', [$this, 'twig_cast_to_array'])
		);
		$twig->addFunction(
			new Timber\Twig_Function('merge', [$this, 'twig_merge_function'])
		);
		$twig->addFunction(
			new Timber\Twig_Function('getCookie', [
				$this,
				'twig_cookie_value_function',
			])
		);
		return $twig;
	}
}

new Plimsoll();
