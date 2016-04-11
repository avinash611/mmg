<?php

/**
 * @category    22Feet
 * @package     VideoGallery
 * @author      Binu  <binuconcept@gmail.com,9986442330>
 */
class Mapmygenomie_Videogallery_Model_Videogallery extends Mage_Core_Model_Abstract {

    const YOUTUBE_VIDEOS = 1;
    const OTHER_VIDEOS = 2;
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    public function _construct() {
        parent::_construct();
        $this->_init('mapmygenomie_videogallery/videogallery');
    }

    static public function getVideoOptionArray() {
        return array(
            self::YOUTUBE_VIDEOS => Mage::helper('mapmygenomie_videogallery')->__('Youtube Videos'),
            self::OTHER_VIDEOS => Mage::helper('mapmygenomie_videogallery')->__('Other Videos')
        );
    }

    static public function getStatusOptionArray() {
        return array(
            self::STATUS_ENABLED => Mage::helper('mapmygenomie_videogallery')->__('Enabled'),
            self::STATUS_DISABLED => Mage::helper('mapmygenomie_videogallery')->__('Disabled')
        );
    }
  

}
