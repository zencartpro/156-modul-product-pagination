<?php
// -----
// Part of the "Products Pagination" plugin by lat9 (lat9@vinosdefrutastropicales.com)
//
// Starting with v2.0.0 of the plugin, perform the auto-install of the various configuration items.
//
define('PRODUCTS_PAGINATION_VERSION_CURRENT', '2.1.0');
define('PRODUCTS_PAGINATION_VERSION_CURRENT_DATE', '06-14-2020');

$pp_current_version = PRODUCTS_PAGINATION_VERSION_CURRENT . ' (' . PRODUCTS_PAGINATION_VERSION_CURRENT_DATE . ')';

$configurationGroupTitle = 'Products Pagination';
$configuration = $db->Execute("SELECT configuration_group_id FROM " . TABLE_CONFIGURATION_GROUP . " WHERE configuration_group_title = '$configurationGroupTitle' LIMIT 1");
if ($configuration->EOF) {
    $db->Execute("INSERT INTO " . TABLE_CONFIGURATION_GROUP . " 
                    (configuration_group_title, configuration_group_description, sort_order, visible) 
                    VALUES ('$configurationGroupTitle', 'Product Pagination Settings', 1, 1);");
    $configuration_group_id = $db->Insert_ID(); 
    $db->Execute("UPDATE " . TABLE_CONFIGURATION_GROUP . " SET sort_order = $configuration_group_id WHERE configuration_group_id = $configuration_group_id LIMIT 1");
} else {
    $configuration_group_id = $configuration->fields['configuration_group_id'];
}

// -----
// Set the various configuration items, if "Product Pagination" wasn't previously installed.
//
if (!defined('PRODUCTS_PAGINATION_MAX')) {
    $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function ) VALUES ( 'Products Pagination Version', 'PRODUCTS_PAGINATION_VERSION', '$pp_current_version', 'This is the current version of the plugin.<br />', $configuration_group_id, 1, now(), NULL, 'trim(')");
	
	$db->Execute("REPLACE INTO " . TABLE_CONFIGURATION_LANGUAGE . " ( configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added)
             VALUES ('Produkte Pagination Version', 'PRODUCTS_PAGINATION_VERSION', '43', 'Dies ist die aktuelle Version des Plugins.<br />', now(), now())");
		
    $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function ) VALUES ( 'Enable Products Pagination?', 'PRODUCTS_PAGINATION_ENABLE', 'true', 'Use this setting to enable (default) or disable the plugin\'s overall operation.<br /><br /><b>Default: true</b>', $configuration_group_id, 5, now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),')");
	
	$db->Execute("REPLACE INTO " . TABLE_CONFIGURATION_LANGUAGE . " ( configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added)
             VALUES ('Paginierung der Produkte aktivieren?', 'PRODUCTS_PAGINATION_ENABLE', '43', 'Verwenden Sie diese Einstellung, um den Gesamtbetrieb des Plugins zu aktivieren (Standard) oder zu deaktivieren.<br /><br /><b>Standard: true</b>', now(), now())");
			 
    $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function ) VALUES ( 'Enable Products Pagination (Mobile)?', 'PRODUCTS_PAGINATION_ENABLE_MOBILE', 'false', 'Use this setting to enable or disable (default) the pagination display on <em>mobile</em> devices &mdash; <em>assuming</em> that your template provides support for mobile devices (like the <code>responsive_classic</code> template that is built into Zen Cart 1.5.5a!<br /><br /><b>Default: false</b>', $configuration_group_id, 6, now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),')");
    
	$db->Execute("REPLACE INTO " . TABLE_CONFIGURATION_LANGUAGE . " ( configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added)
             VALUES ('Paginierung der Produkte aktivieren (Mobile)?', 'PRODUCTS_PAGINATION_ENABLE_MOBILE', '43', 'Verwenden Sie diese Einstellung, um die Anzeige der Paginierung auf <em>Mobilgeräten</em> zu aktivieren oder zu deaktivieren (Standard) &mdash; <em>vorausgesetzt</em>, dass Ihr Template Unterstützung für Mobilgeräte bietet (wie das <code>responsive_classic</code>-Template, das in Zen Cart 1.5.6 eingebaut ist!<br /><br /><b>Standard: false</b>', now(), now())");
		
    $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function ) VALUES ( 'Products Pagination &mdash; Maximum Links', 'PRODUCTS_PAGINATION_MAX', '10', 'This is the maximum number of product links to be displayed before pagination begins.  This value should be greater than the number of <em>Intermediate Links</em>.<br /><br /><b>Default: 10</b><br />', $configuration_group_id, 10, now(), NULL, NULL)");
  
	$db->Execute("REPLACE INTO " . TABLE_CONFIGURATION_LANGUAGE . " ( configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added)
             VALUES ('Produkte Paginierung &mdash; Maximale Links', 'PRODUCTS_PAGINATION_MAX', '43', 'Dies ist die maximale Anzahl von Produktlinks, die angezeigt werden, bevor die Paginierung beginnt.  Dieser Wert sollte größer sein als die Anzahl der <em>Zwischengliederungen</em>.<br /><br /><b>Standard: 10</b><br />', now(), now())");

    $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function ) VALUES ( 'Products Pagination &mdash; Intermediate Links', 'PRODUCTS_PAGINATION_MID_RANGE', '7', 'This is the number of intermediate links to be shown when the number of products in the current category is greater than the <em>Maximum Links</em>; the first and last product link is always shown.  The value should be an odd number for link symmetry.<br /><br /><b>Default: 7</b><br />', $configuration_group_id, 20, now(), NULL, NULL)");
	
		$db->Execute("REPLACE INTO " . TABLE_CONFIGURATION_LANGUAGE . " ( configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added)
             VALUES ('Produkte Paginierung &mdash; Zwischengliederungen', 'PRODUCTS_PAGINATION_MID_RANGE', '43', 'Dies ist die Anzahl der Zwischenlinks, die angezeigt werden sollen, wenn die Anzahl der Produkte in der aktuellen Kategorie größer ist als die maximale Anzahl der Links; der erste und letzte Produktlink wird immer angezeigt.  Der Wert sollte aus Gründen der Link-Symmetrie eine ungerade Zahl sein.<br /><br /><b>Standard: 7</b><br />', now(), now())");

    $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function ) VALUES ( 'Enable product listing link?', 'PRODUCTS_PAGINATION_LISTING_LINK', 'true', 'If enabled, a &quot;View Product listing&quot; link is shown on the same line as &quot;Viewing product x of y&quot;.<br /><br /><b>Default: true</b>', $configuration_group_id, 30, now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),')");

	$db->Execute("REPLACE INTO " . TABLE_CONFIGURATION_LANGUAGE . " ( configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added)
             VALUES ('Link zur Produktliste aktivieren?', 'PRODUCTS_PAGINATION_LISTING_LINK', '43', 'Wenn aktiviert, wird ein Link &quot;Produktliste anzeigen&quot; in der gleichen Zeile wie &quot;Produkt x von y anzeigen&quot; angezeigt.<br /><br /><b>Standard: true</b>', now(), now())");

    $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function ) VALUES ( 'Enable links on other pages?', 'PRODUCTS_PAGINATION_OTHER', 'true', 'If enabled, the &quot;Other pages to link&quot; will have the pagination links applied.<br /><br /><b>Default: true</b>', $configuration_group_id, 40, now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),')");

	$db->Execute("REPLACE INTO " . TABLE_CONFIGURATION_LANGUAGE . " ( configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added)
             VALUES ('Links auf andere Seiten freigeben?', 'PRODUCTS_PAGINATION_OTHER', '43', 'Wenn aktiviert, werden die &quot;Andere zu verlinkende Seiten&quot; mit den Paginierungslinks versehen.<br /><br /><b>Standard: true</b>', now(), now())");

    $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function ) VALUES ( 'Other pages to link', 'PRODUCTS_PAGINATION_OTHER_MAIN_PAGES', 'account_history,advanced_search_result,featured_products,index,product_reviews,products_all,products_new,reviews,specials', 'This comma-separated list identifies the &quot;other&quot; pages to which the pagination display should be applied.', $configuration_group_id, 50, now(), NULL, NULL)");

	$db->Execute("REPLACE INTO " . TABLE_CONFIGURATION_LANGUAGE . " ( configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added)
             VALUES ('Andere zu verlinkende Seiten', 'PRODUCTS_PAGINATION_OTHER_MAIN_PAGES', '43', 'Diese kommagetrennte Liste identifiziert die &quot;anderen&quot; Seiten, auf die die Paginierungsanzeige angewendet werden soll.', now(), now())");

    $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function ) VALUES ( 'Include page-select drop-down?', 'PRODUCTS_PAGINATION_DISPLAY_PAGEDROP', 'false', 'If enabled, a drop-down menu is displayed on the <strong>other</strong> pages to allow the customer to go to a specific page number.<br /><b>Default: false</b>', $configuration_group_id, 60, now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),')");
  
	$db->Execute("REPLACE INTO " . TABLE_CONFIGURATION_LANGUAGE . " ( configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added)
             VALUES ('Seitenauswahl-Dropdown einbeziehen?', 'PRODUCTS_PAGINATION_DISPLAY_PAGEDROP', '43', 'Wenn aktiviert, wird auf den <strong>anderen</strong> Seiten ein Dropdown-Menü angezeigt, damit der Kunde zu einer bestimmten Seitennummer wechseln kann.<br /><b>Standard: false</b>', now(), now())");

    $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function ) VALUES ( 'Include item-count drop-down?', 'PRODUCTS_PAGINATION_PRODUCT_COUNT', 'false', 'If enabled, a drop-down menu is displayed to allow the customer to choose the number of items displayed for the <strong>other</strong> pages.  The count choices are contained in &quot;Item Counts&quot; (see below).<br /><b>Default: false</b>', $configuration_group_id, 70, now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),')");
  
	$db->Execute("REPLACE INTO " . TABLE_CONFIGURATION_LANGUAGE . " ( configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added)
             VALUES ('Dropdown-Liste für Artikelanzahl einbeziehen?', 'PRODUCTS_PAGINATION_PRODUCT_COUNT', '43', 'Wenn aktiviert, wird ein Dropdown-Menü angezeigt, mit dem der Kunde die Anzahl der angezeigten Artikel für die <strong>anderen</strong> Seiten auswählen kann.  Die Auswahlmöglichkeiten für die Anzahl sind in &quot; Artikelanzahl&quot; (siehe unten) enthalten.<br /><b>Standard: false</b>', now(), now())");

    $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function ) VALUES ( 'Item counts', 'PRODUCTS_PAGINATION_COUNT_VALUES', '10,25,50,100,*', 'This comma-separated list identifies the item-count choices that will be displayed in a drop-down menu to the customer.  The value \'*\' corresponds to <em>All</em> the items being displayed.', $configuration_group_id, 80, now(), NULL, NULL)");
    
	$db->Execute("REPLACE INTO " . TABLE_CONFIGURATION_LANGUAGE . " ( configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added)
             VALUES ('Artikelanzahl', 'PRODUCTS_PAGINATION_COUNT_VALUES', '43', 'Diese kommagetrennte Liste identifiziert die Auswahlmöglichkeiten für die Artikelanzahl, die dem Kunden in einem Dropdown-Menü angezeigt werden.  Der Wert \'*\' entspricht <em>Alle</em> der angezeigten Artikel.', now(), now())");

    define('PRODUCTS_PAGINATION_VERSION', $pp_current_version);
// -----
// If a previous, i.e. pre-v2.0.0, installation is found, add the two new configuration items and update the configuration values' sort-orders so
// that the updated configuration displays in the right order.
//
} elseif (!defined('PRODUCTS_PAGINATION_VERSION')) {
    $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function ) VALUES ( 'Products Pagination Version', 'PRODUCTS_PAGINATION_VERSION', '$pp_current_version', 'This is the current version of the plugin.<br />', $configuration_group_id, 1, now(), NULL, 'trim(')");
    
	$db->Execute("REPLACE INTO " . TABLE_CONFIGURATION_LANGUAGE . " ( configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added)
             VALUES ('Produkte Pagination Version', 'PRODUCTS_PAGINATION_VERSION', '43', 'Dies ist die aktuelle Version des Plugins.<br />', now(), now())");

    $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function ) VALUES ( 'Enable Products Pagination?', 'PRODUCTS_PAGINATION_ENABLE', 'true', 'Use this setting to enable (default) or disable the plugin\'s overall operation.<br /><br /><b>Default: true</b>', $configuration_group_id, 5, now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),')");
      
	$db->Execute("REPLACE INTO " . TABLE_CONFIGURATION_LANGUAGE . " ( configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added)
             VALUES ('Paginierung der Produkte aktivieren?', 'PRODUCTS_PAGINATION_ENABLE', '43', 'Verwenden Sie diese Einstellung, um den Gesamtbetrieb des Plugins zu aktivieren (Standard) oder zu deaktivieren.<br /><br /><b>Standard: true</b>', now(), now())");

    $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function ) VALUES ( 'Enable Products Pagination (Mobile)?', 'PRODUCTS_PAGINATION_ENABLE_MOBILE', 'false', 'Use this setting to enable or disable (default) the pagination display on <em>mobile</em> devices &mdash; <em>assuming</em> that your template provides support for mobile devices (like the <code>responsive_classic</code> template that is built into Zen Cart 1.5.5a)!<br /><br /><b>Default: false</b>', $configuration_group_id, 6, now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),')");
    
	$db->Execute("REPLACE INTO " . TABLE_CONFIGURATION_LANGUAGE . " ( configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added)
             VALUES ('Paginierung der Produkte aktivieren (Mobile)?', 'PRODUCTS_PAGINATION_ENABLE_MOBILE', '43', 'Verwenden Sie diese Einstellung, um die Anzeige der Paginierung auf <em>Mobilgeräten</em> zu aktivieren oder zu deaktivieren (Standard) &mdash; <em>vorausgesetzt</em>, dass Ihr Template Unterstützung für Mobilgeräte bietet (wie das <code>responsive_classic</code>-Template, das in Zen Cart 1.5.6 eingebaut ist)!<br /><br /><b>Standard: false</b>', now(), now())");

    $keys_resort_array = array(
        'PRODUCTS_PAGINATION_MAX' => 10,
        'PRODUCTS_PAGINATION_MID_RANGE' => 20,
        'PRODUCTS_PAGINATION_LISTING_LINK' => 30,
        'PRODUCTS_PAGINATION_OTHER' => 40,
        'PRODUCTS_PAGINATION_OTHER_MAIN_PAGES' => 50,
        'PRODUCTS_PAGINATION_DISPLAY_PAGEDROP' => 60,
        'PRODUCTS_PAGINATION_PRODUCT_COUNT' => 70,
        'PRODUCTS_PAGINATION_COUNT_VALUES' => 80
    );
    foreach ($keys_resort_array as $key => $sort_order) {
        $db->Execute("UPDATE " . TABLE_CONFIGURATION . " SET sort_order = $sort_order WHERE configuration_key = '$key' LIMIT 1");
    }
    define('PRODUCTS_PAGINATION_VERSION', $pp_current_version);
}

// -----
// If the version noted in the database isn't the plugin's current version, update the value.
//
if (PRODUCTS_PAGINATION_VERSION != $pp_current_version) {
    $db->Execute("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '$pp_current_version' WHERE configuration_key = 'PRODUCTS_PAGINATION_VERSION' LIMIT 1");
}

//----
// Register the "Product Pagination" configuration.
//
if (!zen_page_key_exists('configProdPagination')) {
    zen_register_admin_page('configProdPagination', 'BOX_CONFIGURATION_PRODUCT_PAGINATION', 'FILENAME_CONFIGURATION', "gID=$configuration_group_id", 'configuration', 'Y', $configuration_group_id);
}
