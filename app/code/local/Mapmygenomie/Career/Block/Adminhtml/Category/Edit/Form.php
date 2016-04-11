<?php

class Mapmygenomie_Career_Block_Adminhtml_Category_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    public function getCurrentModel()
    {
        return Mage::registry('mapmygenomie_career_category_data');
    }
    
    protected function _prepareForm()
    {
    	$model = $this->getCurrentModel();

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array('_current' => true)),
            'method' => 'post',
            'enctype'=> 'multipart/form-data'
        ));
        $form->setHtmlIdPrefix('carrer_category_edit_');

        $fieldset = $form->addFieldset('general_fieldset',
            array(
                'legend' => Mage::helper('mapmygenomie_career')->__('Category Information'),
                'class'  => 'fieldset-wide'
            )
        );

        $this->_addElementTypes($fieldset);
        
        $fieldset->addField('category_name', 'text', 
			array(
	          'label'     => Mage::helper('mapmygenomie_career')->__('Category Name'),
	          'name'      => 'category_name',
			  'required'  => true,
	      	)
		);		
		
       $fieldset->addField('category_status', 'select', array(
            'name'      => 'category_status',
            'label'     => Mage::helper('mapmygenomie_career')->__('Status'),
            'title'     => Mage::helper('mapmygenomie_career')->__('Status'),
            'options'   => Mage::getSingleton('mapmygenomie_career/category')->getStatusOptionArray()

        ));
		
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}