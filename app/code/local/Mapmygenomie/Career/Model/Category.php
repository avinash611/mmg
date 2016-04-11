<?php

class Mapmygenomie_Career_Model_Category extends Mage_Core_Model_Abstract {

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    public function _construct() {
        $this->_init('mapmygenomie_career/category');
    }

    static public function getStatusOptionArray() {
        return array(
            self::STATUS_ENABLED => Mage::helper('mapmygenomie_career')->__('Enabled'),
            self::STATUS_DISABLED => Mage::helper('mapmygenomie_career')->__('Disabled')
        );
    }

}

