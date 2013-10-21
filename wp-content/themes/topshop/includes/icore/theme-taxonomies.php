<?php

/*-----------------------------------------------------------------------------------*/
/* Register Theme Taxonomies */
/*-----------------------------------------------------------------------------------*/

add_action( 'init', 'ps_portfolio_create_type' );

function ps_portfolio_create_type() {

	register_post_type('portfolio',
		array(
			'labels' => array(
				'name'						=> __('Portfolios','TopShop'),
				'singular_name' 			=> __('Portfolio','TopShop'),
				'add_new'					=> __('Add New', 'TopShop'),
				'add_new_item'				=> __('Add Portfolio', 'TopShop'),
				'new_item'					=> __('Add Portfolio', 'TopShop'),
				'view_item'					=> __('View Portfolio', 'TopShop'),
				'search_items' 				=> __('Search Portfolio', 'TopShop'),
				'edit_item' 				=> __('Edit Portfolio', 'TopShop'),
				'all_items'					=> __('All Portfolios', 'TopShop'),
				'not_found'					=> __('No Portfolios found', 'TopShop'),
				'not_found_in_trash'		=> __('No Portfolios found in Trash', 'TopShop')
			),
			'taxonomies'	=> array('pcategory', 'ptag'),
			'public' => true,
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'portfolio', 'with_front' => false,  'feeds' => ''  ),
			'query_var' => true,
			'supports' => array('title','revisions','thumbnail','author','editor', 'excerpt'),
			'menu_position' => 5,
			'has_archive' => true
		)
	);
}

/*-----------------------------------------------------------------------------------*/
/* Register taxonomy for new post type */
/*-----------------------------------------------------------------------------------*/

add_action( 'init', 'ps_portfolio_taxonomy', 0 );

function ps_portfolio_taxonomy() {
	// Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'Categories', 'taxonomy general name', 'TopShop' ),
    'singular_name' => _x( 'Category', 'taxonomy singular name', 'TopShop' ),
    'search_items' =>  __( 'Search Categories', 'TopShop' ),
    'all_items' => __( 'All Categories', 'TopShop' ),
    'parent_item' => __( 'Parent Category', 'TopShop' ),
    'parent_item_colon' => __( 'Parent Category:', 'TopShop' ),
    'edit_item' => __( 'Edit Category', 'TopShop' ),
    'update_item' => __( 'Update Category', 'TopShop' ),
    'add_new_item' => __( 'Add New Category', 'TopShop' ),
    'new_item_name' => __( 'New Category Name', 'TopShop' ),
    'menu_name' => __( 'Categories', 'TopShop' )
  );
	register_taxonomy('pcategory','portfolio',array(
				'hierarchical' => true,
				'labels' => $labels,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'pcategory' )
	));
}

add_action( 'init', 'ps_portfolio_tags', 1 );

function ps_portfolio_tags() {
	register_taxonomy( 'ptag', 'portfolio', array(
				'hierarchical' => false,
				'update_count_callback' => '_update_post_term_count',
				'label' => __('Tags', 'TopShop'),
				'query_var' => true,
				'rewrite' => array( 'slug' => 'ptags' )
	)) ;
}

// Flush rewrite rules for custom post type and taxonomies added in theme
function icore_flush_rewrite_rules() {
    global $pagenow, $wp_rewrite;

    if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) )
        $wp_rewrite->flush_rules();
}

add_action( 'load-themes.php', 'icore_flush_rewrite_rules' );

?>