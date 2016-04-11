<?php

/**
 * @category    22Feet
 * @package     VideoGallery
 * @author      Binu  <binuconcept@gmail.com,9986442330>
 */
class Mapmygenomie_Videogallery_Model_Mysql4_Videogallery_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {

    public function _construct() {
        $this->_init('mapmygenomie_videogallery/videogallery');
    }

    /**
     * function to add the collection which are enabled for now
     *
     * @return Mapmygenomie_Videos_Model_Mysql4_Videogallery_Collection
     * */
    public function addStatusFilter() {
        $this->addFieldToFilter('video_status', Mapmygenomie_Videogallery_Model_Videogallery::STATUS_ENABLED);
        return $this;
    }

}
