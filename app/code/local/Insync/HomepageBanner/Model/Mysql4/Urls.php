<?php

class Insync_HomepageBanner_Model_Mysql4_Urls extends Mage_Core_Model_Mysql4_Abstract {
    public function _construct() {
        $this->_init('homepagebanner/urls','id');
    }

    public function loadByUrl($urls,$url) {
        $select = $this->_getReadAdapter()->select()
            ->from($this->getTable('homepagebanner/urls'))
            ->where('url=:current_url');

        if ($id = $this->_getReadAdapter()->fetchOne($select, array('current_url' => $url))) {
            $this->load($urls, $id);
        } else {
            $urls->setData(array());
        }
        return $this;
    }

}