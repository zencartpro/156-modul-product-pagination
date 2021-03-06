<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_products_next_previous.php for Product Pagination 2021-02-09 16:49:16Z webchills $
 */

/*
 WebMakers.com Added: Previous/Next through categories products
 Thanks to Nirvana, Yoja and Joachim de Boer
 Modifications: Linda McGrath osCommerce@WebMakers.com
*/
//-bof-product_pagination-lat9  *** 1 of 1 ***
// -----
// If the "Product Pagination" plugin is installed and enabled, use that plugin's version of the next/previous display formatting.
//
if (isset($ppObserver) && $ppObserver->isPaginationEnabled('product')) {
    require $template->get_template_dir('/tpl_pp_products_next_previous.php', DIR_WS_TEMPLATE, $current_page_base, 'templates') . '/tpl_pp_products_next_previous.php';
    return;
}
//-eof-product_pagination-lat9  *** 1 of 1 ***
?>
<?php
  if (!isset($display_as_mobile)) $display_as_mobile = ($detect->isMobile() && !$detect->isTablet() || $_SESSION['layoutType'] == 'mobile' or  $detect->isTablet() || $_SESSION['layoutType'] == 'tablet'); 
?>

<div class="navNextPrevWrapper centeredContent">
<?php
// only display when more than 1
  if ($products_found_count > 1) {
?>
<p class="navNextPrevCounter"><?php echo (PREV_NEXT_PRODUCT); ?><?php echo ($position+1 . "/" . $counter); ?></p>
<div class="navNextPrevList"><a href="<?php echo zen_href_link(zen_get_info_page($previous), "cPath=$cPath&products_id=$previous"); ?>"><?php if ($display_as_mobile) { echo '<i class="fa fa-chevron-circle-left" title="' . BUTTON_PREVIOUS_ALT . '"></i></a></div>';?><?php } else { ?><?php echo $previous_image . $previous_button; ?></a></div><?php } ?>

<div class="navNextPrevList"><a href="<?php echo zen_href_link(FILENAME_DEFAULT, "cPath=$cPath"); ?>"><?php if ($display_as_mobile) { echo '<i class="fa fa-list" title="' . BUTTON_VIEW_ALL_ALT . '"></i></a></div>';?><?php } else { ?><?php echo zen_image_button(BUTTON_IMAGE_RETURN_TO_PROD_LIST, BUTTON_RETURN_TO_PROD_LIST_ALT); ?></a></div><?php } ?>

<div class="navNextPrevList"><a href="<?php echo zen_href_link(zen_get_info_page($next_item), "cPath=$cPath&products_id=$next_item"); ?>"><?php if ($display_as_mobile) { echo '<i class="fa fa-chevron-circle-right" title="' . BUTTON_NEXT_ALT . '"></i></a></div>';?><?php } else { ?><?php echo  $next_item_button . $next_item_image; ?></a></div><?php } ?>

<?php
  }
?>
</div>
