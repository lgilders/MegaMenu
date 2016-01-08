<?php

/**
 * @package     BlueAcorn\MegaMenu
 * @version
 * @author      Blue Acorn, Inc. <code@blueacorn.com>
 * @copyright   Copyright © 2015 Blue Acorn, Inc.
 */

$installer = $this;

$installer->startSetup();

/**
 * Adds custom attribute to determine if a cms block is used in the mega menu
 */

$table = $installer->getConnection()
    ->addColumn($installer->getTable('cms/block'),
    'is_in_mega_menu',
    array(
    'type'      => Varien_Db_Ddl_Table::TYPE_SMALLINT,
    'length'    => '1',
    'nullable'  => false,
    'default'   => '0',
    'comment'   => 'Is this cms block used in the mega menu?',
));

$installer->endSetup();