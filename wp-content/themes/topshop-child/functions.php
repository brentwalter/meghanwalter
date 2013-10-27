<?php

/***************************************************************************
    Built by Brent Walter
    Copyright (C) 2013
***************************************************************************/

//Prints out category name with specific class that is styleable for category icon background
function MW_the_category() {
	$categories = get_the_category();
	
	if ($categories) {
		$category = $categories[0];
		if ( $category ) {
			$output = '<i class="'. $category->slug .'"></i><a href="'. get_category_link( $category->term_id ) .'" class="'. $category->slug .'">'. $category->cat_name .'</a>';
			echo $output;
		}
	} else {
		return;
	}
}

// Add custom sizes of images
//full is 1000
add_theme_support( 'post-thumbnails' ); // This feature enables post-thumbnail support for a theme
add_filter( 'image_size_names_choose', 'add_custom_image_sizes' );

add_image_size( 'half-width-portrait', 496, 658, true ); 
add_image_size( 'half-width-landscape', 496, 330, true ); 

add_image_size( 'third-width-portrait', 328, 435, true ); 
add_image_size( 'third-width-landscape', 328, 218, true ); 

function add_custom_image_sizes ($sizes) {

	return array_merge( $sizes, array(
        'half-width-portrait' => __('Half-width Portrait'),
        'half-width-landscape' => __('Half-width Landscape'),
        'third-width-portrait' => __('Third-width Portrait'),
        'third-width-landscape' => __('Third-width Landscape'),
    ) );
	
}

?>