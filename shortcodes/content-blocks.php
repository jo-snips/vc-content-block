<?php

add_shortcode( 'content-block', 'content_block_vc_func' );
function content_block_vc_func( $atts, $content = null ) {
  extract( shortcode_atts( array(
    'title' => '',
    'id' => '',
    'el_class' => ''
  ), $atts ) );

  $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content

  $output = '';
  $width = '';
  $output .= "\n\t".'<div class="wpb_content_block wpb_content_element'.$width.'">';
  $output .= "\n\t\t".'<div class="wpb_wrapper">';
  $output .= wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_content_block_heading'));
  $output .= do_shortcode( "[content_block id='${id}']" );
  $output .= "\n\t\t".'</div> ';
  $output .= "\n\t".'</div> ';

  return $output;
}


include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // Require plugin.php to use is_plugin_active() below
if (is_plugin_active('custom-post-widget/custom-post-widget.php')) {
  global $wpdb;
  $blocks = $wpdb->get_results(
    "
    SELECT ID, post_title
    FROM $wpdb->posts
    WHERE post_type = 'content_block'
    "
  );
  $blocks_array = array();
  if ($blocks) {
    foreach ( $blocks as $block ) {
      $blocks_array[$block->post_title] = $block->ID;
    }
  } else {
    $blocks_array["No content blocks found"] = 0;
  }
  vc_map( array(
    "base" => "content-block",
    "name" => __("Content Block", "js_composer"),
    "icon" => "icon-wpb-content-block",
    "category" => __('Content', 'js_composer'),
    "params" => array(
      array(
        "type" => "dropdown",
        "heading" => __("Select Content Block", "js_composer"),
        "param_name" => "id",
        "value" => $blocks_array,
        "description" => __("Choose previously created Content Blocks from the drop down list.", "js_composer")
      )
    )
  ) );
} // if Content Blocks plugin active
