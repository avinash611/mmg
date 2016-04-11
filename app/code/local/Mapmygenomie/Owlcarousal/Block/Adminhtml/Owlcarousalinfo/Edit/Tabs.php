<?php

class Mapmygenomie_Owlcarousal_Block_Adminhtml_Owlcarousalinfo_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId('mapmygenomie_owlcarousal_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper(mapmygenomie_owlcarousal)->__('Carousal Information'));
    }

    protected function _beforeToHtml() {
        $this->addTab('form_section', array(
            'label' => Mage::helper('mapmygenomie_owlcarousal')->__('Carousal Information'),
            'title' => Mage::helper('mapmygenomie_owlcarousal')->__('Carousal Information'),
            'content' => $this->getLayout()->createBlock('mapmygenomie_owlcarousal/adminhtml_owlcarousalinfo_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }

}
