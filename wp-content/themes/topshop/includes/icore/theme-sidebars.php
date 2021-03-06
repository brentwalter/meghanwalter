<?php

/*-----------------------------------------------------------------------------------*/
/* Register Theme Sidebars */
/*-----------------------------------------------------------------------------------*/  

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'sidebar',
		'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
		'after_widget' => '</div> <!-- .widget-content --></div> <!-- .widget -->',
		'before_title' => '<div class="sidebar-header"><h3>',
		'after_title' => '</h3></div><div class="widget-content">',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
	'name' => 'Homepage',
	'id' => 'homepage',
    'before_widget' => '<div id="%1$s" class="home-widget %2$s"><div class="widget-content">',
    'after_widget' => '</div> <!-- .widget-content --></div> <!-- .home-widget -->',
	'before_title' => '<h2 class="widgettitle"><span class="title-bg">',
	'after_title' => '</span></h2>',
    ));  

if ( function_exists('register_sidebar') )
    register_sidebar(array(
	'name' => 'Homepage Bottom',
	'id' => 'homepage-bottom',
    'before_widget' => '<div id="%1$s" class="home-widget %2$s"><div class="widget-content">',
    'after_widget' => '</div> <!-- .widget-content --></div> <!-- .home-widget -->',
	'before_title' => '<h2 class="widgettitle"><span class="title-bg">',
	'after_title' => '</span></h2>',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
	'name' => 'Footer',
	'id' => 'footer-sidebar',
    'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
    'after_widget' => '</div> <!-- .widget-content --></div> <!-- .footer-widget -->',
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4><div class="widget-content">',
    ));   
?>