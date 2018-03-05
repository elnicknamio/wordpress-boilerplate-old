<?php
if ( !function_exists( 'project_setup' ) ) {

    add_action( 'after_setup_theme', 'project_setup' );

	/**
     * project initialization
     * @return void
     */
    function project_setup() {

        add_theme_support( 'post-thumbnails' );
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );

    }

}
