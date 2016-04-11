<?php


class Insync_HomepageBanner_Model_Mysql4_Banner extends Mage_Core_Model_Mysql4_Abstract {
    public function _construct() {
        $this->_init('homepagebanner/banner', 'bookmark_id');
    }
}