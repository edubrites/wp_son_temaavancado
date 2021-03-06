<?php
/**
 * Bootstrap Basic theme
 * 
 * @package bootstrap-basic
 */


/**
 * Required WordPress variable.
 */
if (!isset($content_width)) {
    $content_width = 1170;
}


if (!function_exists('bootstrapBasicSetup')) {
    /**
     * Setup theme and register support wp features.
     */
    function bootstrapBasicSetup() 
    {
        /**
         * Make theme available for translation
         * Translations can be filed in the /languages/ directory
         * 
         * copy from underscores theme
         */
        load_theme_textdomain('bootstrap-basic', get_template_directory() . '/languages');

        // add theme support title-tag
        add_theme_support('title-tag');

        // add theme support post and comment automatic feed links
        add_theme_support('automatic-feed-links');

        // enable support for post thumbnail or feature image on posts and pages
        add_theme_support('post-thumbnails');

        // allow the use of html5 markup
        // @link https://codex.wordpress.org/Theme_Markup
        add_theme_support('html5', array('caption', 'comment-form', 'comment-list', 'gallery', 'search-form'));

        // add support menu
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'bootstrap-basic'),
        ));

        // add post formats support
        add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));

        // add support custom background
        add_theme_support(
            'custom-background', 
            apply_filters(
                'bootstrap_basic_custom_background_args', 
                array(
                    'default-color' => 'ffffff', 
                    'default-image' => ''
                )
            )
        );
    }// bootstrapBasicSetup
}
add_action('after_setup_theme', 'bootstrapBasicSetup');


