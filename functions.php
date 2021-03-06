<?php

/*---  Support WordPress features
*----------------------------------- */
function funkshun_theme_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	add_theme_support( 'post-thumbnails' );
   	add_theme_support( 'title-tag' );
	
	// --- Gutenberg support --- 
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'wp-block-styles' );
	//add_theme_support( 'align-wide' ); If you need full-width content
	
	/* --- Add custom colour pallette 
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => __( 'strong magenta', 'my-project' ),
				'slug'  => 'Offwhite',
				'color' => '#ededed',
			),
		)
	);
	
	*/
	
	/* --- Add custom text sizes
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name' => __( 'Small', 'my-project' ),
				'size' => 12,
				'slug' => 'small',
			),
		)
	) */
	
	// add_theme_support( 'disable-custom-font-sizes' ); // Remove custom font sizes
	// add_theme_support( 'disable-custom-colours' ); // Remove colourpicker
	
	// add_editor_style( 'css/editor-style.css' ); // Add a custom editor stylesheet
	// add_theme_support( 'editor-styles' ); // Enable custom editor stylesheet
}
add_action( 'after_setup_theme', 'funkshun_theme_setup' );


/*---  Scripts
*------------------------------ */

function funkshun_load_scripts() {

    //wp_enqueue_style( 'flexslider', get_stylesheet_directory_uri() . '/css/flexslider.css' );
    //wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery') );  
}

add_action( 'wp_enqueue_scripts', 'funkshun_load_scripts' );

/*---  Featured images
*------------------------------ */
function funkshun_image_setup() {
    //set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions  
    //add_image_size( 'news-thumb', 220, 140, true );
}
add_action( 'after_setup_theme', 'funkshun_image_setup' );

/*---  Add options to the_excerpt
*----------------------------------- */
function funkshun_excerpt($limit) {
    $defaults = array (
			'limit' => 20
		);

    $args = wp_parse_args( $args, $defaults );
    extract( $args, EXTR_SKIP );

    $content = get_the_excerpt();
    
    $excerpt = explode(' ', $content, ($limit+1));
    
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'';
        }
    else {
        $excerpt = implode(" ",$excerpt);
        }
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    $excerpt = trim(wp_kses_data($excerpt, ''));
            
    echo esc_attr($excerpt);
}

/*---  Widget areas
*------------------------------ */
function funkshun_widget_areas () {
	$args = array(
		'name'          => __( 'Main widget area'),
		'id'            => 'main-sidebar',
		'description'   => 'Widgets placed here will appear in the sidebar',
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>' );
	
	register_sidebar( $args );
}
add_action( 'widgets_init', 'funkshun_widget_areas' );

/*---   Menus
 *------------------------- */
function funkshun_register_menus() {
	register_nav_menu ( 'Main menu', 'The main menu' );
	register_nav_menu ( 'Footer menu', 'The footer menu' );
}
add_action( 'after_setup_theme', 'funkshun_register_menus' );
