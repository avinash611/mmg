<?php
class Mapmygenomie_Compare_Model_Resource_Hashcode extends Mage_Core_Model_Resource_Db_Abstract {
    /**
     * constructor
     */
    protected function _construct() {
        $this->_init('mapmygenomie_compare/hashcode', 'entity_id');
    }

    /**
     * @param $values
     * @return int
     */
    public function insertValues($values) {
        return $this->_getWriteAdapter()->insertOnDuplicate($this->getMainTable(), $values);
    }

    /**
     * @param $values
     * @return int
     */
    public function deleteValues($values) {
        if (count($values)) {
            return $this->_getWriteAdapter()->delete($this->getMainTable(), array(' option_id IN (?)'=>implode(',', $values)));
        }
    }
}