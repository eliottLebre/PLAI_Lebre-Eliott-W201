<?php
// CONFIGURATION DU THÈME
function plaitheme_supports(): void
{
    add_theme_support('title-tag');
    add_theme_support('menus');
    register_nav_menu('header-menu', 'Header Menu');
}

;
function plaitheme_register_assets(): void
{
    wp_enqueue_style('montheme-css-principal', get_template_directory_uri() . '/public/style.css', [], '1.0');
    wp_enqueue_script('montheme-script-principal', get_template_directory_uri() . '/public/main.js', [], false, true);
}

;

function plaitheme_title_separator($separateur_original): string
{
    return (' - ');
}

;

function plaitheme_sensibilisations_cpt(): void
{
    register_post_type('sensibilisation',
        [
            'labels' =>
                [
                    'name' => 'Sensibilisations',
                    'singular_name' => 'Sensibilisation',
                    'add_new'       => 'Ajouter une sensibilisation',
                    'add_new_item'       => 'Ajouter une sensibilisation',
                    'edit_item'     => 'Modifier la sensibilisation',
                    'not_found'     => 'Aucune sensibilisation trouvée',
                ],
            'public' => true,
            'menu_position' => 10,
            'has_archive' => false,
            'supports' => ['title'],
            'menu_icon' => 'dashicons-welcome-learn-more',
        ]);
}

add_action('after_setup_theme', 'plaitheme_supports');
add_action('wp_enqueue_scripts', 'plaitheme_register_assets');
add_filter('document_title_separator', 'plaitheme_title_separator');
add_action('init', 'plaitheme_sensibilisations_cpt');


// DÉSACTIVATION DE GUTENBERG ET DES CSS NATIFS
add_filter('use_block_editor_for_post', '__return_false');
add_filter('use_widgets_block_editor', '__return_false');

add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
}, 20);


// DÉSACTIVATION DU TEXT-AREA DE BASE SUR LES PAGES
add_action('init', 'init_remove_support', 100);
function init_remove_support(): void
{
    remove_post_type_support('post', 'editor');
    remove_post_type_support('page', 'editor');
    remove_post_type_support('product', 'editor');
}


// SUPPRESSION DES ARTICLES ET COMMENTAIRES
add_action('admin_menu', function () {
    remove_menu_page('edit.php');
    remove_menu_page('edit-comments.php');
}, 999);

add_action('wp_before_admin_bar_render', function () {
    global $wp_admin_bar;
    if (!is_object($wp_admin_bar)) {
        return;
    }

    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('new-post');
}, 999);

add_action('init', function () {
    add_filter('comments_open', '__return_false', 20, 2);
    add_filter('pings_open', '__return_false', 20, 2);
    add_filter('comments_array', '__return_empty_array', 20, 2);
    remove_post_type_support('post', 'comments');
    remove_post_type_support('page', 'comments');
    remove_post_type_support('attachment', 'comments');
}, 100);

add_action('admin_init', function () {
    global $pagenow;

    $blocked_pages = [
        'edit.php',
        'post-new.php',
        'post.php',
        'edit-comments.php',
        'comment.php',
    ];

    if (in_array($pagenow, $blocked_pages, true)) {
        $post_type = $_GET['post_type'] ?? null;

        if ($pagenow === 'edit.php' && empty($post_type)) {
            wp_die('Accès désactivé : Articles.', 'Accès refusé', ['response' => 403]);
        }

        if ($pagenow === 'edit.php' && $post_type === 'post') {
            wp_die('Accès désactivé : Articles.', 'Accès refusé', ['response' => 403]);
        }

        if ($pagenow === 'post-new.php') {
            $pt = $_GET['post_type'] ?? 'post';
            if ($pt === 'post') {
                wp_die('Création d’articles désactivée.', 'Accès refusé', ['response' => 403]);
            }
        }

        if ($pagenow === 'post.php' && isset($_GET['post'])) {
            $post_id = (int)$_GET['post'];
            if ($post_id > 0 && get_post_type($post_id) === 'post') {
                wp_die('Édition d’articles désactivée.', 'Accès refusé', ['response' => 403]);
            }
        }

        if ($pagenow === 'edit-comments.php' || $pagenow === 'comment.php') {
            wp_die('Commentaires désactivés.', 'Accès refusé', ['response' => 403]);
        }
    }
}, 1);