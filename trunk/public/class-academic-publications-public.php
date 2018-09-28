<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://david-herok.com
 * @since      1.0.0
 *
 * @package    Academic_Publications
 * @subpackage Academic_Publications/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Academic_Publications
 * @subpackage Academic_Publications/public
 * @author     David Herok <herok.davidj@gmail.com>
 */
class Academic_Publications_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Academic_Publications_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Academic_Publications_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/academic-publications-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Academic_Publications_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Academic_Publications_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/academic-publications-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Render a list of publications to the front end
	 *
	 * @since 1.0.0
	 */
	public function list_publications()
	{
		$args = array( 'post_type' => 'publications' );
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) {
			$loop->the_post();
			$authors = get_the_terms( get_the_ID(), 'publication_authors' );
			$author_string = $this->authors_string( $authors );
			include( plugin_dir_path( __FILE__ ) . 'partials/' . $this->plugin_name . 'public-list.php' );
		}
	}

	/**
	 * Render a list of publications to the front end
	 *
	 * @since 	1.0.0
	 *
	 * @param		array		$authors		Array of taxonomy terms publication_authors
	 *
	 * @return	string							String of authors displayed in list
	 */
	private function authors_string( $authors )
	{
		$return = '';

		if ( !$authors ) {
			return $return;
		}

		$names = array();
		foreach ( $authors as $author ) {
			$names[] = $author['name'];
		} // foreach

		foreach ($names as $key => $name ) {
			$first_name = explode(" ", $name);
			$last_name = array_pop($first_name);
			//$names[$key] = $last_name . ', ' implode(" ", $first_name);
			var_dump($first_name);
			var_dump($last_name);
		} // foreach

		sort( $names );

		if ( count($names) < 3 ) {
			$return = implode( " & ", $names );
			return $return;
		}
		else {
			$return = implode( "; ", $names );
		} // authors_string()
	}

}
