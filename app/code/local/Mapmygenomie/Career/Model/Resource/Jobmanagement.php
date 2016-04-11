<?php
class Mapmygenomie_Career_Model_Resource_Jobmanagement extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init("mapmygenomie_career/jobmanagement", "job_id");
    }
}