<?php
if ( !function_exists( 'auth_check' ) ) {

	add_action( 'init', 'auth_check', 5 );

	/**
	* auth redirect
	* @return boolean
	*/
	function auth_check() {
		if ( ( WP_DEBUG === false || is_user_logged_in() ) && is_admin() ) { return; }

		$exclusions = array(
			'wp-login.php',
			'wp-register.php',
			'wp-cron.php',
			'wp-trackback.php',
			'wp-app.php',
			'xmlrpc.php'
		);

		if ( in_array( basename( $_SERVER['PHP_SELF'] ), $exclusions ) ) {
			return;
		}

		auth_redirect();
	}

}
