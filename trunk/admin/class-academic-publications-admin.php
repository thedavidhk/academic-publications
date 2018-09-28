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
class Academic_Publications_Admin {

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

	} // __construct()

	/**
	 * Register Publication Post Type.
	 *
	 * @since			1.0.0
	 */
	public function new_cpt_publication()
	{
		$cap_type = 'post';
		$plural = 'Publications';
		$single = 'Publication';
		$cpt_name = 'publication';

		$opts['can_export']								= TRUE;
		$opts['capability_type']					= $cap_type;
		$opts['description']							= '';
		$opts['exclude_from_search']			= FALSE;
		$opts['has_archive']							= FALSE;
		$opts['hierarchical']							= FALSE;
		$opts['map_meta_cap']							= TRUE;
		$opts['menu_icon']								= 'dashicons-media-text';
		$opts['menu_position']						= 25;
		$opts['public']										= TRUE;
		$opts['publicly_querable']				= TRUE;
		$opts['query_var']								= TRUE;
		$opts['register_meta_box_cb']			= '';
		$opts['rewrite']									= FALSE;
		$opts['show_in_admin_bar']				= TRUE;
		$opts['show_in_menu']							= TRUE;
		$opts['show_in_nav_menu']					= TRUE;
		$opts['show_ui']									= TRUE;
		$opts['supports']									= array( 'title' );
		$opts['taxonomies']								= array( 'publication_type' );
		$opts['capabilities']['delete_others_posts']		= "delete_others_{$cap_type}s";
		$opts['capabilities']['delete_post']						= "delete_{$cap_type}";
		$opts['capabilities']['delete_posts']						= "delete_{$cap_type}s";
		$opts['capabilities']['delete_private_posts']		= "delete_private_{$cap_type}s";
		$opts['capabilities']['delete_published_posts']	= "delete_published_{$cap_type}s";
		$opts['capabilities']['edit_others_posts']			= "edit_others_{$cap_type}s";
		$opts['capabilities']['edit_post']							= "edit_{$cap_type}";
		$opts['capabilities']['edit_posts']							= "edit_{$cap_type}s";
		$opts['capabilities']['edit_private_posts']			= "edit_private_{$cap_type}s";
		$opts['capabilities']['edit_published_posts']		= "edit_published_{$cap_type}s";
		$opts['capabilities']['publish_posts']					= "publish_{$cap_type}s";
		$opts['capabilities']['read_post']							= "read_{$cap_type}";
		$opts['capabilities']['read_private_posts']			= "read_private_{$cap_type}s";
		$opts['labels']['add_new']						= esc_html__( "Add New {$single}", 'academic-publications' );
		$opts['labels']['add_new_item']				= esc_html__( "Add New {$single}", 'academic-publications' );
		$opts['labels']['all_items']					= esc_html__( $plural, 'academic-publications' );
		$opts['labels']['edit_item']					= esc_html__( "Edit {$single}" , 'academic-publications' );
		$opts['labels']['menu_name']					= esc_html__( $plural, 'academic-publications' );
		$opts['labels']['name']								= esc_html__( $plural, 'academic-publications' );
		$opts['labels']['name_admin_bar']			= esc_html__( $single, 'academic-publications' );
		$opts['labels']['new_item']						= esc_html__( "New {$single}", 'academic-publications' );
		$opts['labels']['not_found']					= esc_html__( "No {$plural} Found", 'academic-publications' );
		$opts['labels']['not_found_in_trash']	= esc_html__( "No {$plural} Found in Trash", 'academic-publications' );
		$opts['labels']['parent_item_colon']	= esc_html__( "Parent {$plural} :", 'academic-publications' );
		$opts['labels']['search_items']				= esc_html__( "Search {$plural}", 'academic-publications' );
		$opts['labels']['singular_name']			= esc_html__( $single, 'academic-publications' );
		$opts['labels']['view_item']					= esc_html__( "View {$single}", 'academic-publications' );
		$opts['rewrite']['ep_mask']						= EP_PERMALINK;
		$opts['rewrite']['feeds']							= FALSE;
		$opts['rewrite']['pages']							= TRUE;
		$opts['rewrite']['slug']							= esc_html__( strtolower( $plural ), 'academic-publications' );
		$opts['rewrite']['with_front']				= FALSE;

		$opts = apply_filters( 'academic-publications-cpt-options', $opts );

		register_post_type( strtolower( $cpt_name ), $opts );

	} // new_cpt_publication()

	/**
	 * Register Publication Type taxonomy.
	 *
	 * @since 1.0.0
	 */
	public function new_taxonomy_type()
	{
		$plural 	= 'Types';
		$single 	= 'Type';
		$tax_name 	= 'publication_type';
		$opts['hierarchical']						= TRUE;
		//$opts['meta_box_cb'] 					= '';
		$opts['public']									= TRUE;
		$opts['query_var']							= $tax_name;
		$opts['show_admin_column'] 			= FALSE;
		$opts['show_in_nav_menus']			= TRUE;
		$opts['show_tag_cloud'] 				= TRUE;
		$opts['show_ui']								= TRUE;
		$opts['sort'] 									= '';
		//$opts['update_count_callback'] 					= '';
		$opts['capabilities']['assign_terms'] 	= 'edit_posts';
		$opts['capabilities']['delete_terms'] 	= 'create_sites';
		$opts['capabilities']['edit_terms'] 		= 'create_sites';
		$opts['capabilities']['manage_terms']		= 'create_sites';
		$opts['labels']['add_new_item'] 							= esc_html__( "Add New {$single}", 'academic-publications' );
		$opts['labels']['add_or_remove_items'] 				= esc_html__( "Add or remove {$plural}", 'academic-publications' );
		$opts['labels']['all_items'] 									= esc_html__( $plural, 'academic-publications' );
		$opts['labels']['choose_from_most_used'] 			= esc_html__( "Choose from most used {$plural}", 'academic-publications' );
		$opts['labels']['edit_item'] 									= esc_html__( "Edit {$single}" , 'academic-publications');
		$opts['labels']['menu_name'] 									= esc_html__( $single, 'academic-publications' );
		$opts['labels']['name'] 											= esc_html__( $single, 'academic-publications' );
		$opts['labels']['new_item_name'] 							= esc_html__( "New {$single} Name", 'academic-publications' );
		$opts['labels']['not_found'] 									= esc_html__( "No {$single} Found", 'academic-publications' );
		$opts['labels']['parent_item'] 								= esc_html__( "Parent {$single}", 'academic-publications' );
		$opts['labels']['parent_item_colon'] 					= esc_html__( "Parent {$single}:", 'academic-publications' );
		$opts['labels']['popular_items'] 							= esc_html__( "Popular {$plural}", 'academic-publications' );
		$opts['labels']['search_items'] 							= esc_html__( "Search {$plural}", 'academic-publications' );
		$opts['labels']['separate_items_with_commas'] = esc_html__( "Separate {$plural} with commas", 'academic-publications' );
		$opts['labels']['singular_name'] 							= esc_html__( $single, 'academic-publications' );
		$opts['labels']['update_item'] 								= esc_html__( "Update {$single}", 'academic-publications' );
		$opts['labels']['view_item'] 									= esc_html__( "View {$single}", 'academic-publications' );
		$opts['rewrite']['ep_mask']										= EP_NONE;
		$opts['rewrite']['hierarchical']							= FALSE;
		$opts['rewrite']['slug']											= esc_html__( strtolower( $tax_name ), 'academic-publications' );
		$opts['rewrite']['with_front']											= FALSE;

		$opts = apply_filters( 'academic-publications-taxonomy-options', $opts );
		register_taxonomy( $tax_name, 'publication', $opts );
	}

	/**
	 * Register Publication Authors taxonomy.
	 *
	 * @since 1.0.0
	 */
	public function new_taxonomy_author()
	{
		$plural 	= 'Authors';
		$single 	= 'Author';
		$tax_name 	= 'publication_authors';
		$opts['hierarchical']						= FALSE;
		//$opts['meta_box_cb'] 					= '';
		$opts['public']									= TRUE;
		$opts['query_var']							= $tax_name;
		$opts['show_admin_column'] 			= FALSE;
		$opts['show_in_nav_menus']			= TRUE;
		$opts['show_tag_cloud'] 				= TRUE;
		$opts['show_ui']								= TRUE;
		$opts['sort'] 									= '';
		//$opts['update_count_callback'] 					= '';
		$opts['capabilities']['assign_terms'] 	= 'edit_posts';
		$opts['capabilities']['delete_terms'] 	= 'manage_categories';
		$opts['capabilities']['edit_terms'] 		= 'manage_categories';
		$opts['capabilities']['manage_terms']		= 'manage_categories';
		$opts['labels']['add_new_item'] 							= esc_html__( "Add New {$single}", 'academic-publications' );
		$opts['labels']['add_or_remove_items'] 				= esc_html__( "Add or remove {$plural}", 'academic-publications' );
		$opts['labels']['all_items'] 									= esc_html__( $plural, 'academic-publications' );
		$opts['labels']['choose_from_most_used'] 			= esc_html__( "Choose from most used {$plural}", 'academic-publications' );
		$opts['labels']['edit_item'] 									= esc_html__( "Edit {$plural}" , 'academic-publications');
		$opts['labels']['menu_name'] 									= esc_html__( $plural, 'academic-publications' );
		$opts['labels']['name'] 											= esc_html__( $plural, 'academic-publications' );
		$opts['labels']['new_item_name'] 							= esc_html__( "New {$single} Name", 'academic-publications' );
		$opts['labels']['not_found'] 									= esc_html__( "No {$single} Found", 'academic-publications' );
		$opts['labels']['parent_item'] 								= esc_html__( "Parent {$single}", 'academic-publications' );
		$opts['labels']['parent_item_colon'] 					= esc_html__( "Parent {$single}:", 'academic-publications' );
		$opts['labels']['popular_items'] 							= esc_html__( "Popular {$plural}", 'academic-publications' );
		$opts['labels']['search_items'] 							= esc_html__( "Search {$plural}", 'academic-publications' );
		$opts['labels']['separate_items_with_commas'] = esc_html__( "Separate {$plural} with commas", 'academic-publications' );
		$opts['labels']['singular_name'] 							= esc_html__( $single, 'academic-publications' );
		$opts['labels']['update_item'] 								= esc_html__( "Update {$single}", 'academic-publications' );
		$opts['labels']['view_item'] 									= esc_html__( "View {$single}", 'academic-publications' );
		$opts['rewrite']['ep_mask']										= EP_NONE;
		$opts['rewrite']['hierarchical']							= FALSE;
		$opts['rewrite']['slug']											= esc_html__( strtolower( $tax_name ), 'academic-publications' );
		$opts['rewrite']['with_front']											= FALSE;

		$opts = apply_filters( 'academic-publications-taxonomy-options', $opts );
		register_taxonomy( $tax_name, 'publication', $opts );
	}

	/**
	 * Add Publication Types.
	 *
	 * @since 1.0.0
	 */
	public function new_publication_types()
	{
		if ( !term_exists( 'Journal Article', 'publication_type' ) )
		{
			wp_insert_term(
				'Journal Article',
				'publication_type',
				array(
					'description'	=> 'Articles published in a Journal',
					'slug'				=> 'journal-article'
				)
			);
		}
		if ( !term_exists( 'Book Chapter', 'publication_type' ) )
		{
			wp_insert_term(
				'Book Chapter',
				'publication_type',
				array(
					'description'	=> 'Chapter published in a Book',
					'slug'				=> 'book-chapter'
				)
			);
		}
	}

}
