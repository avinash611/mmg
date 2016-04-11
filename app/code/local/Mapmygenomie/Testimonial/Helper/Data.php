<?php

class Mapmygenomie_Testimonial_Helper_Data extends Mage_Core_Helper_Abstract {

    /**
     * function to get all the Testimonial
     *
     * @return array $Testimonials
     * */
    public function getAllTestimonials() {

        $collection = Mage::getModel('mapmygenomie_owlcarousal/owlcarousalinfo')->getCollection()
                ->addFieldToFilter('carousal_status', 1)
                ->addFieldToFilter('category_id', 2)
                ->setOrder('carousal_priority', 'asc');       
        return $collection;
    }

}

?>
