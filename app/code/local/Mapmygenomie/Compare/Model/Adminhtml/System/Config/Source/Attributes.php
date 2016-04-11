<?php

class Mapmygenomie_Compare_Model_Adminhtml_System_Config_Source_Attributes {

    /**
     * available options
     * @var null|mixed
     */
    protected $_options = null;

    /**
     * get the list of attributes
     * @access public
     * @param bool $withEmpty
     * @return mixed|null
     * @author Marius Strajeru <marius.strajeru@gmail.com>
     */
    public function toOptionArray($withEmpty = true) {
        if (is_null($this->_options)) {
            $collection = Mage::getResourceModel('catalog/product_attribute_collection')
                    /* ->addVisibleFilter() */
                    /* ->addFieldToFilter('is_configurable', 1) */
                   /* ->addFieldToFilter('frontend_input', 'select')*/
                    ->addFieldToFilter('frontend_input', 'multiselect')
            ;
            $this->_options = array();
            if ($withEmpty) {
                $this->_options[] = array(
                    'label' => Mage::helper('mapmygenomie_compare')->__('[none]'),
                    'value' => ''
                );
            }

            foreach ($collection as $attribute) {
                if ($attribute->getAttributeCode() == "compare") {
                    $this->_options[] = array(
                        'label' => $attribute->getFrontendLabel(),
                        'value' => $attribute->getAttributeCode()
                    );
                } else {
                    if (Mage::getSingleton('catalog/product_type_configurable')->canUseAttribute($attribute)) {
                        $this->_options[] = array(
                            'label' => $attribute->getFrontendLabel(),
                            'value' => $attribute->getAttributeCode()
                        );
                    }
                }
            }        
        }
        return $this->_options;
    }

}
