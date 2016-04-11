<?php

$installer = $this;

$installer->startSetup();

$installer->run("



ALTER TABLE {$this->getTable('home_pagebanner')} ADD `website_id` int(10) NOT NULL default '0' AFTER `status`;


    ");

$installer->endSetup();