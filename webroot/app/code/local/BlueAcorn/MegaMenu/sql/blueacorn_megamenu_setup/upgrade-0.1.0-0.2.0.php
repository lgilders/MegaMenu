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
 * Adds custom category attribute to determine the category sort order in the mega menu
 */

try {
    $setup->addAttribute(Mage_Catalog_Model_Category::ENTITY, 'mega_menu_sort_order', array(
        'type'              => 'int',
        'input'             => 'select',
        'label'             => 'Mega Menu Display Order',
        'visible'           =>  true,
        'required'          =>  false,
        'group'             => 'Mega Menu Display',
        'sort_order'        => '2',
        'visible_on_front'  => true,
        'backend'           => '',
        'option'            => array (
            'values'            => array ( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10)
        ),
        'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    ));

} catch (Exception $e) {
    Mage::logException($e);
}

$installer->endSetup();