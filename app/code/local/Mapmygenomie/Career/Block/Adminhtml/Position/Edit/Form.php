<?php

class Mapmygenomie_Career_Block_Adminhtml_Position_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {

    public function getCurrentModel() {
        return Mage::registry('mapmygenomie_career_position_data');
    }

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
        $model = $this->getCurrentModel();

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array('_current' => true)),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));
        $form->setHtmlIdPrefix('carrer_position_edit_');

        $fieldset = $form->addFieldset('general_fieldset', array(
            'legend' => Mage::helper('mapmygenomie_career')->__('Position Information'),
            'class' => 'fieldset-wide'
                )
        );

        $this->_addElementTypes($fieldset);

        $fieldset->addField('position_name', 'text', array(
            'label' => Mage::helper('mapmygenomie_career')->__('Position Name'),
            'name' => 'position_name',
            'required' => true,
                )
        );
        $fieldset->addField('category_id', 'select', array(
            'name' => 'category_id',
            'label' => Mage::helper('mapmygenomie_career')->__('Category Name'),
            'required' => true,
            'values' => array('' => Mage::helper('mapmygenomie_career')->__('Select Category')) + Mage::getSingleton('mapmygenomie_career/position')->getCategoryList(),
                )
        );

        $fieldset->addField('position_count', 'text', array(
            'label' => Mage::helper('mapmygenomie_career')->__('Position Count'),
            'name' => 'position_count',
            'required' => true,
            'class' => 'validate-not-negative-number',
                )
        );
        $fieldset->addField('position_location', 'text', array(
            'label' => Mage::helper('mapmygenomie_career')->__('Position Location'),
            'name' => 'position_location'
                )
        );

        $fieldset->addField('position_status', 'select', array(
            'name' => 'position_status',
            'label' => Mage::helper('mapmygenomie_career')->__('Status'),
            'title' => Mage::helper('mapmygenomie_career')->__('Status'),
            'options' => Mage::getSingleton('mapmygenomie_career/position')->getStatusOptionArray()
        ));
        $widgetFilters = array('is_email_compatible' => 1);
        $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig(array('widget_filters' => $widgetFilters));
        $fieldset->addField('position_description', 'editor', array(
            'name' => 'position_description',
            'label' => Mage::helper('mapmygenomie_career')->__('Description'),
            'title' => Mage::helper('mapmygenomie_career')->__('Description'),
            'required' => true,
            'state' => 'html',
            'style' => 'height:36em;',
            'config' => $wysiwygConfig
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}