<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://david-herok.com
 * @since      1.0.0
 *
 * @package    Academic_Publications
 * @subpackage Academic_Publications/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Academic_Publications
 * @subpackage Academic_Publications/admin
 * @author     David Herok <herok.davidj@gmail.com>
 */
class Academic_Publications_Admin_Metaboxes {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Registers Metaboxes with Wordpress.
	 *
	 * Note: Requires callback function metabox().
	 *
	 * @since		1.0.0
	 *
	 * TODO: make meta boxes dependent on publication_type terms
	 */
	public function add_metaboxes()
	{

		// add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );

		add_meta_box(
			'academic_publications_general',
			__( 'General' ),
			array( $this, 'metabox' ),
			'publication',
			'normal',
			'default',
			array(
				'file'	=> 'general'
			)
		);

		add_meta_box(
			'academic_publications_journal_article',
			__( 'Journal Data' ),
			array( $this, 'metabox' ),
			'publication',
			'normal',
			'default',
			array(
				'file'	=> 'journal-article'
			)
		);

	} // add_metaboxes()

	/**
	 * Calls a metabox file specified in the add_meta_box args.
	 *
	 * @since		1.0.0
	 */
	public function metabox( $post, $params )
	{
		if ( !is_admin() ) return;
		if ( 'publication' !== $post->post_type ) return;

		// TODO: exit if file is not 'general' and publication type does not match
		// if ( $params['args']['file'] !== 'general' && !has_terms( $params['args']['file'], 'publication_type', $post )) return;

		include( plugin_dir_path( __FILE__ ) . 'partials/academic-publications-admin-metabox-' . $params['args']['file'] . '.php' );

	}	// metabox()

} // class
