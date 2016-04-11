<?php

/**
 * @category    22Feet
 * @package     Feet_HomepageBlocks
 * @author      Chanchal Sarkar <chanchal@22feet.in>
 */
class Feet_Homepageblocks_Block_Adminhtml_Homepageblocks_Helper_Image extends Varien_Data_Form_Element_Image {

    /**
     * Prepend the base image URL to the image filename
     *
     * @return null|string
     */
    protected function _getUrl() {
        if ($this->getValue() && !is_array($this->getValue())) {
            return Mage::helper('homepageblocks/image')->getImageUrl($this->getValue());
        }

        return null;
    }

}