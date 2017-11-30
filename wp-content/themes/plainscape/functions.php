<?php
define( 'DIST_DIR', get_template_directory_uri() . '/dist' );
define( 'IMG_DIR', get_template_directory_uri() . '/assets/img' );
define( 'CSS_DIR', get_template_directory_uri() . '/assets/css' );
define( 'JS_DIR', get_template_directory_uri() . '/assets/js' );
define( 'TEXTDOMAIN', basename( get_template_directory_uri() ) );


if ( !function_exists( 'project_setup' ) ) {

    /**
     * project initialization
     * @return void
     */
    add_action( 'after_setup_theme', 'project_setup' );

    function project_setup() {

        add_theme_support( 'post-thumbnails' );
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );

    }

}


/**
 * theme translation
 * @return type
 */
add_action( 'after_setup_theme', 'theme_translation' );

function theme_translation() {
    load_theme_textdomain( TEXTDOMAIN, get_template_directory() . '/languages' );
}


/**
 * script loads
 * @return void
 */
add_action( 'wp_enqueue_scripts', 'project_load_scripts' );

function project_load_scripts() {

    $deregister_scripts = array(
        "wp-embed",
        "jquery-ui-widget",
        "jquery-ui-mouse",
        "jquery-ui-accordion",
        "jquery-ui-autocomplete",
        "jquery-ui-slider",
        "jquery-ui-tabs",
        "jquery-ui-draggable",
        "jquery-ui-droppable",
        "jquery-ui-selectable",
        "jquery-ui-position",
        "jquery-ui-datepicker",
        "jquery-ui-resizable",
        "jquery-ui-dialog",
        "jquery-ui-button"
    );

    foreach( $deregister_scripts as $script ){
        wp_deregister_script( $script );
    }

    // remove wp dashicons
    if ( !is_user_logged_in() ) {
        wp_deregister_style( 'dashicons' );
    }

	// remove jquery for frontend
	if ( !is_admin() ) {
		wp_deregister_script('jquery');
	}

    // add here other CSS files
    // ...

    wp_enqueue_style( 'project-style', get_stylesheet_uri() );

    // browser support files (if needed)
    // wp_enqueue_style( 'project-ie', CSS_DIR . '/ie.css' );
    // wp_style_add_data( 'project-ie', 'conditional', 'lt IE 9' );

    // optional script files
    // wp_enqueue_script( 'modernizr', JS . '/modernizr.min.js', false, false, false );
    // wp_enqueue_script( 'bootstrap', JS . '/bootstrap.min.js', false, false, true );

	// add here other JS files
    // ...

    wp_enqueue_script( 'main', DIST_DIR . '/main.js', false, false, true );

	// get access to "ajax.url" in main js file
	wp_localize_script( 'main', 'ajax', array( 'url' => admin_url( 'admin-ajax.php' ) ) );

}


/**
 * auth redirect
 * @return boolean
 */
add_action( 'init', 'registration_check', 5 );

function registration_check() {
    if ( WP_DEBUG === false || is_user_logged_in() ) { return; }

	$exclusions = array(
		'wp-login.php',
		'wp-register.php',
		'wp-cron.php',
		'wp-trackback.php',
		'wp-app.php',
		'xmlrpc.php',
	);

    if ( in_array( basename( $_SERVER['PHP_SELF'] ), $exclusions ) ) {
        return;
    }

    auth_redirect();
}


/**
 * register navigation menus
 * @return void
 */
add_action( 'init', 'register_menus' );

function register_menus() {
    register_nav_menus(
        array(
            'main' => __( 'Main', TEXTDOMAIN ),
            'meta' => __( 'Meta', TEXTDOMAIN )
            )
        );
}

/**
 * remove the wp version in scaffold
 * @param string $src
 * @return string
 */
add_filter( 'script_loader_src', 'remove_wp_version_strings' );
add_filter( 'style_loader_src', 'remove_wp_version_strings' );

function remove_wp_version_strings( $src ) {
    global $wp_version;

    parse_str( parse_url( $src, PHP_URL_QUERY ), $query );

    if ( !empty( $query['ver']) && $query['ver'] === $wp_version ) {
        $src = remove_query_arg( 'ver', $src );
    }

    return $src;
}

/**
 * remove wp version in meta tags
 * @return string
 */
add_filter( 'the_generator', 'remove_version' );

function remove_version() {
    return '';
}


/**
 * get svg image from sprite
 * @return string
 */
function get_svg( $id, $class = false ) {
	if ( empty( $id ) ) return false;
	if ( !$class ) $class = 'icon';
	?>

	<svg class="<?php echo $class ?>"><use xlink:href="#<?php echo $id ?>" /></svg>

	<?php
}
