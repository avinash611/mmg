<?php


class Mapmygenomie_Career_Model_Resource_Category extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Intialize resource model
     *
     * @return void
     */
    public function _construct()
    {

        $this->_init('mapmygenomie_career/category', 'category_id');
    }
    
}