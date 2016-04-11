<?php

class Mapmygenomie_Owlcarousal_Model_Resource_Owlcarousalinfo_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {

    /**
     * Intialize collection
     *
     * @return void
     */
    protected function _construct() {
        $this->_init('mapmygenomie_owlcarousal/owlcarousalinfo');
    }

    /**
     * Instantiate select object
     *
     */
    protected function _initSelect() {
        $this->getSelect()->from(array('main_table' => $this->getResource()->getMainTable()));
        return $this;
    }

    public function toOptionHash() {
        return parent::_toOptionHash('owlcarousal_id', 'carousal_headtitle');
    }

    /**
     * function to add the collection which are enabled for now
     *    
     * */
    public function addStatusFilter() {
        $this->addFieldToFilter('carousal_status', Mapmygenomie_Owlcarousal_Model_Owlcarousalinfo::STATUS_ENABLED);
        return $this;
    }

   

}