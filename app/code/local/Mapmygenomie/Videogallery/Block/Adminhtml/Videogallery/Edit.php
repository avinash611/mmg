<?php

/**
 * @category    22Feet
 * @package     VideoGallery
 * @author      Binu  <binuconcept@gmail.com,9986442330>
 */
class Mapmygenomie_Videogallery_Block_Adminhtml_Videogallery_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'mapmygenomie_videogallery';
        $this->_controller = 'adminhtml_videogallery';

        $this->_updateButton('save', 'label', Mage::helper('mapmygenomie_videogallery')->__('Save Video'));
        $this->_updateButton('delete', 'label', Mage::helper('mapmygenomie_videogallery')->__('Delete Video'));
        $this->_updateButton('delete', 'onclick', 'deleteConfirm(\'Are you sure you want to do this?\', \'' . $this->getUrl('mapmygenomie_videogallery/adminhtml_videogallery/delete/videogallery_id/', array('videogallery_id' => $this->getRequest()->getParam('id'))) . '\')');
    }

    public function getHeaderText() {
        if (Mage::registry('videogallery_data') && Mage::registry('videogallery_data')->getId()) {

            return Mage::helper('mapmygenomie_videogallery')->__("Edit Videogallery '%s'", $this->htmlEscape(Mage::registry('videogallery_data')->getVideoName()));
        } else {
            return Mage::helper('mapmygenomie_videogallery')->__('Add New Video Information');
        }
    }

}
