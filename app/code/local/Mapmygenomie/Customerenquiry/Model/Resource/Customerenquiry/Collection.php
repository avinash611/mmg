<?php
class Mapmygenomie_Customerenquiry_Model_Resource_Customerenquiry_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
 {
     public function _construct()
     {
         parent::_construct();
         $this->_init('mapmygenomie_customerenquiry/customerenquiry');
     }
	 /**
     * Instantiate select object
     *
     */
    protected function _initSelect() {
        $this->getSelect()->from(array('main_table' => $this->getResource()->getMainTable()));
        return $this;
    } 
}