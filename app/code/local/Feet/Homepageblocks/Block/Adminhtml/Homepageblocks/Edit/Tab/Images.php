<?php

/**
 * @category    22Feet
 * @package     Feet_HomepageBlocks
 * @author      Chanchal Sarkar <chanchal@22feet.in>
 */
class Feet_Homepageblocks_Block_Adminhtml_Homepageblocks_Edit_Tab_Images extends Mage_Adminhtml_Block_Widget_Form {

    protected function _getAdditionalElementTypes() {
        return array(
            'image' => Mage::getConfig()->getBlockClassName('homepageblocks/adminhtml_homepageblocks_helper_image')
        );
    }

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('homepageblocks_images', array('legend' => Mage::helper('homepageblocks')->__('Homepage Blocks Images')));
        $this->_addElementTypes($fieldset);

        $fieldset->addField('homepageblock3_image', 'image', array(
            'label' => Mage::helper('homepageblocks')->__('First block image holder'),
            'required' => false,
            'name' => 'homepageblock3_image',
        ));

        $fieldset->addField('homepageblock3_title', 'text', array(
            'label' => Mage::helper('homepageblocks')->__('First block image title'),
            'name' => 'homepageblock3_title',
        ));
        
        $fieldset->addField('homepageblock3_link_text', 'text', array(
            'label' => Mage::helper('homepageblocks')->__('First block image Text'),
            'name' => 'homepageblock3_link_text',
        ));

        $fieldset->addField('homepageblock3_link', 'text', array(
            'label' => Mage::helper('homepageblocks')->__('First block image link'),
            'class' => 'validate-url',
            'name' => 'homepageblock3_link',
        ));

        $fieldset->addField('homepageblock5_image', 'image', array(
            'label' => Mage::helper('homepageblocks')->__('Second block image image'),
            'required' => false,
            'name' => 'homepageblock5_image',
        ));
        
        $fieldset->addField('homepageblock5_title', 'text', array(
            'label' => Mage::helper('homepageblocks')->__('Second block image title'),
            'name' => 'homepageblock5_title',
        ));
        
        $fieldset->addField('homepageblock5_link_text', 'text', array(
            'label' => Mage::helper('homepageblocks')->__('Second block image text'),
            'name' => 'homepageblock5_link_text',
        ));

        $fieldset->addField('homepageblock5_link', 'text', array(
            'label' => Mage::helper('homepageblocks')->__('Second block image link'),
            'class' => 'validate-url',
            'name' => 'homepageblock5_link',
        ));

        $fieldset->addField('homepageblock6_image', 'image', array(
            'label' => Mage::helper('homepageblocks')->__('Third block image'),
            'required' => false,
            'name' => 'homepageblock6_image',
        ));

        $fieldset->addField('homepageblock6_title', 'text', array(
            'label' => Mage::helper('homepageblocks')->__('Third block image title'),
            'name' => 'homepageblock6_title',
        ));
        
        $fieldset->addField('homepageblock6_link_text', 'text', array(
            'label' => Mage::helper('homepageblocks')->__('Third block image text'),
            'name' => 'homepageblock6_link_text',
        ));

        $fieldset->addField('homepageblock6_link', 'text', array(
            'label' => Mage::helper('homepageblocks')->__('Third block image link'),
            'class' => 'validate-url',
            'name' => 'homepageblock6_link',
        ));

        $fieldset->addField('homepageblock7_image', 'image', array(
            'label' => Mage::helper('homepageblocks')->__('Fourth block image'),
            'required' => false,
            'name' => 'homepageblock7_image',
        ));
        $fieldset->addField('homepageblock7_title', 'text', array(
            'label' => Mage::helper('homepageblocks')->__('Fourth block image title'),
            'name' => 'homepageblock7_title',
        ));
        
        $fieldset->addField('homepageblock7_link_text', 'text', array(
            'label' => Mage::helper('homepageblocks')->__('Fourth block image text'),
            'name' => 'homepageblock7_link_text',
        ));
        $fieldset->addField('homepageblock7_link', 'text', array(
            'label' => Mage::helper('homepageblocks')->__('Fourth block image link'),
            'class' => 'validate-url',
            'name' => 'homepageblock7_link',
        ));
        
       
        $fieldset->addField('homepageblock8_link', 'text', array(
            'label' => Mage::helper('homepageblocks')->__('Homepage Product Showcase SKU'),
            'name' => 'homepageblock8_link',
        ));
        if ($splashGroup = Mage::registry('homepageblocks_data')) {
            $form->setValues($splashGroup->getData());
        }

        return parent::_prepareForm();
    }

}
