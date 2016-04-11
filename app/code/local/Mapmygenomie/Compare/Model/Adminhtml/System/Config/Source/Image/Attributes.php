<?php
class Mapmygenomie_Compare_Model_Adminhtml_System_Config_Source_Image_Attributes{
    /**
     * options
     * @var null|mixed
     */
    protected $_options = null;

    /**
     * get the list of options
     * @access public
     * @param bool $withEmpty
     * @return mixed|null
     * @author Marius Strajeru <marius.strajeru@gmail.com>
     */
    public function toOptionArray1($withEmpty = false){
        if (is_null($this->_options)){
            $collection = Mage::getResourceModel('catalog/product_attribute_collection')
                ->addVisibleFilter()
                ->addFieldToFilter('frontend_input', 'media_image')
            ;
            foreach ($collection as $attribute){
                $this->_options[] = array(
                    'label'=>$attribute->getFrontendLabel(),
                    'value'=>$attribute->getAttributeCode()
                );
            }
        }
        return $this->_options;
    }
}