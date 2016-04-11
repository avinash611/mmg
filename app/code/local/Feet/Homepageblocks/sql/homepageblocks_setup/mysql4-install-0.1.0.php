<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('homepageblocks')};
CREATE TABLE {$this->getTable('homepageblocks')} (
  `id` int(11) unsigned NOT NULL auto_increment,
  `homepageblock1_image` varchar(255) NOT NULL default '',
  `homepageblock1_title` varchar(255) NOT NULL default '',
  `homepageblock1_link` varchar(255) NOT NULL default '',
  `homepageblock2_image` varchar(255) NOT NULL default '',
  `homepageblock2_title` varchar(255) NOT NULL default '',
  `homepageblock2_link` varchar(255) NOT NULL default '',
  `homepageblock3_image` varchar(255) NOT NULL default '',
  `homepageblock3_title` varchar(255) NOT NULL default '',
  `homepageblock3_link` varchar(255) NOT NULL default '',
  `homepageblock4_image` varchar(255) NOT NULL default '',
  `homepageblock4_title` varchar(255) NOT NULL default '',
  `homepageblock4_link` varchar(255) NOT NULL default '',
  `homepageblock5_image` varchar(255) NOT NULL default '',
  `homepageblock5_title` varchar(255) NOT NULL default '',
  `homepageblock5_link` varchar(255) NOT NULL default '',
  `homepageblock6_image` varchar(255) NOT NULL default '',
  `homepageblock6_title` varchar(255) NOT NULL default '',
  `homepageblock6_link` varchar(255) NOT NULL default '',
  `homepageblock7_image` varchar(255) NOT NULL default '',
  `homepageblock7_title` varchar(255) NOT NULL default '',
  `homepageblock7_link` varchar(255) NOT NULL default '',
  `homepageblock8_image` varchar(255) NOT NULL default '',
  `homepageblock8_title` varchar(255) NOT NULL default '',
  `homepageblock8_link` varchar(255) NOT NULL default '',
  `homepageblock9_image` varchar(255) NOT NULL default '',
  `homepageblock9_title` varchar(255) NOT NULL default '',
  `homepageblock9_link` varchar(255) NOT NULL default '',
  `status` smallint(6) NOT NULL default '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup();
