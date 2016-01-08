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
 * Adds custom category attribute to include a category as a top-level nav item in the mega menu
 */

try {
    $setup->addAttribute(Mage_Catalog_Model_Category::ENTITY, 'include_in_mega_menu', array(
        'type'          => 'int',
        'input'         => 'select',
        'source'        => 'eav/entity_attribute_source_boolean',
        'label'         => 'Include in Mega Menu',
        'required'      =>  1,
        'group'         => 'Mega Menu Display',
        'sort_order'    => '1',
        'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    ));

} catch (Exception $e) {
    Mage::logException($e);
}

$installer->endSetup();