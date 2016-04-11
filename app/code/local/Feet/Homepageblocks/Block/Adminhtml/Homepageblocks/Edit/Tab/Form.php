<?php

/**
 * @category    22Feet
 * @package     Feet_HomepageBlocks
 * @author      Chanchal Sarkar <chanchal@22feet.in>
 */
class Feet_Homepageblocks_Block_Adminhtml_Homepageblocks_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('homepageblocks_form', array('legend' => Mage::helper('homepageblocks')->__('Homepage Blocks')));

        if (Mage::getSingleton('adminhtml/session')->getHomepageblocksData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getHomepageblocksData());
            Mage::getSingleton('adminhtml/session')->setHomepageblocksData(null);
        } elseif (Mage::registry('homepageblocks_data')) {
            $form->setValues(Mage::registry('homepageblocks_data')->getData());
        }


        return parent::_prepareForm();
    }

}
