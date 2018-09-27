<?php

/**
 * Provide a metabox view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://david-herok.com
 * @since      1.0.0
 *
 * @package    Academic_Publications
 * @subpackage Academic_Publications/admin/partials
 */

// wp_nonce_field( $this->plugin_name, 'general' );


$atts                 = array();
$atts['class']        = 'widefat';
$atts['description'] 	= '';
$atts['id']           = 'publication-abstract';
$atts['label'] 			  = 'Abstract';
$atts['name']         = 'publication-abstract';
$atts['placeholder'] 	= '';
$atts['type']         = 'textarea';
$atts['value']        = '';
$atts['rows']					= 8;
if ( ! empty( $this->meta[$atts['id']][0] ) ) {
	$atts['value'] = $this->meta[$atts['id']][0];
}
apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
?><p><?php
include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-textarea.php' );
?></p><?php


$atts                 = array();
$atts['class']        = 'widefat';
$atts['description'] 	= '';
$atts['id']           = 'publication-pages';
$atts['label'] 			  = 'Pages';
$atts['name']         = 'publication-pages';
$atts['placeholder'] 	= '';
$atts['type']         = 'text';
$atts['value']        = '';
if ( ! empty( $this->meta[$atts['id']][0] ) ) {
	$atts['value'] = $this->meta[$atts['id']][0];
}
apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
?><p><?php
include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text.php' );
?></p>
