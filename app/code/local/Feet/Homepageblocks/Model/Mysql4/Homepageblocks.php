<?php
/**
 * @category    22Feet
 * @package     Feet_HomepageBlocks
 * @author      Chanchal Sarkar <chanchal@22feet.in>
 */
class Feet_Homepageblocks_Model_Mysql4_Homepageblocks extends Mage_Core_Model_Mysql4_Abstract {

    public function _construct() {
        // Note that the id refers to the key field in your database table.
        $this->_init('homepageblocks/homepageblocks', 'id');
    }

}