<?php


class Mapmygenomie_Career_Model_Resource_Position_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    /**
     * Intialize collection
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('mapmygenomie_career/position');
    }

    /**
     * Instantiate select object
     *
     */
    protected function _initSelect()
    {
        $this->getSelect()->from(array('main_table' => $this->getResource()->getMainTable()));
        return $this;
    }
    
	/**
	 * function to add the collection which are enabled for now
     *
	 * @return Mapmygenomie_Career_Model_Mysql4_Category_Collection
	 * */
	public function addStatusFilter() {
		$this->addFieldToFilter('position_status', Mapmygenomie_Career_Model_Category::STATUS_ENABLED);
		return $this;
	}
	/**
	 * function to add the collection which are filteres by category
     *
	 * @return Mapmygenomie_Career_Model_Mysql4_Category_Collection
	 * */
	public function addCategoryFilter($categoryId) {
		$this->addFieldToFilter('category_id', $categoryId);
		return $this;
	}

}