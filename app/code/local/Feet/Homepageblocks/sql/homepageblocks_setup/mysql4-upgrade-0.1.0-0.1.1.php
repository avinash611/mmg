<?php

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$tablePageTree = $this->getTable('homepageblocks');
$installer->run("
ALTER TABLE `{$tablePageTree}` ADD COLUMN `category_id` varchar(255) NOT NULL default '';
");

$installer->endSetup();