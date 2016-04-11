<?php

class Mapmygenomie_Career_Block_Adminhtml_Category_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    /**
     * Set defaults
     */
    public function __construct() {
        parent::__construct();
        $this->setId('mapmygenomie_career_CategoryGrid');
        $this->setDefaultSort('category_name');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare collection
     *
     * @return mapmygenomie_career_Block_Adminhtml_Category_Grid
     */
    protected function _prepareCollection() {
        $collection = Mage::getModel('mapmygenomie_career/category')->getCollection();       
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Prepare grid columns
     *
     * @return mapmygenomie_career_Block_Adminhtml_Category_Grid
     */
    protected function _prepareColumns() {
        $this->addColumn('category_id', array(
            'header' => Mage::helper('mapmygenomie_career')->__('ID'),
            'align' => 'left',
            'width' => '50px',
            'index' => 'category_id',
        ));

        $this->addColumn('category_name', array(
            'header' => Mage::helper('mapmygenomie_career')->__('Category Name'),
            'align' => 'left',
            'width' => '50px',
            'index' => 'category_name',
        ));

        $this->addColumn('category_status', array(
            'header' => Mage::helper('mapmygenomie_career')->__('Status'),
            'align' => 'left',
            'width' => '50px',
            'index' => 'category_status',
            'type' => 'options',
            'options' => Mage::getSingleton('mapmygenomie_career/position')->getStatusOptionArray(),
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}