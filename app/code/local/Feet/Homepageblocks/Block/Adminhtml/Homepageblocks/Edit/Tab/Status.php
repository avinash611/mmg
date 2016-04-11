<?php

/**
 * @category    22Feet
 * @package     Feet_HomepageBlocks
 * @author      Chanchal Sarkar <chanchal@22feet.in>
 */
class Feet_Homepageblocks_Block_Adminhtml_Homepageblocks_Edit_Tab_Status extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('homepageblocks_status', array('legend' => Mage::helper('homepageblocks')->__('Homepage Blocks Images')));

        if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_code', 'multiselect', array(
                'name'      => 'stores[]',
                'label'     => Mage::helper('cms')->__('Store View'),
                'title'     => Mage::helper('cms')->__('Store View'),
                'required'  => true,
                'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
            ));
        }
        else {
            $fieldset->addField('store_code', 'hidden', array(
                'name'      => 'stores[]',
                'value'     => Mage::app()->getStore(true)->getId()
            ));
            //$model->setStoreId(Mage::app()->getStore()->getId());
        }
        
        $fieldset->addField('status', 'select', array(
            'name' => 'status',
            'title' => $this->__('Enabled'),
            'label' => $this->__('Enabled'),
            'required' => true,
            'values' => Mage::getModel('adminhtml/system_config_source_yesno')->toOptionArray(),
        ));
        

        if ($splashGroup = Mage::registry('homepageblocks_data')) {
            $form->setValues($splashGroup->getData());
        }

        return parent::_prepareForm();
    }

}
