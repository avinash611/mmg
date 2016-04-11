<?php

class Mapmygenomie_Career_Block_Adminhtml_Category_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected $_objectId = 'id';
    protected $_blockGroup = 'mapmygenomie_career';
    protected $_controller = 'adminhtml_category';

    /**
     * Retrive Career Category model
     *
     * @return mapmygenomie_career_Model_Category
     */
    public function getModel()
    {
        return Mage::registry('mapmygenomie_career_category_data');
    }

    protected function _prepareLayout()
    {    
        $this->_addButton('save_and_continue', array(
            'label'     => Mage::helper('mapmygenomie_career')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class' => 'save'
        ), 10);
        $this->_formScripts[] = " function saveAndContinueEdit(){ editForm.submit($('edit_form').action + 'back/edit/') } ";        

        parent::_prepareLayout();
        return $this;
    }


    /**
     * Get header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('mapmygenomie_career_category_data')->getId()) {
            return Mage::helper('mapmygenomie_career')->__('Edit Category');
        } else {
            return Mage::helper('mapmygenomie_career')->__('New Category');
        }
    }
}