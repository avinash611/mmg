<?php

$installer = $this;
$installer->startSetup();
$installer->run("
    -- DROP TABLE IF EXISTS {$this->getTable('mapmygenomie_videogallery/videogallery')};
	CREATE TABLE {$this->getTable('mapmygenomie_videogallery/videogallery')} (
         `videogallery_id` int(11) unsigned NOT NULL auto_increment,
         `video_name` varchar(255) NOT NULL default '',
         `video_description` text,
         `videogallery_url` varchar(500) NOT NULL default '',  
         `videoembedded_id` varchar(255) NOT NULL default '',
         `isexternal_video` tinyint(3) NOT NULL default '1',
         `video_image` varchar(255) NOT NULL default '',
         `video_status` tinyint(3) NOT NULL default '1',
         `video_priority` tinyint(3) NOT NULL default '1',
	 PRIMARY KEY (`videogallery_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;   
	");
$installer->endSetup();


