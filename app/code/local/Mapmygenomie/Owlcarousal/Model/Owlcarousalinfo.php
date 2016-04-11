<?php

class Mapmygenomie_Owlcarousal_Model_Owlcarousalinfo extends Mage_Core_Model_Abstract {

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;
    const GENOMEPATRI_TEST = 1;
    const CUSTOMER_REVIEWS = 2;
    const MEDIA_REVIEWS = 3;

    public function _construct() {
        $this->_init('mapmygenomie_owlcarousal/owlcarousalinfo');
    }

    static public function getStatusOptionArray() {
        return array(
            self::STATUS_ENABLED => Mage::helper('mapmygenomie_owlcarousal')->__('Enabled'),
            self::STATUS_DISABLED => Mage::helper('mapmygenomie_owlcarousal')->__('Disabled')
        );
    }

    static public function getCarousalCategoryArray() {
        return array(
            self::GENOMEPATRI_TEST => Mage::helper('mapmygenomie_owlcarousal')->__('Genomepatri Test'),
            self::CUSTOMER_REVIEWS => Mage::helper('mapmygenomie_owlcarousal')->__('Customer Reviews'),
            self::MEDIA_REVIEWS => Mage::helper('mapmygenomie_owlcarousal')->__('Media Reviews')
        );
    }

}
