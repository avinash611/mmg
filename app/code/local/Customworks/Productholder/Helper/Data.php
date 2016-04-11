<?php

class Customworks_Productholder_Helper_Data extends Mage_Core_Helper_Abstract {

    public function getCategoryName($_product = null) {		
        $ids = $_product->getCategoryIds();
        //$categoryId = (isset($ids[1]) ? $ids[1] : null);
        $category = new Mage_Catalog_Model_Category();
        $category->load(end($ids));
        return $category;		
    }
	
	 public function getSimilarProductCategory($_product = null) {
       /* $currentCategory = Mage::registry('current_product')->getCategoryId();
        if ($currentCategory) {		
            return Mage::getModel('catalog/category')->load($currentCategory);
        } else {*/
            $cat_ids = $_product->getCategoryIds();			
            $rootCategory = Mage::getModel('catalog/category')
                    ->load(Mage::app()->getStore()->getRootCategoryId());
            $sameStoreCategories = Mage::getResourceModel('catalog/category_collection')
                    ->addIdFilter($cat_ids)
                    ->addFieldToFilter('path', array('like' => $rootCategory->getPath() . '/%'))
                    ->getItems();
            $currentStoreCatids = array_keys($sameStoreCategories);		
            if (!empty($currentStoreCatids)) {
                $category = new Mage_Catalog_Model_Category();
                $category->load(end($currentStoreCatids));
                return $category;
            } else {
                return '';
            }
       // }
    }
	


    public function getRelatedProducts($category = null, $_product = null) {
        $collection = $category->getProductCollection();
        Mage::getModel('catalog/layer')->prepareProductCollection($collection);
        $collection->getSelect()->order('rand()');
        //$collection->addStoreFilter();
        $collection->addIdFilter(array($_product->getId()), true);
        $numProducts = 4;
        $collection->setPage(1, $numProducts)->load();
        $mainarray = array();
        foreach ($collection as $product) {
            array_push($mainarray, $product->getId());
        }
        $attributes = Mage::getSingleton('catalog/config')->getProductAttributes();
        $collection = Mage::getModel('catalog/product')->getCollection()->addAttributeToFilter('entity_id', array('in' => $mainarray))->addAttributeToSelect($attributes);
        return $collection;
    }

    public function BlogSearch($sku, $limit) {
       // $base = Mage::getBaseUrl();
	    $base = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
        $url = $base . 'blog/api/get_tag_posts/?tag_slug=' . $sku . '&count=' . $limit;
        $data = $this->_curlproc($url);
        $result = json_decode($data);
        return $result;
    }
	
	public function LatestBlog($limit) {
       // $base = Mage::getBaseUrl();
	    $base = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
        $url = $base . 'blog/api/get_recent_posts/?count=' . $limit;
        $data = $this->_curlproc($url);
        $result = json_decode($data);		
        return $result;
    }

    protected function _curlproc($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        return $data;
    }

    public function getProductsBasedOnAgeGroupAndGender() {
        $collection = Mage::getResourceModel('catalog/product_collection');
        $collection->addAttributeToSelect('name');
        $collection->addAttributeToFilter('homepage_age_filters', array('notnull' => 1)); //get not null value
        $collection->addAttributeToFilter('homepage_age_filters', array('neq' => '133')); //none value
        $collection->addFieldToFilter('status', Mage_Catalog_Model_Product_Status::STATUS_ENABLED);

        $ageArray = array();
        $productsFilteredByAge = array();

        $attribute = Mage::getModel('eav/config')->getAttribute('catalog_product', 'homepage_age_filters');
        foreach ($attribute->getSource()->getAllOptions(true, true) as $instance) {
            if ($instance['label'] != 'none') { //remove "none" value
                $ageArray[$instance['value']] = $instance['label'];
            }
        }
        // print_r($collection);die;

        foreach ($collection as $_product) {
            //echo $_product->getId() . ' --- ';
            //echo $_product->getAttributeText('homepage_age_filters') . '<br>';

            $product = Mage::getModel('catalog/product');
            $product->load($_product->getId());

            $image_url = (string) Mage::helper('catalog/image')->init($product, 'image')->resize(200, 200); // get image url

            if (is_array($product->getAttributeText('gender'))) { //if mutiple values are selected ex: male,unisex
                foreach ($product->getAttributeText('gender') as $gender) {
                     if (is_array($_product->getAttributeText('homepage_age_filters'))) {
                         foreach ($_product->getAttributeText('homepage_age_filters') as $homepageage) {
                            if (sizeof($productsFilteredByAge [trim($gender)] [$homepageage]) < 3) { // only 3 products per age category
                                $productsFilteredByAge [trim($gender)] [$homepageage] [] = array('product_id' => $_product->getId(), 'product_url' => $_product->getProductUrl(), 'product_image' => $image_url, 'product_name' => $this->htmlEscape($_product->getName()));
                            }
                        }
                    } else {
                        if (sizeof($productsFilteredByAge [trim($gender)] [$ageArray[$_product->getData('homepage_age_filters')]]) < 10) { // only 3 products per age category
                            $productsFilteredByAge [trim($gender)] [$ageArray[$_product->getData('homepage_age_filters')]] [] = array('product_id' => $_product->getId(), 'product_url' => $_product->getProductUrl(), 'product_image' => $image_url, 'product_name' => $this->htmlEscape($_product->getName()));
                        }
                    }
                }
            } else { // single value selected                
                if (is_array($_product->getAttributeText('homepage_age_filters'))) {
                    foreach ($_product->getAttributeText('homepage_age_filters') as $homepageage) {
                        //foreach ($ageArray as $agevalues) {
                            if (sizeof($productsFilteredByAge [trim($product->getAttributeText('gender'))] [$homepageage]) < 3) { // only 3 products per age category
                                $productsFilteredByAge [trim($product->getAttributeText('gender'))] [$homepageage] [] = array('product_id' => $_product->getId(), 'product_url' => $_product->getProductUrl(), 'product_image' => $image_url, 'product_name' => $this->htmlEscape($_product->getName()));
                            }
                      //  }
                    }
                } else {
                    if (sizeof($productsFilteredByAge [trim($product->getAttributeText('gender'))] [$ageArray[$_product->getData('homepage_age_filters')]]) < 10) { // only 3 products per age category
                        $productsFilteredByAge [trim($product->getAttributeText('gender'))] [$ageArray[$_product->getData('homepage_age_filters')]] [] = array('product_id' => $_product->getId(), 'product_url' => $_product->getProductUrl(), 'product_image' => $image_url, 'product_name' => $this->htmlEscape($_product->getName()));
                    }
                }
            }
        }      
        $json_response = '';
        $json_response = (json_encode($productsFilteredByAge));
        return $json_response;
    }

}
