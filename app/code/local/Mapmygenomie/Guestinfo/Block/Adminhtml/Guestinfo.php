<?php

/**
 * @category    22Feet
 * @package     GuestInfo
 * @author      Binu  <binuconcept@gmail.com,9986442330>
 */
class Mapmygenomie_Guestinfo_Block_Adminhtml_Guestinfo extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {

        $this->_controller = 'adminhtml_guestinfo';

        $this->_headerText = Mage::helper('mapmygenomie_guestinfo')->__('Guests');

        $this->_blockGroup = 'mapmygenomie_guestinfo';

        parent::__construct();
        $this->_removeButton('add');
    }

}
