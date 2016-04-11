<?php

class Insync_HomepageBanner_Block_Banner 
	extends Mage_Core_Block_Template 
	implements Mage_Widget_Block_Interface 
{
	
	protected $_serializer=null;
	
	protected function _construct()
	{
		$this->_serializer = new Varien_Object();
        parent::_construct();
	}
	
	
	protected function _toHtml()
    {
		$collection = Mage::getModel('homepagebanner/banner')->getCollection()
		->addFieldToFilter('status',1)
		->setOrder('position', 'asc');
		
		$this->assign('list', $collection);
		return parent::_toHtml();
	}
}
