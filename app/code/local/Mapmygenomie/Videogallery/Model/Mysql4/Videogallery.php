<?php

/**
 * @category    22Feet
 * @package     VideoGallery
 * @author      Binu  <binuconcept@gmail.com,9986442330>
 */
class Mapmygenomie_Videogallery_Model_Mysql4_Videogallery extends Mage_Core_Model_Mysql4_Abstract {

    public function _construct() {
        $this->_init('mapmygenomie_videogallery/videogallery', 'videogallery_id');
        //$this->_isPkAutoIncrement = false;
    }

}
