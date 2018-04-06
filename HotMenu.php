<?php
/*
Plugin Name: PartnerComm HotMenu
Description: Add Quick Hot Menus Based On Taxonomy and Term Pairs
Version: 1.0.2
Author: Phil Palmieri
Author Email: ppalmieri@partnercomm.net
Text Domain: partnercomm-hotmenu
License:     GPL2
 
PartnerComm HotMenu is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
PartnerComm HotMenu is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
GNU General Public License https://www.gnu.org/licenses/gpl-2.0.html
*/

namespace PComm\WP\Plugins;

class HotMenu {

  public function init()
  {
    add_shortcode( 'hotmenu', [$this, 'doShortcode'] );
  }

  public function doShortcode($atts)
  {
    foreach($atts as $tax => $term) {
      if(term_exists($term, $tax)) {
          $taxMatches[] = [
              'taxonomy' => $tax,
              'field' => 'slug',
              'terms' => $term
          ];
      }
    }

    $the_query = new \WP_Query( ['tax_query' => $taxMatches] );
    $baseLink = (!empty($atts['base-link'])) ? $atts['base-link'] : '';
    $ulClass = (!empty($atts['ul-class'])) ? $atts['ul-class'] : '';
    $menu = "<nav class='hotmenu'><ul class='{$ulClass}'>";
    while ( $the_query->have_posts() ) : 
      $the_query->the_post();
      $slug = get_post_field( 'post_name', get_post() );
      $url = $baseLink . '#' . $slug;
      $menu .= "<li><a href='{$url}' target='_self'>".get_the_title()."</a></li>";
    endwhile;
    $menu .= "</ul></nav>";

    return $menu;
  }

}

$hotMenu = new HotMenu();
add_action( 'init', [$hotMenu, 'init'] );