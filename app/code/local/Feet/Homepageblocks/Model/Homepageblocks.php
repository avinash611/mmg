<?php
/**
 * @category    22Feet
 * @package     Feet_HomepageBlocks
 * @author      Chanchal Sarkar <chanchal@22feet.in>
 */
class Feet_Homepageblocks_Model_Homepageblocks extends Mage_Core_Model_Abstract {

    public function _construct() {
        parent::_construct();
        $this->_init('homepageblocks/homepageblocks');
    }

}