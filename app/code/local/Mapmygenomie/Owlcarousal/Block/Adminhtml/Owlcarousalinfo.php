<?php

class Mapmygenomie_Owlcarousal_Block_Adminhtml_Owlcarousalinfo extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_controller = 'adminhtml_owlcarousalinfo';
        $this->_blockGroup = 'mapmygenomie_owlcarousal';
        $this->_headerText = Mage::helper('mapmygenomie_owlcarousal')->__('Carousal Manager');
        $this->_addButtonLabel = Mage::helper('mapmygenomie_owlcarousal')->__('Add Carousal');
        parent::__construct();
    }

}
