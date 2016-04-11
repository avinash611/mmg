<?php

/**
 * @category    22Feet
 * @package     GuestInfo
 * @author      Binu  <binuconcept@gmail.com,9986442330>
 */
class Mapmygenomie_Guestinfo_Model_Mysql4_Guestinfo_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {

    public function _construct() {
        //parent::__construct();
        $this->_init('mapmygenomie_guestinfo/guestinfo');
    }

}
