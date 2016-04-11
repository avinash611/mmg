<?php
$installer = $this;
$installer->startSetup();
$this->run("

CREATE TABLE `{$this->getTable('mapmygenomie_career/jobmanagement')}`(
	job_id int not null auto_increment,
	applicant_name varchar(225),        
	applicant_phone varchar(50),
	applicant_email varchar(225),
	filename varchar(512),
        applied_post_name varchar(225),
	primary key(job_id)) ENGINE=Innodb DEFAULT CHARSET=utf8;
");

$installer->run($sql);
$installer->endSetup();


