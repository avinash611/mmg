<?php

/**
 * @category    22Feet
 * @package     VideoGallery
 * @author      Binu  <binuconcept@gmail.com,9986442330>
 */
class Mapmygenomie_Videogallery_Block_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        return ($this->_getImage($row));
    }

    protected function _getImage(Varien_Object $row) {

        $img = $row->video_image != '' ? '<img height="60" width="60" src="' . Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . $row->video_image . '" alt="" />' : '';
        return $img;
    }

}
