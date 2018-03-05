<?php
if ( !function_exists( 'project_load_files' ) ) {

	add_action( 'wp_enqueue_scripts', 'project_load_files' );

	/**
	* script loads
	* @return void
	*/
	function project_load_files() {

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

}
