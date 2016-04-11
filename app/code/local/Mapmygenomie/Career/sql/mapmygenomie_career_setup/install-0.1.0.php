<?php

$installer = $this;

$installer->startSetup();

$tableCareerCategory = $installer->getTable('mapmygenomie_career/category');
$tableCareerPosition = $installer->getTable('mapmygenomie_career/position');

$installer->run("
CREATE TABLE IF NOT EXISTS `{$tableCareerCategory}` (
	`category_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`category_name` VARCHAR(255) NOT NULL,
	`category_status` INT NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->run("
CREATE TABLE IF NOT EXISTS `{$tableCareerPosition}` (
	`position_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,	
	`category_id` INT NOT NULL,
	`position_name` VARCHAR(255) NOT NULL,
	`position_count` INT NOT NULL,
	`position_location` varchar(150),
	`position_status` INT NOT NULL DEFAULT '1',
	`position_description` LONGTEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->getConnection()->addConstraint(
    'FK_CAREER_CATEGORY_ID', $tableCareerPosition, 'category_id', $tableCareerCategory, 'category_id'
);

$installer->endSetup();
?>
