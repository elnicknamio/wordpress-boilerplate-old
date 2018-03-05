<?php
if ( !function_exists( 'project_setup' ) ) {

	add_action( 'after_setup_theme', 'theme_translation' );

	/**
	* theme translation
	* @return void
	*/
	function theme_translation() {
		load_theme_textdomain( TEXTDOMAIN, get_template_directory() . '/languages' );
	}

}
