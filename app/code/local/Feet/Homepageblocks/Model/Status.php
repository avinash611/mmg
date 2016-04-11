<?php
/**
 * @category    22Feet
 * @package     Feet_HomepageBlocks
 * @author      Chanchal Sarkar <chanchal@22feet.in>
 */
class Feet_Homepageblocks_Model_Status extends Varien_Object {

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    static public function getOptionArray() {
        return array(
            self::STATUS_ENABLED => Mage::helper('homepageblocks')->__('Enabled'),
            self::STATUS_DISABLED => Mage::helper('homepageblocks')->__('Disabled')
        );
    }

}