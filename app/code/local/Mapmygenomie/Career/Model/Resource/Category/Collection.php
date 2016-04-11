<?php

class Mapmygenomie_Career_Model_Resource_Category_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {

    /**
     * Intialize collection
     *
     * @return void
     */
    protected function _construct() {
        $this->_init('mapmygenomie_career/category');
    }

    /**
     * Instantiate select object
     *
     */
    protected function _initSelect() {
        $this->getSelect()->from(array('main_table' => $this->getResource()->getMainTable()));
        return $this;
    }

    public function toOptionHash() {
        return parent::_toOptionHash('category_id', 'category_name');
    }

    /**
     * function to add the collection which are enabled for now
     *
     * @return Mapmygenomie_Career_Model_Mysql4_Category_Collection
     * */
    public function addStatusFilter() {
        $this->addFieldToFilter('category_status', Mapmygenomie_Career_Model_Category::STATUS_ENABLED);
        return $this;
    }

    /**
     * function to add position count to the collection
     *
     * */
    public function addPositionCount() {
        if (!$this->getFlag('position_count_done')) {
            $this->getSelect()->join(
                    array('career_position' => $this->getTable('mapmygenomie_career/position')), $this->getConnection()->quoteInto('main_table.category_id=career_position.category_id'), array('position_count' => 'SUM(career_position.position_count)')
            );
            $this->getSelect()->group('main_table.category_id');
            $this->setFlag('position_count_done', true);
        }
        return $this;
    }

}