<?php
class Insync_HomepageBanner_Block_Adminhtml_Banner_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {
	protected function _prepareForm() {
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset('homepagebanner_form', array('legend'=>Mage::helper('homepagebanner')->__('Banner information')));
		
		$fieldset->addField('name', 'text', array(
			'label'     => Mage::helper('homepagebanner')->__('Title'),
			'class'     => 'required-entry',
			'required'  => true,
			'name'      => 'name',
		));
		
		$fieldset->addField('url', 'text', array(
			'label'     => Mage::helper('homepagebanner')->__('Url'),
			'class'     => 'required-entry',
			'required'  => true,
			'name'      => 'url',
			//'note'		=> '<strong>&lt;url&gt; :</strong> '.Mage::helper('homepagebanner')->__('Current page URL').' <br /> <strong>&lt;title&gt; :</strong> '.Mage::helper('homepagebanner')->__('Current page Meta Title').' <br /> <strong>&lt;bitly&gt; :</strong> '.Mage::helper('homepagebanner')->__('Current page Short URL (http://bit.ly)').''
		));
		
		$fieldset->addField('image', 'image', array(
			'label'     => Mage::helper('homepagebanner')->__('Image'),
			'required'  => false,
			'name'      => 'bookmarkimage',
		));
		
		$fieldset->addField('position', 'text', array(
			'label'     => Mage::helper('homepagebanner')->__('Position'),
			'required'  => false,
			'name'      => 'position',
		));
		
		$fieldset->addField('target', 'select', array(
			'label'     => Mage::helper('homepagebanner')->__('Open in new window'),
			'name'      => 'target',
			'values'	=> array(
				array(
					'value' => 1,
					'label'     => Mage::helper('homepagebanner')->__('Yes'),
				),
				
				array(
					'value' => 2,
					'label'     => Mage::helper('homepagebanner')->__('No'),
				),
			),
		));
		
		$fieldset->addField('status', 'select', array(
			'label'     => Mage::helper('homepagebanner')->__('Status'),
			'name'      => 'status',
			'values'    => array(
			  array(
				  'value'     => 1,
				  'label'     => Mage::helper('homepagebanner')->__('Enabled'),
			  ),
			
			  array(
				  'value'     => 2,
				  'label'     => Mage::helper('homepagebanner')->__('Disabled'),
			  ),
			),
		));
		$fieldset->addField('homepagebanner_text', 'text', array(
			'label'     => Mage::helper('homepagebanner')->__('Title'),
			'class'     => 'required-entry',
			'required'  => true,
			'name'      => 'homepagebanner_text',
		));
		$fieldset->addField('homepagebanner_text1', 'text', array(
			'label'     => Mage::helper('homepagebanner')->__('Title Second'),
			'class'     => 'required-entry',
			'required'  => true,
			'name'      => 'homepagebanner_text1',
		));
		$fieldset->addField('homepagebanner_text2', 'text', array(
			'label'     => Mage::helper('homepagebanner')->__('Title third'),
			'class'     => 'required-entry',
			'required'  => true,
			'name'      => 'homepagebanner_text2',
		));
		
		if ( Mage::getSingleton('adminhtml/session')->getHomepageBannerData() ) {
			$form->setValues(Mage::getSingleton('adminhtml/session')->getHomepageBannerData());
			Mage::getSingleton('adminhtml/session')->setHomepageBannerData(null);
		} elseif ( Mage::registry('homepagebanner_data') ) {
			$form->setValues(Mage::registry('homepagebanner_data')->getData());
		}
		return parent::_prepareForm();
	}

}