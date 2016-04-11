<?php

class Mapmygenomie_Owlcarousal_Block_Adminhtml_Owlcarousalinfo_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

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
        $fieldset = $form->addFieldset('mapmygenomie_owlcarousal_form', array('legend' => Mage::helper('mapmygenomie_owlcarousal')->__('Carousal information')));

        $fieldset->addField('category_id', 'select', array(
            'name' => 'category_id',
            'label' => Mage::helper('mapmygenomie_owlcarousal')->__('Carousal Type'),
            'title' => Mage::helper('mapmygenomie_owlcarousal')->__('Carousal Type'),
            'options' => Mage::getSingleton('mapmygenomie_owlcarousal/owlcarousalinfo')->getCarousalCategoryArray()
        ));

        $fieldset->addField('carousal_headtitle', 'text', array(
            'label' => Mage::helper('mapmygenomie_owlcarousal')->__('Title'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'carousal_headtitle',
        ));

        $fieldset->addField('carousal_image', 'image', array(
            'label' => Mage::helper('mapmygenomie_owlcarousal')->__('Image'),
            'required' => false,
            'name' => 'carousal_image',
        ));

        $fieldset->addField('carousal_smalldesc', 'text', array(
            'label' => Mage::helper('mapmygenomie_owlcarousal')->__('Small Description'),
            'class' => 'required-entry',
            'required' => false,
            'name' => 'carousal_smalldesc',
        ));

        $widgetFilters = array('is_email_compatible' => 1);
        $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig(array('widget_filters' => $widgetFilters));
        $fieldset->addField('carousal_description', 'editor', array(
            'name' => 'carousal_description',
            'label' => Mage::helper('mapmygenomie_owlcarousal')->__('Description'),
            'title' => Mage::helper('mapmygenomie_owlcarousal')->__('Description'),            
            'state' => 'html',
            'style' => 'height:36em;',
            'config' => $wysiwygConfig
        ));


        /*
          $fieldset->addField('carousal_description', 'text', array(
          'label' => Mage::helper('mapmygenomie_owlcarousal')->__('Description'),
          'required' => true,
          'name' => 'carousal_description',
          )); */

        $fieldset->addField('carousal_priority', 'text', array(
            'label' => Mage::helper('mapmygenomie_owlcarousal')->__('Position'),
            'required' => false,
            'name' => 'carousal_priority',
        ));

        $fieldset->addField('carousal_status', 'select', array(
            'name' => 'carousal_status',
            'label' => Mage::helper('mapmygenomie_owlcarousal')->__('Status'),
            'title' => Mage::helper('mapmygenomie_owlcarousal')->__('Status'),
            'options' => Mage::getSingleton('mapmygenomie_owlcarousal/owlcarousalinfo')->getStatusOptionArray()
        ));

        if (Mage::getSingleton('adminhtml/session')->getOwlCarousalData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getOwlCarousalData());
            Mage::getSingleton('adminhtml/session')->setOwlCarousalData(null);
        } elseif (Mage::registry('mapmygenomie_owlcarousal_data')) {
            $form->setValues(Mage::registry('mapmygenomie_owlcarousal_data')->getData());
        }
        return parent::_prepareForm();
    }

}
