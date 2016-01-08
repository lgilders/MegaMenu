<?php
/**
 * @package     BlueAcorn\MegaMenu
 * @version
 * @author      Blue Acorn, Inc. <code@blueacorn.com>
 * @copyright   Copyright © 2015 Blue Acorn, Inc.
 */

class BlueAcorn_MegaMenu_Helper_Data extends Mage_Core_Helper_Abstract {

    /**
     * Returns categories with include_in_mega_menu set to yes in Admin
     *
     * @return Varien_Data_Tree_Node_Collection
     */
    public function getCategories()
    {
        $root = Mage::app()->getStore()->getRootCategoryId();
        $tree = Mage::getResourceModel('catalog/category_tree');
        /* @var $tree Mage_Catalog_Model_Resource_Category_Tree */
        $nodes = $tree->loadNode($root);

        $categories = Mage::getModel('catalog/category')->getCollection()
            ->addAttributeToSelect(array('name','url_key','is_active', 'mega_menu_block','mega_menu_sort_order'))
            ->addAttributeToSort('mega_menu_sort_order', 'ASC')
            ->addAttributeToFilter('include_in_mega_menu', 1);

        foreach ($categories as $category){
            $categoryData = $this->getCategoryData($category);
            $categoryNode = new Varien_Data_Tree_Node($categoryData, 'id', $tree, $nodes);
            $categoryChildren = $this->getSubcategories($category);

            foreach ($categoryChildren as $child){
                $childData = $this->getCategoryData($child);
                $childCategoryNode = new Varien_Data_Tree_Node($childData, 'id', $tree, $nodes);
                $categoryNode->addChild($childCategoryNode);
            }
            $nodes->addChild($categoryNode);
        }
        return $nodes->getChildren();
    }

    /**
     * Returns a collection of the subcategories for the current category
     *
     * @param $parent
     * @return collection
     */
    public function getSubcategories($parent){
        $currentId = $parent->getId();
        $childCategories = Mage::getModel('catalog/category')->getCollection()
            ->addAttributeToSelect(array('name','url_key','is_active'))
            ->addAttributeToFilter('parent_id', $currentId);
        return $childCategories;
    }

    /**
     * @param $category
     * @return array
     */
    public function getCategoryData($category){
        $categoryData = array(
            'name' => $category->getName(),
            'id' => $category->getId(),
            'url' => Mage::helper('catalog/category')->getCategoryUrl($category),
            'is_active' => $category->getIsActive(),
            'mega_menu_block' => $category->getMegaMenuBlock()
        );

        return $categoryData;
    }
}