<?php

class Mapmygenomie_Career_Block_List extends Mage_Core_Block_Template {

    protected function _construct() {
        parent::_construct();
        $this->setTemplate('career/list.phtml');
    }

    /**
     * function to get all the Categories
     *
     * @return array $categories
     * */
    public function getCategories() {
        return Mage::helper('mapmygenomie_career')->getCategories();
    }

    /**
     * function to get all the positions
     * $category : Mapmygenomie_career_Career_Model_Category
     * @return array $categories
     * */
    public function getCategoryPositions($category) {
        return Mage::helper('mapmygenomie_career')->getCategoryPositions($category);
    }

    public function getPostUrl($destination) {
        return $this->getUrl($destination);
    }

    public function getCareerRequestEmail() {
        return Mage::helper('mapmygenomie_career')->getCareerRequestEmail();
    }

}
