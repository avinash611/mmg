<?php

class Mapmygenomie_Testimonial_Block_List extends Mage_Core_Block_Template {

    protected function _construct() {
        parent::_construct();
        $this->setTemplate('testimonial/list.phtml');
    }

    /**
     * function to get all the Testimonial
     *
     * @return array $testimonial
     * */
    public function getAllTestimonials() {
        return Mage::helper('mapmygenomie_testimonial')->getAllTestimonials();
    }

}
