<?php

class Mapmygenomie_Career_Block_Adminhtml_Category extends Mage_Adminhtml_Block_Widget_Grid_Container {

    /**
     * Initialize Category Manager page
     *
     * @return void
     */
    public function __construct() {
        //$this->_controller = 'adminhtml_wildcraft_career_category';
        $this->_controller = 'adminhtml_category';
        $this->_blockGroup = 'mapmygenomie_career';
        $this->_headerText = Mage::helper('mapmygenomie_career')->__('Manage Categories');
        $this->_addButtonLabel = Mage::helper('mapmygenomie_career')->__('Add New Category');
        parent::__construct();
    }

}
