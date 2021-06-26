<?php
// -----
// Part of the "Product Pagination" plugin by lat9 (lat9@vinosdefrutastropicales.com)
// Copyright (c) 2010-2020 Vinos de Frutas Tropicales
// 
define('PP_PREV_NEXT_PRODUCT', 'Aktuelles Produkt ');
define('PP_PREV_NEXT_PRODUCT_SEP', ' von ');
define('PP_TEXT_PREVIOUS', 'Vorherige');
define('PP_TEXT_NEXT', 'Nächste');
define('PP_TEXT_PRODUCT_LISTING', 'Produktliste anzeigen');
define('PP_TEXT_PRODUCT_LISTING_TITLE', 'Mehr anzeigen &quot;%s&quot;'); // %s is replaced by the categories name
define('PP_TEXT_PAGE', 'Seite: ');
define('PP_TEXT_ITEMS_PER_PAGE', 'Artikel pro Seite: ');
define('PP_TEXT_ALL', 'Alle');

// -----
// Starting with v2.1.0 of 'Product Pagination', the split-page-results 'base' class
// is based on the zc157 version.  There were a couple of language constants added at that
// time.  If we're running under a Zen Cart version prior to zc157, define those constants.
//
if (PROJECT_VERSION_MAJOR === '1' && PROJECT_VERSION_MINOR < '5.7') {
    define('ARIA_PAGINATION_ROLE_LABEL_GENERAL','Seitennummerierung');
    define('ARIA_PAGINATION_ROLE_LABEL_FOR','%s Seitennummerierung'); // eg: "Search results Pagination"
    define('ARIA_PAGINATION_PREVIOUS_PAGE','Zur vorigen Seite gehen');
    define('ARIA_PAGINATION_NEXT_PAGE','Zur nächsten Seite gehen');
    define('ARIA_PAGINATION_CURRENT_PAGE','Aktuelle Seite');
    define('ARIA_PAGINATION_CURRENTLY_ON',', jetzt auf Seite %s');
    define('ARIA_PAGINATION_GOTO','Weiter zu ');
    define('ARIA_PAGINATION_PAGE_NUM','Seite %s');
    define('ARIA_PAGINATION_ELLIPSIS_PREVIOUS','Vorherige Gruppe von Seiten holen');
    define('ARIA_PAGINATION_ELLIPSIS_NEXT','Nächste Seitengruppe holen');
    define('ARIA_PAGINATION_','');
}
