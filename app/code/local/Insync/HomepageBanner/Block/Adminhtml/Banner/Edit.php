<?php

class Insync_HomepageBanner_Block_Adminhtml_Banner_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

	public function __construct() {
		parent::__construct();
				 
		$this->_objectId = 'id';
		$this->_blockGroup = 'homepagebanner';
		$this->_controller = 'adminhtml_banner';
		
		$this->_updateButton('save', 'label', Mage::helper('homepagebanner')->__('Save'));
		$this->_updateButton('delete', 'label', Mage::helper('homepagebanner')->__('Delete'));
	}

	public function getHeaderText() {
		if( Mage::registry('homepagebanner_data') && Mage::registry('homepagebanner_data')->getId() ) {
			return Mage::helper('homepagebanner')->__("Edit Banner '%s'", $this->htmlEscape(Mage::registry('homepagebanner_data')->getName()));
		} else {
			return Mage::helper('homepagebanner')->__('Add Banner');
		}
	}
}