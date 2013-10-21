<?php

/*-----------------------------------------------------------------------------------*/
/* Setup Theme */
/*-----------------------------------------------------------------------------------*/  

if ( ! isset( $content_width ) ) $content_width = 1000; 

add_action( 'after_setup_theme', 'icore_theme_setup' );

if ( ! function_exists( 'icore_theme_setup' ) ):

function icore_theme_setup() {
	global $theme_options;
	
	// Load Theme Text Domain
	load_theme_textdomain( 'TopShop', get_template_directory() . '/lang' );
	
	if ( class_exists('woocommerce') ) {
		add_theme_support( 'woocommerce' );
	}
	
	// Add WordPress theme support
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );	
	add_theme_support( 'post-formats', array( 'gallery', 'image', 'video', 'quote' ) );
	add_theme_support( 'custom-header');
	
	$defaults = array(
		'default-color'          => 'FEFEFE',
		'default-image'          => '',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => ''
	);
	
	
	add_theme_support( 'custom-background', $defaults );
	add_editor_style();

	// Update Image Sizes
	update_option( 'thumbnail_size_w', 53, true );
	update_option( 'thumbnail_size_h', 53, true );
	update_option( 'medium_size_w', 620, true );
	update_option( 'medium_size_h', '', true );
	update_option( 'large_size_w', 1000, true );
	update_option( 'large_size_h', '', true );
	
	// Add additional image sizes
	set_post_thumbnail_size( 53, 53, true ); // square thumbnail
	add_image_size( 'post-thumb-big', 1000, 400, true );
	add_image_size( 'widget-thumb', 53, 53, true );
	add_image_size( 'gallery-thumb', 480, 400, true ); // portfolio images

	// Register Custom Menus
	register_nav_menus( array(
		'primary-menu' => __( 'Primary Menu', 'TopShop' ),
		'top-menu' => __( 'Top Menu', 'TopShop' )
	) );

}
endif; // icore_theme_setup 

// Load Theme CSS files
add_action( 'wp_enqueue_scripts', 'icore_load_theme_styles' );

if ( ! function_exists( 'icore_load_theme_styles' ) ):
	function icore_load_theme_styles() {
		global $theme_options;
	
		// load style.css file
		wp_enqueue_style( 'style', get_stylesheet_uri() );
	
		if ( isset ( $theme_options['colorscheme'] ) && 'default' != $theme_options['colorscheme'] ) {
	        wp_enqueue_style( 'alt-style', get_template_directory_uri() . '/css/' . $theme_options['colorscheme'] . '.css', array( 'style' ) );
		}	
}
endif; // icore_load_theme_styles

/*-----------------------------------------------------------------------------------*/
/* Additional Theme Functions */
/*-----------------------------------------------------------------------------------*/


//Get the Attachment ID for a given image URL
if ( ! function_exists( 'icore_get_attachment_id' ) ) {
    /**
     * Get the Attachment ID for a given image URL.
     * @param  string $url
     * @return boolean|integer
     */
    function icore_get_attachment_id( $url ) {

        $dir = wp_upload_dir();

        // baseurl never has a trailing slash
        if ( false === strpos( $url, $dir['baseurl'] . '/' ) ) {
            // URL points to a place outside of upload directory
            return false;
        }

        $file  = basename( $url );
        $query = array(
            'post_type'  => 'attachment',
            'fields'     => 'ids',
            'meta_query' => array(
                array(
                    'value'   => $file,
                    'compare' => 'LIKE',
                ),
            )
        );

        $query['meta_query'][0]['key'] = '_wp_attached_file';

        // query attachments
        $ids = get_posts( $query );

        if ( ! empty( $ids ) ) {

            foreach ( $ids as $id ) {

                // first entry of returned array is the URL
                if ( $url === array_shift( wp_get_attachment_image_src( $id, 'full' ) ) )
                    return $id;
            }
        }

        $query['meta_query'][0]['key'] = '_wp_attachment_metadata';

        // query attachments again
        $ids = get_posts( $query );

        if ( empty( $ids) )
            return false;

        foreach ( $ids as $id ) {

            $meta = wp_get_attachment_metadata( $id );

            foreach ( $meta['sizes'] as $size => $values ) {

                if ( $values['file'] === $file && $url === array_shift( wp_get_attachment_image_src( $id, $size ) ) )
                    return $id;
            }
        }

        return false;
    }
}

/**
 * Header image styling
 */
function ufo_header_image() {
	$header_image = get_header_image();

	if ( ! empty( $header_image ) ) {
		echo ' style="background-image:url(' . $header_image . ');height:' . get_custom_header()->height . 'px;background-size:cover;background-position:50%"';
	}
}

function topshop_layer_slider_check(){
	$plugins = get_option( 'active_plugins' );
	if ( in_array ( 'LayerSlider/layerslider.php', $plugins ) )
		return true;
}
?>