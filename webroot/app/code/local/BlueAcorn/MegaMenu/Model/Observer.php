<?php
/**
 * @package     BlueAcorn\MegaMen
 * @version
 * @author      Blue Acorn, Inc. <code@blueacorn.com>
 * @copyright   Copyright © 2015 Blue Acorn, Inc.
 */

class BlueAcorn_MegaMenu_Model_Observer extends BlueAcorn_EasyAttributes_Model_Observer {
    /**
     * Adds catalog categories to top menu
     *
     * @param Varien_Event_Observer $observer
     */
    public function addCatalogToTopmenuItems(Varien_Event_Observer $observer)
    {
        $block = $observer->getEvent()->getBlock();
        $block->addCacheTag(Mage_Catalog_Model_Category::CACHE_TAG);
        $this->_addCategoriesToMenu(
            Mage::helper('blueacorn_megamenu')->getCategories(), $observer->getMenu(), $block, true
        );
    }
}