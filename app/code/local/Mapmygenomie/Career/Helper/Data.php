<?php

class Mapmygenomie_Career_Helper_Data extends Mage_Core_Helper_Abstract {

    /**
     * function to get all the Categories
     *
     * @return array $collection
     * */
    public function getCategories() {
        $collection = Mage::getModel('mapmygenomie_career/category')
                ->getCollection()
                ->addStatusFilter()
                ->addPositionCount()
                ->setOrder('category_name', 'asc');
        return $collection;
    }

    /**
     * function to get all the positions
     * $category : Mapmygenomie_Career_Model_Category
     * @return array $collection
     * */
    public function getCategoryPositions($category) {
        $collection = Mage::getModel('mapmygenomie_career/position')
                ->getCollection()
                ->addStatusFilter()
                ->addCategoryFilter($category->getId())
                ->setOrder('position_name', 'asc');
        return $collection;
    }

    /**
     * to get Carrer Request Email
     *
     * @return $value
     * */
    public function getCareerRequestEmail($store = null) {
        return Mage::getStoreConfig('contacts/mapmygenomie_career/career_request_email', $store);
    }

    public function getApplicantName() {
        if (!Mage::getSingleton('customer/session')->isLoggedIn()) {
            return '';
        }
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        return trim($customer->getName());
    }

    public function getApplicantEmail() {
        if (!Mage::getSingleton('customer/session')->isLoggedIn()) {
            return '';
        }
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        return $customer->getEmail();
    }

}

?>
