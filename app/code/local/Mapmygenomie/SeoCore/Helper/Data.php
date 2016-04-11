<?php

class Mapmygenomie_SeoCore_Helper_Data extends Mage_Core_Helper_Abstract {

    public function getDiscontinuedProductUrl($product) {
        $type = $product->getAttributeText('creareseo_discontinued');
        // check to see if we want to redirect to a product / category / homepage
        if ($type == '301 Redirect to Category') {
            $cats = $product->getCategoryIds();
            if (is_array($cats) && count($cats) > 1) {
                $cat = Mage::getModel('catalog/category')->load($cats[0]);
                if (($cat->getName() == "Default Category") || ($cat->getName() == "International")) {
                    if ($cats[1]) {
                        $cat = Mage::getModel('catalog/category')->load($cats[1]);
                    } else {
                        return Mage::getBaseUrl();
                    }
                }
                return Mage::getBaseUrl() . $cat->getUrlPath();
            } else {
                $cat = Mage::getModel('catalog/category')->load($cats);
                if (($cat->getName() == "Default Category") || ($cat->getName() == "International")) {
                    if ($cats[1]) {
                        $cat = Mage::getModel('catalog/category')->load($cats[1]);
                    } else {
                        return Mage::getBaseUrl();
                    }
                }
                return Mage::getBaseUrl() . $cat->getUrlPath();
            }
        }

        if ($type == '301 Redirect to Sub Category') {
            $cats = $product->getCategoryIds();
            if (is_array($cats) && count($cats) > 1) {
                if ($cats[1]) {
                    $cat = Mage::getModel('catalog/category')->load($cats[1]);
                    if (($cat->getName() == "Default Category") || ($cat->getName() == "International")) {
                        if ($cats[2]) {
                            $cat = Mage::getModel('catalog/category')->load($cats[2]);
                        } else {
                            return Mage::getBaseUrl();
                        }
                    }
                    return Mage::getBaseUrl() . $cat->getUrlPath();
                } else {

                    return Mage::getBaseUrl();
                }
            } else {
                $cat = Mage::getModel('catalog/category')->load($cats);
                if (($cat->getName() == "Default Category") || ($cat->getName() == "International")) {
                    if ($cats[1]) {
                        $cat = Mage::getModel('catalog/category')->load($cats[1]);
                    } else {
                        return Mage::getBaseUrl();
                    }
                }
                return Mage::getBaseUrl() . $cat->getUrlPath();
            }
        }

        if ($type == '301 Redirect to Homepage') {
            return Mage::getBaseUrl();
        }

        if ($type == '301 Redirect to Product SKU') {
            if ($product->getCreareseoDiscontinuedProduct()) {
                $website_id = Mage::app()->getWebsite()->getId();
                $storeId = Mage::app()->getStore()->getStoreId();
                $sku = $product->getCreareseoDiscontinuedProduct();
               
                $collection = Mage::getModel('catalog/product')->getCollection()
                        ->addAttributeToSelect('sku')
                        ->setStoreId($storeId)
                        ->addWebsiteFilter($website_id)
                        ->addFieldToFilter('sku', $sku);  
                if (count($collection) > 0) {                     
                    $related = Mage::getModel('catalog/product')->setStoreId($storeId)->loadByAttribute('sku', $sku);
                    $ids = $related->getCategoryIds();                    
                    $category = new Mage_Catalog_Model_Category();
                    $category->load(end($ids));
                    $product_url = Mage::getBaseUrl() . trim(Mage::getModel('catalog/product_url')->getUrlPath($related, $category), "/");                   
                    return $product_url;
                }else{
                    return Mage::getBaseUrl();
                }
            }
        }

        return false;
    }

    public function getDiscontinuedCategoryUrl($category) {
        if ($category->getLevel() == 2) {
            if (!$category->getIsActive()) {
                return Mage::getBaseUrl();
            } else {
                return Mage::getBaseUrl() . $category->getUrlPath();
            }
        } else {
            $parentCategory = Mage::getModel('catalog/category')->load($category->getParentId());
            return $this->getDiscontinuedCategoryUrl($parentCategory);
        }
    }
	
	

}
