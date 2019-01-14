<?php
namespace Evermade\Swiss;

class Subnav_Walker_Nav_Menu extends \Walker_Nav_Menu
{
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= ' <button class="c-circle-plus js-menu-toggle closed" aria-expanded="false" aria-label="'.__('Toggle the sub-navigation for this item', 'swiss').'" tabindex="0">
  <div class="circle">
    <div class="horizontal"></div>
    <div class="vertical"></div>
  </div>
</button>';
        $output .= '<ul class="c-primary-navigation__submenu js-submenu"><li><ul class="c-primary-navigation__submenu--inner">';
    }

    public function end_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= '</ul></li></ul>';
    }

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $classes = array();
        if (!empty($item->classes)){
            $classes = (array) $item->classes;
        }

        $activeItemAttr = '';
        $activeItemClass = '';
        if (in_array('current-menu-item', $classes)) {
            $activeItemAttr = ' aria-current="page" ';
            $activeItemClass = ' is-current-menu-item ';
        }

        $activeParentClass = '';
        if (in_array('current-page-ancestor', $classes)) {
            $activeParentClass = ' is-active-parent ';
        }

        $parentClass = '';
        if (in_array('menu-item-has-children', $classes)) {
            $parentClass = ' has-children ';
        }

        // Get attributes for links
        $linkAttributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $linkAttributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $linkAttributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $linkAttributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        // General item class(es)
        $itemClass = ' c-primary-navigation__item ';

        // Gather classes for output
        $outputClasses = implode(' ', array($itemClass, $activeItemClass, $activeParentClass, $parentClass));

        // Link URL
        $url = '';
        if (!empty($item->url)) {
            $url = $item->url;
        }

        // Output link
        $output .= '<li class="'.$outputClasses.'" '. $activeItemAttr .'><a '.$linkAttributes.' href="' . $url . '">' . $item->title .'</a>';
    }

    public function end_el(&$output, $item, $depth = 0, $args = array())
    {
        $output .= '</li>';
    }
}