<?php

class Mapmygenomie_Compare_Model_Resource_Hashcode_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {

    public function _construct() {
        parent::_construct();
        $this->_init('mapmygenomie_compare/hashcode');
    }

}
