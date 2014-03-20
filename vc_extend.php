<?php
/*
Plugin Name: Visual Composer Content Block Extension
Plugin URI: http://wpbakery.com/vc
Description: Adds a Custom Content Block Element to Visual Composer.
Version: 1.0
Author: Jonah West
Author URI: http://www.jonahcoyote.com
License: GPLv2 or later
*/

// don't load directly
if (!defined('ABSPATH')) die('-1');

/*
Display notice if Visual Composer is not installed or activated.
*/
if ( !defined('WPB_VC_VERSION') ) { add_action('admin_notices', 'vc_notice'); return; }
function vc_notice() {
  $plugin_data = get_plugin_data(__FILE__);
  echo '
  <div class="updated">
    <p>'.sprintf(__('<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'vc_extend'), $plugin_data['Name']).'</p>
  </div>';
}

/*
Load plugin css and javascript files
*/
add_action('wp_enqueue_scripts', 'vc_js_css');
function vc_js_css() {

  // If you need any javascript files on front end, here is how you can load them.
  //wp_enqueue_script( 'vc_extend_js', plugins_url('vc_extend.js', __FILE__), array('jquery') );
}

/*
  More information can be found here:
  http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
*/


/*-----------------------------------------------------------------------------------*/
/* Content Blocks
/*-----------------------------------------------------------------------------------*/
require_once('shortcodes/content-blocks.php');
