<?php

/**
 * @category    22Feet
 * @package     VideoGallery
 * @author      Binu  <binuconcept@gmail.com,9986442330>
 */
class Mapmygenomie_Videogallery_Block_Adminhtml_Videogallery extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_controller = 'adminhtml_videogallery';
        $this->_blockGroup = 'mapmygenomie_videogallery';

        $this->_headerText = Mage::helper('mapmygenomie_videogallery')->__('Videogallery Manager');
        $this->_addButtonLabel = Mage::helper('mapmygenomie_videogallery')->__('Add New Videogallery');

        parent::__construct();
    }

}
