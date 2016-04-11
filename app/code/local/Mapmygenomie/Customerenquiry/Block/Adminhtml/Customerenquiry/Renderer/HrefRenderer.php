<?php

class Mapmygenomie_Customerenquiry_Block_Adminhtml_Customerenquiry_Renderer_HrefRenderer extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $value = $row->getData($this->getColumn()->getIndex());
        return '<a target="_blank" href="' . Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'customer_reports/' . $value . '">' . $value . '</a>';
    }

}

?>