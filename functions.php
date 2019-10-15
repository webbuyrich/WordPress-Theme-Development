<?php
/**
 * bootstrapwp functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bootstrapwp
 */

if ( ! function_exists( 'bootstrapwp_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bootstrapwp_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on bootstrapwp, use a find and replace
		 * to change 'bootstrapwp' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bootstrapwp', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'bootstrapwp' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'bootstrapwp_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'bootstrapwp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bootstrapwp_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'bootstrapwp_content_width', 640 );
}
add_action( 'after_setup_theme', 'bootstrapwp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bootstrapwp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bootstrapwp' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'bootstrapwp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'bootstrapwp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bootstrapwp_scripts() {
	// adding Bootstrap CSS
	wp_enqueue_style( 'bootstrapwp-styles', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.2.0', 'all');

	// adding FontAwesome CSS
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0', 'all');

	wp_enqueue_style( 'bootstrapwp-style', get_stylesheet_uri() );

	/* // adding Respond JS
	wp_enqueue_script( 'respond-js', get_template_directory_uri() . '/js/respond.min.js', array(), '1.4.2', true ); */

	// adding Bootstrap JS
	wp_enqueue_script( 'bootstrapwp-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.2.0', true );

	wp_enqueue_script( 'bootstrapwp-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bootstrapwp_scripts' );

if ( !function_exists('ie_scripts') ){
	function ie_scripts(){
		echo '<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->';
		echo '<!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->';
		echo '<!--[if lt IE 9]>';
		echo '<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>';
		echo '<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
		echo '<![endif]-->';
	}
	add_action( 'wp_head', 'ie_scripts' );
}


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


/**
 * Load Bootstrap Menu.
 */
require get_template_directory() . '/inc/bootstrap-nav-walker.php';



/**
 * Enable Woocommerce Support.
 */
add_action('after_setup_theme', 'bootstrapwp_woocommerce_support');

function bootstrapwp_woocommerce_support(){
	add_theme_support( 'woocommerce' );
}

// remove SKU from single product summary page
// (name of hook, function, priority)
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
