<?php 
/*
Plugin Name: PixGridder Pro
Plugin URI: http://www.pixedelic.com/plugins/pixgridder
Description: A simple page composer that splits your pages/posts into grid with columns and rows
Version: 2.3.0
Author: Manuel Masia | Pixedelic.com
Author URI: http://www.pixedelic.com
License: GPL2
*/

define( 'PIXGRIDDER_PATH', plugin_dir_path( __FILE__ ) );
define( 'PIXGRIDDER_URL', plugin_dir_url( __FILE__ ) );
define( 'PIXGRIDDER_NAME', plugin_basename( __FILE__ ) );

require_once( PIXGRIDDER_PATH . 'lib/functions.php' );

register_activation_hook( __FILE__, array( 'PixGridder', 'activate' ) );
register_uninstall_hook( __FILE__, array( 'PixGridder', 'uninstall' ) );

PixGridder::get_instance();