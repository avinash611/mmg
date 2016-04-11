<?php

/**
 * @category    22Feet
 * @package     VideoGallery
 * @author      Binu  <binuconcept@gmail.com,9986442330>
 */
class Mapmygenomie_Videogallery_Block_Adminhtml_Videogallery_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId('videogallery_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('mapmygenomie_videogallery')->__('Video Information'));
    }

    protected function _beforeToHtml() {
        $this->addTab('form_section', array(
            'label' => Mage::helper('mapmygenomie_videogallery')->__('Video Information'),
            'title' => Mage::helper('mapmygenomie_videogallery')->__('Video Information'),
            'content' => $this->getLayout()->createBlock('mapmygenomie_videogallery/adminhtml_videogallery_edit_tab_form')->toHtml(),
        ));
        return parent::_beforeToHtml();
    }

}
