<?php

class Mapmygenomie_Owlcarousal_Model_Resource_Owlcarousalinfo extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Intialize resource model
     *
     * @return void
     */
    public function _construct()
    {

        $this->_init('mapmygenomie_owlcarousal/owlcarousalinfo', 'owlcarousal_id');
    }
    
}