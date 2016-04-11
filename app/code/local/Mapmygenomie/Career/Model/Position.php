<?php

class Mapmygenomie_Career_Model_Position extends Mage_Core_Model_Abstract
{	
	const STATUS_ENABLED    = 1;
    const STATUS_DISABLED   = 2;

    public function _construct()
    {
        $this->_init('mapmygenomie_career/position');
    }
    
	static public function getStatusOptionArray()
    {
        return array(
            self::STATUS_ENABLED    => Mage::helper('mapmygenomie_career')->__('Enabled'),
            self::STATUS_DISABLED   => Mage::helper('mapmygenomie_career')->__('Disabled')
        );
    }
    public function getCategoryList()
    {
         $options =  array();
         $categories = Mage::getResourceModel('mapmygenomie_career/category_collection')
		 		->addFieldToFilter('category_status', Mapmygenomie_Career_Model_Category::STATUS_ENABLED );
		 		
        foreach ($categories as $category) {
            if (isset($category)){
                $options[] = array(
                    'value' => $category['category_id'],
                    'label' => $category['category_name']
                );
            }
        }
        return $options;
    }

}
