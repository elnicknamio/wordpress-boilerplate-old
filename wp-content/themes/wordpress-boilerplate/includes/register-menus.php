<?php
if ( !function_exists( 'register_theme_menus' ) ) {

	add_action( 'init', 'register_theme_menus' );

	/**
	* register theme menus
	* @return void
	*/
	function register_theme_menus() {

		register_nav_menus(
			array(
				'main' => __( 'Main menu', TEXTDOMAIN ),
				'meta' => __( 'Meta menu', TEXTDOMAIN )
			)
		);

	}

}
