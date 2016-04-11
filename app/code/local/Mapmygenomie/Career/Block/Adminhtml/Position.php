<?php

class Mapmygenomie_Career_Block_Adminhtml_Position extends Mage_Adminhtml_Block_Widget_Grid_Container {

    /**
     * Initialize Position Manager page
     *
     * @return void
     */
    public function __construct() {
        $this->_controller = 'adminhtml_position'; //this one it is the module name         $this->_controller = 'adminhtml_cposition';//this one it is the module name 

        $this->_blockGroup = 'mapmygenomie_career';
        $this->_headerText = Mage::helper('mapmygenomie_career')->__('Manage Positions');
        $this->_addButtonLabel = Mage::helper('mapmygenomie_career')->__('Add New Position');
        parent::__construct();
    }

}
