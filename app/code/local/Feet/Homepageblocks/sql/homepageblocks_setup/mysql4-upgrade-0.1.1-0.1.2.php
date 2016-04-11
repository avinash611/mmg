<?php

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$tablePageTree = $this->getTable('homepageblocks');
$installer->run("
ALTER TABLE `{$tablePageTree}` ADD COLUMN `banner_id` TINYINT(2) UNSIGNED NOT NULL DEFAULT '1';
");

$installer->endSetup();