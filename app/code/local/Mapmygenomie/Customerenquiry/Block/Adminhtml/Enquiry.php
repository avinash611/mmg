<?php

class Mapmygenomie_Customerenquiry_Block_Adminhtml_Enquiry extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_controller = 'adminhtml_customerenquiry';
        $this->_blockGroup = 'mapmygenomie_customerenquiry';
        $this->_headerText = $this->getHelperFile()->__('23andme Customer Reports ');
        parent::__construct();
        $this->_removeButton('add');
    }

    protected function getHelperFile() {
        return Mage::helper('mapmygenomie_customerenquiry');
    }

}
