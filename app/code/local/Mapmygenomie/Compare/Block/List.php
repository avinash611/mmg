<?php

class Mapmygenomie_Compare_Block_List extends Mage_Core_Block_Template {  
    public function getCompareProducts() {
        if (Mage::helper('mapmygenomie_compare')->isEnabled()) {
            $productsCollection = Mage::getModel('catalog/product')->getCollection()
                    ->addAttributeToSelect(array('name', 'description','short_description', 'product_url', 'small_image', 'image', 'status'))
                    // ->addAttributeToFilter('attribute_set_id', 18)
                    ->addAttributeToFilter('status', 1)
                    ->addAttributeToFilter('compare', array('neq' => ''));

            return $productsCollection;
        } else {
            return null;
        }
    }

    public function getOptionImages($product) {
        $images = array();
        $allowed = explode(",", $product->getCompare());
        $options = Mage::getModel('mapmygenomie_compare/optimage')->getOptionCollection($allowed, $byOptIds = true);
        foreach ($options as $option) {
            if ($option->getOptimage()) {
                $image = Mage::helper('mapmygenomie_compare/optimage')->init($option, 'optimage');
                $images[$option->getId()]['image_url'] = (string) $image;
            } elseif ($option->getHexaCode()) {
                $images[$option->getId()]['hexa_code'] = $option->getHexaCode();
            }
            $images[$option->getId()]['name'] = $option->getValue();
        }
        $images[$product->getSku()]['productname'] = $product->getName();

        return $images;
    }
}
