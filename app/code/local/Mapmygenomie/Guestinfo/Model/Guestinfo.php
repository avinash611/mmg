<?php

/**
 * @category    22Feet
 * @package     GuestInfo
 * @author      Binu  <binuconcept@gmail.com,9986442330>
 */
class Mapmygenomie_Guestinfo_Model_Guestinfo extends Mage_Core_Model_Abstract {

    public function _construct() {
        parent::_construct();
        $this->_init('mapmygenomie_guestinfo/guestinfo');
    }

}
