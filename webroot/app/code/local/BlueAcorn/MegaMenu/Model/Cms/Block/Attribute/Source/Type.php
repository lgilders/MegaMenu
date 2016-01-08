<?php
/**
 * @package     BlueAcorn\MegaMenu
 * @version
 * @author      Blue Acorn, Inc. <code@blueacorn.com>
 * @copyright   Copyright © 2015 Blue Acorn, Inc.
 */

class BlueAcorn_MegaMenu_Model_Cms_Block_Attribute_Source_Type extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    public function getAllOptions()
    {
        $cmsBlocks = Mage::getModel('cms/block')->getCollection();

        $options = array(
            array(
                'value' => 0,
                'label' => Mage::helper('catalog')->__('No Block Selected')
            )
        );

        foreach ($cmsBlocks as $cmsBlock)
        {
            if($cmsBlock->getIsInMegaMenu())
            {
                $option_array[] = array('value' => $cmsBlock->getId(), 'label' => Mage::helper('blueacorn_megamenu')->__($cmsBlock->getTitle()));
            }
        }

        $options = array_merge($options, $option_array);

        return $options;
    }

}