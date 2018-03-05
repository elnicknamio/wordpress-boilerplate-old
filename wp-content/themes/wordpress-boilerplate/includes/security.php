<?php
if ( !function_exists( 'remove_wp_version_strings' ) ) {

	add_filter( 'script_loader_src', 'remove_wp_version_strings' );
	add_filter( 'style_loader_src', 'remove_wp_version_strings' );

	/**
	* remove the wp version in scaffold
	* @param string $src
	* @return string
	*/
	function remove_wp_version_strings( $src ) {
		global $wp_version;

		parse_str( parse_url( $src, PHP_URL_QUERY ), $query );

		if ( !empty( $query['ver']) && $query['ver'] === $wp_version ) {
			$src = remove_query_arg( 'ver', $src );
		}

		return $src;
	}

}

if ( !function_exists( 'remove_version' ) ) {

	add_filter( 'the_generator', 'remove_version' );

	/**
	* remove wp version in meta tags
	* @return string
	*/
	function remove_version() {
		return '';
	}

}
