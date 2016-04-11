<?php

/**
 * @category    22Feet
 * @package     VideoGallery
 * @author      Binu  <binuconcept@gmail.com,9986442330>
 */
class Mapmygenomie_Videogallery_Block_Videogallery extends Mage_Catalog_Block_Product_List {

    /**
     * function to get all the videos
     *
     * @return array $videos
     * */
    public function getAllVideos() {
        return Mage::helper('mapmygenomie_videogallery')->getAllVideos();
    }  

}
