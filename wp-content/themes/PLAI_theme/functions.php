<?php

require_once get_template_directory() . '/core/theme/configuration.php';

register_nav_menu('header-menu', 'Header Menu');

// Function permettant de récupérer les éléments d'un menu de navigation sous forme de lien
function dw_get_navigation_links(string $location): array
{
    // Récupérer l'objet W¨pour le menu
    $locations = get_nav_menu_locations();

    if (!isset($locations[$location])) {
        return [];
    }

    $nav_id = $locations[$location];
    $nav = wp_get_nav_menu_items($nav_id);

    // Transformer le menu en tableau de liens, chaque lien va être un objet personnalisé
    $links = [];

    foreach ($nav as $post) {
        $link = new stdClass();
        $link->href = $post->url;
        $link->label = $post->title;

        $links[] = $link;
    }

    return $links;
}