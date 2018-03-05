<?php
/* setup constants */
define( 'DIST', get_template_directory_uri() . '/dist' );
define( 'IMG', get_template_directory_uri() . '/dist/img' );
define( 'CSS', get_template_directory_uri() . '/assets/css' );
define( 'JS', get_template_directory_uri() . '/assets/js' );
define( 'TEXTDOMAIN', basename( get_template_directory_uri() ) );

/* initial functions */
require_once 'includes/auth.php';
require_once 'includes/security.php';
require_once 'includes/setup.php';
require_once 'includes/enqueued-files.php';
require_once 'includes/theme-translation.php';

/* theme files */
require_once 'includes/register-menus.php';
