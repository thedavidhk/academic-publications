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

wp_nonce_field( $this->plugin_name, 'book-chapter' );


$atts                 = array();
$atts['class']        = 'widefat';
$atts['description'] 	= '';
$atts['id']           = 'publication-book-title';
$atts['label'] 			  = 'Book Title';
$atts['name']         = 'publication-book-title';
$atts['placeholder'] 	= '';
$atts['type']         = 'text';
$atts['value']        = '';
if ( ! empty( $this->meta[$atts['id']][0] ) ) {
	$atts['value'] = $this->meta[$atts['id']][0];
}
apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
?><p><?php
include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text.php' );
?></p><?php


$atts                 = array();
$atts['class']        = 'widefat';
$atts['description'] 	= '';
$atts['id']           = 'publication-editors';
$atts['label'] 			  = 'Editor(s)';
$atts['name']         = 'publication-editors';
$atts['placeholder'] 	= '';
$atts['type']         = 'text';
$atts['value']        = '';
if ( ! empty( $this->meta[$atts['id']][0] ) ) {
	$atts['value'] = $this->meta[$atts['id']][0];
}
apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
?><p><?php
include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text.php' );
?></p><?php


$atts                 = array();
$atts['class']        = 'widefat';
$atts['description'] 	= '';
$atts['id']           = 'publication-publisher';
$atts['label'] 			  = 'Publisher';
$atts['name']         = 'publication-publisher';
$atts['placeholder'] 	= '';
$atts['type']         = 'text';
$atts['value']        = '';
if ( ! empty( $this->meta[$atts['id']][0] ) ) {
	$atts['value'] = $this->meta[$atts['id']][0];
}
apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
?><p><?php
include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text.php' );
?></p><?php


$atts                 = array();
$atts['class']        = 'widefat';
$atts['description'] 	= '';
$atts['id']           = 'publication-city';
$atts['label'] 			  = 'City';
$atts['name']         = 'publication-city';
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
