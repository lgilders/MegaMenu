<?php

/**
 * @package     BlueAcorn\MegaMenu
 * @version
 * @author      Blue Acorn, Inc. <code@blueacorn.com>
 * @copyright   Copyright © 2015 Blue Acorn, Inc.
 */

$installer = $this;

$installer->startSetup();

$setup = new Mage_Eav_Model_Entity_Setup('core_setup');

/**
 * Adds custom attribute to populate dropdown with available cms blocks for mega menu
 */

try {
    $setup->addAttribute(Mage_Catalog_Model_Category::ENTITY, 'mega_menu_block', array(
        'type'          => 'text',
        'input'         => 'select',
        'source'        => 'blueacorn_megamenu/cms_block_attribute_source_type',
        'label'         => 'Select a CMS Block',
        'group'         => 'Mega Menu Display',
        'sort_order'    => '3',
        'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
        'visible'       => true,
        'required'      => false,
        'user_defined'  => true,
        'searchable'    => false,
        'filterable'    => false,
        'comparable'    => false,
        'visible_on_front' => false,
        'visible_in_advanced_search' => false,
        'used_in_product_listing' => true,
        'unique' => false
    ));

} catch (Exception $e) {
    Mage::logException($e);
}

$installer->endSetup();