<?php

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$tablePageTree = $this->getTable('homepageblocks');
$installer->run("
ALTER TABLE `{$tablePageTree}` ADD COLUMN `homepageblock1_link_text` VARCHAR(255) DEFAULT 'Shop here' AFTER `homepageblock1_link`;
ALTER TABLE `{$tablePageTree}` ADD COLUMN `homepageblock2_link_text` VARCHAR(255) DEFAULT 'Shop here' AFTER `homepageblock2_link`;
ALTER TABLE `{$tablePageTree}` ADD COLUMN `homepageblock3_link_text` VARCHAR(255) DEFAULT 'Shop here' AFTER `homepageblock3_link`;
ALTER TABLE `{$tablePageTree}` ADD COLUMN `homepageblock4_link_text` VARCHAR(255) DEFAULT 'Shop here' AFTER `homepageblock4_link`;
ALTER TABLE `{$tablePageTree}` ADD COLUMN `homepageblock5_link_text` VARCHAR(255) DEFAULT 'Shop here' AFTER `homepageblock5_link`;
ALTER TABLE `{$tablePageTree}` ADD COLUMN `homepageblock6_link_text` VARCHAR(255) DEFAULT 'Shop here' AFTER `homepageblock6_link`;
ALTER TABLE `{$tablePageTree}` ADD COLUMN `homepageblock7_link_text` VARCHAR(255) DEFAULT 'Shop here' AFTER `homepageblock7_link`;
ALTER TABLE `{$tablePageTree}` ADD COLUMN `homepageblock8_link_text` VARCHAR(255) DEFAULT 'Shop here' AFTER `homepageblock8_link`;
ALTER TABLE `{$tablePageTree}` ADD COLUMN `homepageblock9_link_text` VARCHAR(255) DEFAULT 'Shop here' AFTER `homepageblock9_link`;
ALTER TABLE `{$tablePageTree}` ADD COLUMN `store_code` TEXT;
");

$installer->endSetup();