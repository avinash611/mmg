<?php

class Mapmygenomie_Customerenquiry_Block_Adminhtml_Customerenquiry_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId('customerenquiry_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle('Customer Report');
    }

    protected function _beforeToHtml() {
        $this->addTab('form_section', array(
            'label' => 'Customer Information',
            'title' => 'Customer Information',
            'content' => $this->getLayout()
                    ->createBlock('mapmygenomie_customerenquiry/adminhtml_customerenquiry_edit_tab_form')
                    ->toHtml()
        ));
        return parent::_beforeToHtml();
    }

}
