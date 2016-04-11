<?php

class Mapmygenomie_Owlcarousal_Block_Adminhtml_Owlcarousalinfo_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'mapmygenomie_owlcarousal';
        $this->_controller = 'adminhtml_owlcarousalinfo';

        $this->_updateButton('save', 'label', Mage::helper('mapmygenomie_owlcarousal')->__('Save'));
        $this->_updateButton('delete', 'label', Mage::helper('mapmygenomie_owlcarousal')->__('Delete'));
    }

    public function getHeaderText() {
        if (Mage::registry('mapmygenomie_owlcarousal_data') && Mage::registry('mapmygenomie_owlcarousal_data')->getId()) {
            return Mage::helper(mapmygenomie_owlcarousal)->__("Edit Carousal '%s'", $this->htmlEscape(Mage::registry('mapmygenomie_owlcarousal_data')->getCarousalHeadtitle()));
        } else {
            return Mage::helper('mapmygenomie_owlcarousal')->__('Add Carousal');
        }
    }

}
