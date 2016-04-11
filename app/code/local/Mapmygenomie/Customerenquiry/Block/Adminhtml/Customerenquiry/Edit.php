<?php
class Mapmygenomie_Customerenquiry_Block_Adminhtml_Customerenquiry_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{
   
   public function __construct() {
        parent::__construct();
        $this->_objectId = 'id';

        $this->_blockGroup = 'mapmygenomie_customerenquiry';

        $this->_controller = 'adminhtml_customerenquiry';

        $this->_updateButton('save', 'label','Save Customer Reports');
        $this->_updateButton('delete', 'label', 'Delete Customer Reports');
    }

    public function getHeaderText() {
        if( Mage::registry('mapmygenomie_customerenquiry_data')&&Mage::registry('mapmygenomie_customerenquiry_data')->getId())
         {
              return 'Editor - Customer Details '.$this->htmlEscape(
              Mage::registry('mapmygenomie_customerenquiry_data')->getTitle()).'<br />';
         }
         else
         {
             return 'Add a Customer Details';
         }
    }
}