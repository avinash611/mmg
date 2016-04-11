<?php

/**
 * @category    22Feet
 * @package     VideoGallery
 * @author      Binu  <binuconcept@gmail.com,9986442330>
 */
class Mapmygenomie_Videogallery_Block_Adminhtml_Videogallery_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    /**
     * Load Wysiwyg on demand and Prepare layout
     */
    protected function _prepareLayout() {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('Videogallery_form', array('legend' => Mage::helper('mapmygenomie_videogallery')->__('Video information')));
        $fieldset->addField('isexternal_video', 'select', array(
            'name' => 'isexternal_video',
            'class' => 'required-entry',
            'required' => true,
            'onchange' => 'checkSelectedItem(this.value)',
            'label' => Mage::helper('mapmygenomie_videogallery')->__('Video Type'),
            'title' => Mage::helper('mapmygenomie_videogallery')->__('Video Type'),
            'options' => Mage::getSingleton('mapmygenomie_videogallery/videogallery')->getVideoOptionArray()
        ))->setAfterElementHtml("<script type=\"text/javascript\">
          function checkSelectedItem(selectElement){
          if(selectElement == 2){
          $('video_name').addClassName('required-entry');
          }else{
          $('advice-required-entry-video_name').remove();
          $('video_name').removeClassName('required-entry');
          }
          }
          </script>");

        $fieldset->addField('checkbox', 'checkbox', array(
            'label' => Mage::helper('mapmygenomie_videogallery')->__('Use YouTube Title and Image'),
            'name' => 'useyoutubeimage',
            'onclick' => 'this.value = this.checked ? 1 : 2;',
            'disabled' => false,
            'after_element_html' => '<small>If you select this checkbox no need to enter the title and image it will automatically take it from YouTube</small>',
            'tabindex' => 1
        ));


        $fieldset->addField('video_name', 'text', array(
            'label' => Mage::helper('mapmygenomie_videogallery')->__('Title'),
            'name' => 'video_name',
            'required' => false,
                )
        );


        $fieldset->addField('videogallery_url', 'text', array(
            'label' => Mage::helper('mapmygenomie_videogallery')->__('Video Url'),
            'class' => 'required-entry',
            'required' => true,
            'style' => 'width:100%;',
            'name' => 'videogallery_url',
            'after_element_html' => '<p class="note"><span>I.e. : if the videotype is youtube then the url will be like this,http://www.youtube.com/watch?v=mFBIsCyI0PA <br/> if the video type is others then place the external url</span></p>',
        ));

        $fieldset->addField('video_image', 'image', array(
            'label' => Mage::helper('mapmygenomie_videogallery')->__('Image'),
            'required' => false,
            'name' => 'video_image',
			'after_element_html' => '<p class="note"><span>while uploading image please upload image dimension 480 X 360</span></p>',
        ));

        $fieldset->addField('video_status', 'select', array(
            'name' => 'video_status',
            'label' => Mage::helper('mapmygenomie_videogallery')->__('Video Status'),
            'title' => Mage::helper('mapmygenomie_videogallery')->__('Video Status'),
            'options' => Mage::getSingleton('mapmygenomie_videogallery/videogallery')->getStatusOptionArray()
        ));

        $fieldset->addField('video_priority', 'text', array(
            'label' => Mage::helper('mapmygenomie_videogallery')->__('Priority'),
            'required' => false,
            'type' => 'number',
            'class' => 'validate-number',
            'name' => 'video_priority',
        ));

        $widgetFilters = array('is_email_compatible' => 1);
        $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig(array('widget_filters' => $widgetFilters));
        $fieldset->addField('video_description', 'editor', array(
            'name' => 'video_description',
            'label' => Mage::helper('mapmygenomie_videogallery')->__('Video Description'),
            'title' => Mage::helper('mapmygenomie_videogallery')->__('Video Description'),
            'state' => 'html',
            'style' => 'height:36em;',
            'config' => $wysiwygConfig
        ));

        if (Mage::getSingleton('adminhtml/session')->getVideogalleryData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getVideogalleryData());
            Mage::getSingleton('adminhtml/session')->setVideogalleryData(null);
        } elseif (Mage::registry('videogallery_data')) {
            $form->setValues(Mage::registry('videogallery_data')->getData());
        }
        return parent::_prepareForm();
    }   
}
