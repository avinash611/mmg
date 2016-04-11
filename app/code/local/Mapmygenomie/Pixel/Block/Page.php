<?php

class Mapmygenomie_Pixel_Block_Page extends Mage_Core_Block_Template {

    protected function _construct() {
        parent::_construct();
        $this->setTemplate('pixel/js/every_page.phtml');
    }

    /*
     * ecomm_pagetype:
     * home,
     * searchresults,
     * category,
     * product,
     * cart,
     * purchase,
     * other
     */

    protected function _toHtml() {
        $this->ecomm_pagetype = 'other';
        $this->ecomm_prodid = '""';
        $this->ecomm_totalvalue = '""';
        $this->ecomm_onepage_index = '""';
        $this->ecom_gatags = [];
        $this->ecom_cat_names = [];
        $this->ecom_search_string = "";
        $this->ecomm_totalquantity = 0;
        $ecom_categories = array();
        switch (Mage::app()->getFrontController()->getAction()->getFullActionName()) {
            case 'catalogsearch_result_index':
//searchresults
                $this->ecom_search_string = Mage::helper('catalogsearch')->getQueryText();
                $this->ecomm_pagetype = 'searchresults';
//$search_collection = Mage::getSingleton('catalogsearch/advanced')->getProductCollection();
//$search_collection = Mage::getSingleton('catalogsearch/layer')->getProductCollection();               
                $search_collection = Mage::registry('current_layer')->getProductCollection();

                $product_ids = array();
                $this->ecomm_totalvalue = 0;
                foreach ($search_collection as $prod_id) {
                    $product_id = trim($prod_id->getSku());
                    if ($product_id) {
                        if (count($product_ids) < 12) {
                            if (!in_array($product_id, $product_ids)) {
                                array_push($product_ids, $product_id);
                                $this->ecomm_totalvalue += $prod_id->getFinalPrice();
                            }
                        }
                    }
                }
                $this->ecomm_prodid = '["' . implode('","', array_unique($product_ids)) . '"]';
                break;
            case 'catalog_category_view':
//category
                $this->ecomm_pagetype = 'category';
                if ($category = Mage::registry('current_category')) {
                    $path = $category->getPath();
                    $cids = explode('/', $path);
                    if (!empty($cids) && isset($cids[2])) {
                        if (count($cids) > 3) {
//removing first two default values
                            $remainingCategoryIds = array_slice($cids, 2);
                            $remaining_count = 0;
                            foreach ($remainingCategoryIds as $cid) {
                                $remaining_count ++;
                                if ($remaining_count == count($remainingCategoryIds)) {
                                    array_push($ecom_categories, str_replace(' ', '', $category->getName()));
                                    break;
                                } else {
                                    $parentcategory = Mage::getModel('catalog/category')->setStoreId(Mage::app()->getStore()->getId())->load($cid);
                                    if (!empty($parentcategory)) {
                                        array_push($ecom_categories, str_replace(' ', '', $parentcategory->getName()));
                                    }
                                }
                            }
                        } else {
//main category view page
                            array_push($ecom_categories, str_replace(' ', '', $category->getName()));
                        }
                    }
                    $this->ecom_cat_names = $ecom_categories;
                    $this->ecomm_prodid = '""';
                    $this->ecomm_totalvalue = '""';
                }
                break;
            case 'catalog_product_view':
//product
                $this->ecomm_pagetype = 'product';
                if ($_product = Mage::registry('current_product')) {
                    $categoryIds = $_product->getCategoryIds();
                    $category = new Mage_Catalog_Model_Category();
                    $category->load(end($categoryIds));
                    $remaining_count = 0;
                    if (count($categoryIds) == 1) {
                        array_push($ecom_categories, str_replace(' ', '', $category->getName()));
                    } else {
                        foreach ($categoryIds as $cid) {
                            $remaining_count ++;
                            if ($remaining_count == count($categoryIds)) {
                                array_push($ecom_categories, str_replace(' ', '', $category->getName()));
                                break;
                            } else {
                                $parentcategory = Mage::getModel('catalog/category')->setStoreId(Mage::app()->getStore()->getId())->load($cid);
                                if (!empty($parentcategory)) {
                                    array_push($ecom_categories, str_replace(' ', '', $parentcategory->getName()));
                                }
                            }
                        }
                    }
                    $this->ecom_cat_names = $ecom_categories;
                    $_prodprice = number_format($_product->getPrice(), 0, '', '');
                    if (Mage::registry('current_product')->getPrice()) {
                        $this->ecomm_totalvalue = $_prodprice;
                    } else {
                        $this->ecomm_totalvalue = '""';
                    }
                    $this->ecomm_prodid = $_product->getSku();

                    $this->ecom_gatags = array("id" => $_product->getSku(), "name" => $_product->getName(), 'category' => $category->getName());
                }
                break;

            case 'checkout_cart_index':
            case "checkout_onepage_index":
//cart
                $this->ecomm_totalvalue = '""';
                if ($this->getRequest()->getControllerName() == 'cart') {
                    $this->ecomm_pagetype = 'cart';
                } else {
                    $this->ecomm_pagetype = 'purchase';
                    $this->ecomm_onepage_index = 'onepagehome';
                }
                $this->ecomm_prodid = '';
                if (Mage::helper('checkout/cart')->getQuote()->getGrandTotal()) {
                    $this->ecomm_totalvalue = Mage::helper('checkout/cart')->getQuote()->getGrandTotal();
                } else {
                    $this->ecomm_totalvalue = '""';
                }
                if (Mage::helper('checkout/cart')->getQuote()->getAllVisibleItems()) {
                    $visible_items = Mage::helper('checkout/cart')->getQuote()->getAllVisibleItems();
                    $product_ids = array();
                    $k = 0;
                    $list = [];
                    $remaining_count = 0;
                    $totalCartProduct = 0;
					$rootCategory = Mage::getModel('catalog/category')->load(Mage::app()->getStore()->getRootCategoryId());
                    foreach ($visible_items as $prod_id) {
                        $totalCartProduct++;

                        $product_id = $prod_id->getSku();
                        $qty = $prod_id->getQty();
                        $price = $prod_id->getProduct()->getFinalPrice();

                       $categoryIds = $prod_id->getProduct()->getCategoryIds();
                       $sameStoreCategories = Mage::getResourceModel('catalog/category_collection')
                                ->addIdFilter($categoryIds)
                                ->addFieldToFilter('path', array('like' => $rootCategory->getPath() . '/%'))
                                ->getItems();
                        $currentStoreCatids = array_keys($sameStoreCategories);
                        if (!empty($currentStoreCatids)) {                           
                            $category = Mage::getSingleton('catalog/category')->load(end($currentStoreCatids));                            
                        } else {                           
                            $category = Mage::getSingleton('catalog/category')->load(end($categoryIds));
                        }

                        $itemprice = $qty * $price;
                        $list[] = array('id' => $prod_id->getSku(), 'name' => $prod_id->getName(), 'category' => $category->getName(), 'price' => $itemprice, 'quantity' => $qty);
                        $k++;
                        if (count($product_ids) < 12) {
                            if (!in_array($product_id, $product_ids)) {
                                $product_ids[] = $product_id;
                            }
                        }
                    }
                    $this->ecom_gatags = $list;
                    $this->ecomm_prodid = '["' . implode('","', array_unique($product_ids)) . '"]';
                }
                break;

            case "checkout_onepage_success":
//cart, purchase
                $this->ecomm_prodid = '';
                $this->ecomm_totalvalue = 0;
                $this->ecomm_pagetype = 'success';
                $totalquantity = 0;
                $order_details = Mage::getModel('sales/order')->loadByIncrementId(Mage::getSingleton('checkout/session')->getLastRealOrderId());
                $orderItems = $order_details->getAllVisibleItems();
                $this->ecomm_totalvalue = number_format($order_details->subtotal, 2, '.', '');
                // $visible_items = Mage::helper('checkout/cart')->getQuote()->getAllVisibleItems();
                $product_ids = array();
                foreach ($orderItems as $itemId => $item) {
                    $product_id = trim($item->getSku());
                    if (count($product_ids) < 12) {
                        if (!in_array($product_id, $product_ids)) {
                            $product_ids[] = $product_id;
                        }
                    }
                    $totalquantity += $item->getQtyToInvoice();
                }
                $this->ecomm_totalquantity = $totalquantity;
                $this->ecomm_prodid = '["' . implode('","', array_unique($product_ids)) . '"]';
                break;
            case "cms_index_index":
                $this->ecomm_pagetype = "home";
                break;
            case "customer_account_index":
                $this->ecomm_pagetype = "registerSuccess";
                break;
            default:
//other
                if ($this->getRequest()->getRouteName() != 'cms') {
                    $this->ecomm_pagetype = 'other';
                }

                $this->ecomm_prodid = '""';
                $this->ecomm_totalvalue = '""';
        }

        return parent::_toHtml();
    }

    public function isFirstTimeRegisterUser() {
        $session = Mage::getSingleton('core/session', array('name' => 'frontend'));
        return $session->getFirstTimeRegister();
    }

    public function removeFristTimeRegisterSessionValue() {
        Mage::getSingleton('core/session')->unsFirstTimeRegister();
    }

}
