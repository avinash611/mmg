<?php

/**
 * @category    22Feet
 * @package     VideoGallery
 * @author      Binu  <binuconcept@gmail.com,9986442330>
 */
class Mapmygenomie_Videogallery_Helper_Data extends Mage_Core_Helper_Abstract {

    /**
     * function to get all the Videos
     *
     * @return array $collection
     * */
    public function getAllVideos() {
        $collection = Mage::getModel('mapmygenomie_videogallery/videogallery')
                ->getCollection()
                ->addStatusFilter()
                ->setOrder('video_priority', 'desc');
        return $collection;
    }

}