if (!function_exists('bootstrapBasicWidgetsInit')) {
    /**
     * Register widget areas
     */
    function bootstrapBasicWidgetsInit() 
    {
        register_sidebar(array(
            'name' => __('Sidebar right', 'bootstrap-basic'),
            'id' => 'sidebar-right',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));

        register_sidebar(array(
            'name' => __('Sidebar left', 'bootstrap-basic'),
            'id' => 'sidebar-left',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));

        register_sidebar(array(
            'name' => __('Header right', 'bootstrap-basic'),
            'id' => 'header-right',
            'description' => __('Header widget area on the right side next to site title.', 'bootstrap-basic'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));

        register_sidebar(array(
            'name' => __('Navigation bar right', 'bootstrap-basic'),
            'id' => 'navbar-right',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '',
            'after_title' => '',
        ));

        register_sidebar(array(
            'name' => __('Footer left', 'bootstrap-basic'),
            'id' => 'footer-left',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));

        register_sidebar(array(
            'name' => __('Footer right', 'bootstrap-basic'),
            'id' => 'footer-right',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));
    }// bootstrapBasicWidgetsInit
}
add_action('widgets_init', 'bootstrapBasicWidgetsInit');


if (!function_exists('bootstrapBasicEnqueueScripts')) {
    /**
     * Enqueue scripts & styles
     */
    function bootstrapBasicEnqueueScripts() 
    {
        global $wp_scripts;

        wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.7');
        wp_enqueue_style('bootstrap-theme-style', get_template_directory_uri() . '/css/bootstrap-theme.min.css', array(), '3.3.7');
        wp_enqueue_style('fontawesome-style', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0');
        wp_enqueue_style('main-style', get_template_directory_uri() . '/css/main.css');

        wp_enqueue_script('modernizr-script', get_template_directory_uri() . '/js/vendor/modernizr.min.js', array(), '3.3.1');
        wp_register_script('respond-script', get_template_directory_uri() . '/js/vendor/respond.min.js', array(), '1.4.2');
        $wp_scripts->add_data('respond-script', 'conditional', 'lt IE 9');
        wp_enqueue_script('respond-script');
        wp_register_script('html5-shiv-script', get_template_directory_uri() . '/js/vendor/html5shiv.min.js', array(), '3.7.3');
        $wp_scripts->add_data('html5-shiv-script', 'conditional', 'lte IE 9');
        wp_enqueue_script('html5-shiv-script');
        wp_enqueue_script('jquery');
        wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/js/vendor/bootstrap.min.js', array(), '3.3.7', true);
        wp_enqueue_script('main-script', get_template_directory_uri() . '/js/main.js', array(), false, true);
        wp_enqueue_style('bootstrap-basic-style', get_stylesheet_uri());
    }// bootstrapBasicEnqueueScripts
}
add_action('wp_enqueue_scripts', 'bootstrapBasicEnqueueScripts');


/**
 * admin page displaying help.
 */
if (is_admin()) {
    require get_template_directory() . '/inc/BootstrapBasicAdminHelp.php';
    $bbsc_adminhelp = new BootstrapBasicAdminHelp();
    add_action('admin_menu', array($bbsc_adminhelp, 'themeHelpMenu'));
    unset($bbsc_adminhelp);
}


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';


/**
 * Custom dropdown menu and navbar in walker class
 */
require get_template_directory() . '/inc/BootstrapBasicMyWalkerNavMenu.php';


/**
 * Template functions
 */
require get_template_directory() . '/inc/template-functions.php';


/**
 * --------------------------------------------------------------
 * Theme widget & widget hooks
 * --------------------------------------------------------------
 */
require get_template_directory() . '/inc/widgets/BootstrapBasicSearchWidget.php';
require get_template_directory() . '/inc/template-widgets-hook.php';



/**
 * --------------------------------------------------------------
 * Criação de Tema Avançado com Custom Post Type School Of Net
 * --------------------------------------------------------------
 */

function bootstrap_son_post_types_filmes()
{
	$labels = array(
		'name' => "Filmes",
		'singular_name' => "Filme",
		'add_new' => "Adicionar novo filme",
		'add_new_label' => "Adicionar novo filme",
		'all_item' => "Ver todos os filmes",
		'add_new_item' => "Adicionar novo filme",
		'edit_item' => "Editar Filme",
		'new_item' => "Novo Filme",
		'view_item' => "Visualizar Filme",
		'search_item' => "Procurar Filme",
		'not_found' => "Nenhum filme encontrado",
		'not_found_in_trash' => "Nenhum filme na lixeira"
	);
	
	$args = array(
		'labels' => $labels,	
		'public' => true,	
		'has_archive' => true,	
		'publicy_queryable' => true,	
		'query_var' => true,	
		'rewrite' => true,	
		'capability_type' => "post",	
		'supports' => array(
				'title','editor', 'thumbnail', 'excerpt'			
			),	
		'menu_position' => 5,	
		'exclude_from_search' => false		
	);
	
	register_post_type('filmes',$args);
	
}
add_action('init','bootstrap_son_post_types_filmes');

function bootstrap_son_taxonomias(){

	// Taxonomia Hierarquica - Gênero
	
	$labels = array(
		'name' => "Gêneros",
		'singular_name' => "Gênero",
		'search_items' => "Procurar Gênero",
		'all_items' => "Ver todos os gêneros",
		'parent_item' => "Gênero Pai",
		'parent_item_colon' => "Gênero Pai",
		'edit_item' => "Editar Gênero",
		'update_item' => "Atualizar Gênero",
		'add_new_item' => "Adicionar novo gênero",
		'new_item_name' => "Novo Gênero",
		'menu_name' => "Gêneros"
	);

	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array("slug"=>"genero")
	);

	register_taxonomy('genero', 'filmes',$args);
	
	
	// Taxonomia NÃO Hierarquica - Diretores
	
	$labelsDiretor = array(
		'name' => "Diretores",
		'singular_name' => "Diretor",
		'search_items' => "Procurar Diretore",
		'all_items' => "Ver todos os diretores",
		'parent_item' => "Diretor Pai",
		'parent_item_colon' => "Diretor Pai",
		'edit_item' => "Editar Diretores",
		'update_item' => "Atualizar Diretor",
		'add_new_item' => "Adicionar novo diretor",
		'new_item_name' => "Novo Diretor",
		'menu_name' => "Diretores"
	);

	$argsDiretor = array(
		'hierarchical' => false,
		'labels' => $labelsDiretor,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array("slug"=>"diretores")
	);

	register_taxonomy('diretor', 'filmes',$argsDiretor);
}
add_action('init','bootstrap_son_taxonomias');