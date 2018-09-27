<?php

/**
 * Provides the markup for any text field
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://david-herok.com
 * @since      1.0.0
 *
 * @package    Academic_Publications
 * @subpackage Academic_Publications/admin/partials
 */

if ( ! empty( $atts['label'] ) ) {
  ?><label for="<?php echo esc_attr( $atts['id'] ); ?>"><?php esc_html_e( $atts['label'], 'now-hiring' ); ?>: </label><?php
}
?><textarea
  class="<?php echo esc_attr( $atts['class'] ); ?>"
  cols="<?php echo esc_attr( $atts['cols'] ); ?>"
  id="<?php echo esc_attr( $atts['id'] ); ?>"
  name="<?php echo esc_attr( $atts['name'] ); ?>"
  rows="<?php echo esc_attr( $atts['rows'] ); ?>"><?php
echo esc_textarea( $atts['value'] );
?></textarea>
<span class="description"><?php esc_html_e( $atts['description'], 'academic-publications' ); ?></span>
