<?php
class Insync_HomepageBanner_Block_Adminhtml_Banner extends Mage_Adminhtml_Block_Widget_Grid_Container {

	public function __construct() {
		$this->_controller = 'adminhtml_banner';
		$this->_blockGroup = 'homepagebanner';
		$this->_headerText = Mage::helper('homepagebanner')->__('Banner Manager');
		$this->_addButtonLabel = Mage::helper('homepagebanner')->__('Add Banner');
		parent::__construct();
	}
	
}