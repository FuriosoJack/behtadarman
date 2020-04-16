<?php

defined( 'ABSPATH' ) || exit( 'Direct script access denied.' );

/*
* Load theme setup
* ******************************************************************* */
require_once( get_template_directory() . '/theme/theme-setup.php' );

/*
* Load framework
* ******************************************************************* */
require_once( get_template_directory() . '/framework/init.php' );

/*
* Load theme
* ******************************************************************* */
require_once( get_template_directory() . '/theme/init.php' );