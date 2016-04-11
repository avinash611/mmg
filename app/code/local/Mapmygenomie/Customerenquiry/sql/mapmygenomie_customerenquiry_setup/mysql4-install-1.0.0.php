<?php

$installer = $this;
$installer->startSetup();

$tableCustomerEnquiry = $installer->getTable('mapmygenomie_customerenquiry/customerenquiry');
$tableCustomer = $installer->getTable('customer/entity');
$adminUser =$installer->getTable('admin/user');

try {
    $installer->run("
		DROP TABLE IF EXISTS {$tableCustomerEnquiry};
		CREATE TABLE IF NOT EXISTS `{$tableCustomerEnquiry}`(
		  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
		  `customer_id` INT,
		  `customer_comment` text DEFAULT NULL,
		  `customer_report` varchar(500) NOT NULL default '',
		  `doctor_id` INT,
		  `doctor_comment` text DEFAULT NULL ,
		  `doctor_report` varchar(500) NOT NULL default '',
		  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
		  `updated_at` TIMESTAMP NULL DEFAULT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;
	");

	$installer->getConnection()->addConstraint(
		'FK_CUSTOMER_ID', $tableCustomerEnquiry, 'customer_id', $tableCustomer, 'entity_id'
	);
	$installer->getConnection()->addConstraint(
		'FK_ADMIN_ID', $tableCustomerEnquiry, 'doctor_id', $adminUser, 'user_id'
	);
} catch (Exception $e) {
    
}

$installer->endSetup();