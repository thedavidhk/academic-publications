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
	public function add_metaboxes( $post_type, $post )
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

		if ( has_term( 'journal-article', 'publication_type', $post ) ) {
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
		}

		if ( has_term( 'book-chapter', 'publication_type', $post ) ) {
			add_meta_box(
				'academic_publications_book_chapter',
				__( 'Book Data' ),
				array( $this, 'metabox' ),
				'publication',
				'normal',
				'default',
				array(
					'file'	=> 'book-chapter'
				)
			);
		}
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

		include( plugin_dir_path( __FILE__ ) . 'partials/academic-publications-admin-metabox-' . $params['args']['file'] . '.php' );

	}	// metabox()

	/**
 * Returns an array of the all the metabox fields and their respective types
 *
 * @since 		1.0.0
 * @access 		public
 * @return 		array 		Metabox fields and types
 */
	private function get_metabox_fields() {
		$fields = array();
		$fields[] = array( 'publication-abstract', 'textarea' );
		$fields[] = array( 'publication-pages', 'text' );
		$fields[] = array( 'publication-volume', 'text' );
		$fields[] = array( 'publication-issue', 'text' );
		$fields[] = array( 'publication-book-title', 'text' );
		$fields[] = array( 'publication-editors', 'text' );
		$fields[] = array( 'publication-publisher', 'text' );
		$fields[] = array( 'publication-city', 'text' );
		return $fields;
	} // get_metabox_fields()

	/**
	 * Sets the class variable $options
	 */
	public function set_meta() {
		global $post;
		if ( empty( $post ) ) { return; }
		if ( 'publication' != $post->post_type ) { return; }
		//wp_die( '<pre>' . print_r( $post->ID ) . '</pre>' );
		$this->meta = get_post_custom( $post->ID );
	} // set_meta()

	/**
	 * Saves metabox data.
	 * TODO			nonce checks etc
	 * @since		1.0.0
	 * @access	public
	 * @param		int			$post_id			The post id
	 * @param		object	$object				The post object
	 * @return	void
	 */
	public function validate_meta( $post_id, $object )
	{
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }
		if ( ! current_user_can( 'edit_post', $post_id ) ) { return $post_id; }
		if ( 'job' !== $object->post_type ) { return $post_id; }

		$metas = $this->get_metabox_fields();

		foreach ( $metas as $meta ) {

			$name = $meta[0];
			$type = $meta[1];

			//$new_value = $this->sanitizer( $type, $_POST[$name] );
			$new_value = $_POST[$name];

			update_post_meta( $post_id, $name, $new_value );

		} // foreach

	} // validate_meta()

	private function sanitizer( $type, $data ) {
		if ( empty( $type ) ) { return; }
		if ( empty( $data ) ) { return; }
		$return 	= '';
		$sanitizer 	= new Now_Hiring_Sanitize();
		$sanitizer->set_data( $data );
		$sanitizer->set_type( $type );
		$return = $sanitizer->clean();
		unset( $sanitizer );
		return $return;
	} // sanitizer()

} // class
