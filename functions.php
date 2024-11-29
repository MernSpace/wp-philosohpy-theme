<?php


require_once (get_theme_file_path("/inc/tgm.php"));
require_once (get_theme_file_path("/inc/attachments.php"));


if(site_url() == "http://localhost/newwordpress/") {
    define("VERSION", time());
}else{
    define("VERSION", wp_get_theme()->get( 'Version' ));
}
function  philosophy_theme_setup(){
    load_theme_textdomain( 'philosophy');
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', array( 'search-form', 'comment-list', ) );
    add_theme_support( 'post-formats', array( 'gallery', 'image', 'video', 'quote', 'link','audio' ) );
    add_editor_style('/assets/css/editor-style.css');

    register_nav_menu("topmenu", "Top Menu","philosophy");
    register_nav_menus(array(
        'footer-left'=>__('Footer Left','philosophy'),
        'footer-right'=>__('Footer Right','philosophy'),
        'footer-middle'=>__('Footer Middle','philosophy'),
    ));
    add_image_size('philosophy-home-thumb', 400, 400, true);
}

add_action('after_setup_theme', 'philosophy_theme_setup');


function philosophy_assets(){
    wp_enqueue_style( 'fontawesome', get_theme_file_uri('/assets/css/font-awesome/css/font-awesome.css'), null, '1.0');
    wp_enqueue_style( 'font-css', get_theme_file_uri('/assets/css/fonts.css'), null, '1.0' );
    wp_enqueue_style( 'base-css', get_theme_file_uri('/assets/css/base.css'), null, '1.0' );
    wp_enqueue_style( 'vendor-css', get_theme_file_uri('/assets/css/vendor.css'), null, '1.0');
    wp_enqueue_style( 'main-css', get_theme_file_uri('/assets/css/main.css'), null, '1.0' );
    wp_enqueue_style( 'philosophy-css', get_stylesheet_uri(),null,'1.0');


    wp_enqueue_script("modernizer-js", get_theme_file_uri('/assets/js/modernizr.js'), null, '1.0' );
    wp_enqueue_script("pace-js", get_theme_file_uri('/assets/js/pace.min.js'), null, '1.0' );
    wp_enqueue_script("plugins-js", get_theme_file_uri('/assets/js/plugins.js'), array('jquery'), '1.0',true );
    wp_enqueue_script("main-js", get_theme_file_uri('/assets/js/main.js'), array('jquery'), '1.0',true );

}

add_action('wp_enqueue_scripts', 'philosophy_assets');


function philosophy_pagination(){
    global $wp_query;
    $link = paginate_links( array(
        'current' => max( 1, get_query_var('paged') ),
        'total'   => $wp_query->max_num_pages,
        'type'    => 'list',
        'mid_size' => 4,
    ));
    $link = str_replace("page-numbers", "pgn__num", $link);
    $link = str_replace("<ul class='pgn__num'>", "<ul>", $link);
    $link = str_replace("next pgn__num", "pgn__next", $link);
    $link = str_replace("prev pgn__num", "pgn__prev", $link);
    echo $link;
}



remove_action('term_description', 'wpautop');


function philosophy_widgets(){
    register_sidebar(array(
        'name' => __('About us page', 'philosophy'),
        'id' => 'about-us',
        'description' => __('This is the About Us widget.', 'philosophy'),
        'before_widget' => '<div id="%1$s" class="col-block %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="quarter-top-margin">',
        'after_title' => '</h3>',

    ));
    register_sidebar(array(
        'name' => __('Contact Page Maps Section', 'philosophy'),
        'id' => 'contact-map',
        'description' => __('This is the contact widget.', 'philosophy'),
        'before_widget' => '<div id="%1$s" class=" %2$s">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => '',

    ));
    register_sidebar(array(
        'name' => __('Contact Page info Section', 'philosophy'),
        'id' => 'contact-info',
        'description' => __('This is the contact info widget.', 'philosophy'),
        'before_widget' => '<div id="%1$s" class="col-block %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="quarter-top-margin">',
        'after_title' => '</h3>'

    ));
    register_sidebar(array(
        'name' => __('Before Footer Section', 'philosophy'),
        'id' => 'before-footer-right',
        'description' => __('This is the before footer section widget.', 'philosophy'),
        'before_widget' => '<div id="%1$s" class=" %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'

    ));
    register_sidebar(array(
        'name' => __('Footer right Section', 'philosophy'),
        'id' => 'footer-right',
        'description' => __('This is the footer right section widget.', 'philosophy'),
        'before_widget' => '<div id="%1$s" class=" %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>'

    ));
    register_sidebar(array(
        'name' => __('Footer bottom Section', 'philosophy'),
        'id' => 'footer-bottom',
        'description' => __('This is the footer bottom section widget.', 'philosophy'),
        'before_widget' => '<div id="%1$s" class=" %2$s">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => ''

    ));
}


add_action("widgets_init","philosophy_widgets");

function philosophy_search_form($form){
    $homeUrl = home_url('/');
    $formLevel = __('Search for: ', 'philosophy');
    $buttonLevel = __('Search', 'philosophy');
    $newform = <<< FORM
<form role="search" method="get" class="header__search-form" action="{$homeUrl}">
                    <label>
                        <span class="hide-content">{$formLevel}</span>
                        <input type="search" class="search-field" placeholder="Type Keywords" value="" name="s" title="Search for:" autocomplete="off">
                    </label>
                    <input type="submit" class="search-submit" value="{$buttonLevel}">
                </form>
FORM;
return $newform;
}


add_action('get_search_form', 'philosophy_search_form');