<?php

class Mapmygenomie_SeoCore_Model_Observer extends Mage_Core_Model_Abstract {

    public function discontinuedCheck($observer) {
        if (Mage::getStoreConfig('mapmygenomie_seocore/settings/enable', Mage::app()->getStore()) == 1) {

            $data = $observer->getEvent()->getAction()->getRequest();

            if (($data->getControllerModule() == "Rewrite_Catalog") || ($data->getControllerModule() == "Mage_Catalog")) {
                $id = $data->getParam('id');
                if ($data->getControllerName() == "product") {
                    $product = Mage::getModel('catalog/product')->load($id);
                    $url = Mage::helper('mapmygenomie_seocore')->getDiscontinuedProductUrl($product);                 
                    if ($url) {
                        Mage::getSingleton('core/session')->addError('Unfortunately the product "' . $product->getName() . '" has been discontinued');
                        Mage::app()->getFrontController()->getResponse()->setRedirect($url, 301);
                        Mage::app()->getResponse()->sendResponse();
                        exit;
                    }
                }
                if ($data->getControllerName() == "category") {
                    $id = $data->getParam('id');
                    $category = Mage::getModel('catalog/category')->load($id);
                    $url = Mage::helper('mapmygenomie_seocore')->getDiscontinuedCategoryUrl($category);
                    if ($url) {
                        Mage::getSingleton('core/session')->addError('Unfortunately the category "' . $category->getName() . '" has been discontinued');
                        Mage::app()->getFrontController()->getResponse()->setRedirect($url, 301);
                        Mage::app()->getResponse()->sendResponse();
                        exit;
                    }
                }
            }
        }
    }

}
