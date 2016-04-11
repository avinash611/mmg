<?php
/**
 * @category    22Feet
 * @package     Feet_HomepageBlocks
 * @author      Chanchal Sarkar <chanchal@22feet.in>
 */
class Feet_Homepageblocks_Block_Homepageblocks extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getHomepageblocks()     
     { 
        if (!$this->hasData('homepageblocks')) {
            $this->setData('homepageblocks', Mage::registry('homepageblocks'));
        }
        return $this->getData('homepageblocks');
        
    }
}