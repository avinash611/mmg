<?php

$installer = $this;

$installer->startSetup();

$tableOwlCarousalInfo = $installer->getTable('mapmygenomie_owlcarousal/owlcarousalinfo');

$installer->run("
CREATE TABLE IF NOT EXISTS `{$tableOwlCarousalInfo}` (
	`owlcarousal_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,	
	`category_id` INT NOT NULL,
	`carousal_headtitle` VARCHAR(255) NOT NULL,
	`carousal_image` varchar(255) NOT NULL DEFAULT '',
	`carousal_smalldesc` TEXT NOT NULL DEFAULT '',	
	`carousal_description` LONGTEXT NOT NULL,
    `carousal_priority` INT NOT NULL DEFAULT '1',		
	`carousal_status` INT NOT NULL DEFAULT '1',
	`created_at` datetime NOT NULL default '0000-00-00 00:00:00',
    `updated_at` TIMESTAMP NULL DEFAULT NULL	
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup();
?>
