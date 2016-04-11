<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('home_pagebanner')};
CREATE TABLE {$this->getTable('home_pagebanner')} (
  `bookmark_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `target` tinyint(1) NOT NULL DEFAULT '1',
  `position` int(10) NOT NULL DEFAULT '0',
  `homepagebanner_text` varchar(255) NOT NULL DEFAULT '',
  `homepagebanner_text1` varchar(255) NOT NULL DEFAULT '',
  `homepagebanner_text2` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bookmark_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



");

$installer->endSetup();