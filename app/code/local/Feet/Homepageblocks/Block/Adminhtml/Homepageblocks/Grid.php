<?php
/**
 * @category    22Feet
 * @package     Feet_HomepageBlocks
 * @author      Chanchal Sarkar <chanchal@22feet.in>
 */

class Feet_Homepageblocks_Block_Adminhtml_Homepageblocks_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('homepageblocksGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('homepageblocks/homepageblocks')->getCollection();

        foreach($collection as $link){
            if($link->getStoreCode() && $link->getStoreCode() != 0 ){
                $link->setStoreCode(explode(',',$link->getStoreCode()));
            }                
            else{                    
                $link->setStoreCode(array('0'));                  
            }
        }
        
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    
    protected function _filterStoreCondition($collection, $column)
    {
        if ( !$value = $column->getFilter()->getValue() ) {
            return;
        }
        $this->getCollection()->addStoreFilter($value);
    }

    protected function _prepareColumns() {
        $this->addColumn('id', array(
            'header' => Mage::helper('homepageblocks')->__('ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'id',
        ));

        $this->addColumn('category_id', array(
            'header' => Mage::helper('homepageblocks')->__('Category / Home'),
            'align' => 'left',
            'index' => 'category_id',
        ));
        
        if ( !Mage::app()->isSingleStoreMode() ) {
            $this->addColumn('store_code', array(
                'header' => Mage::helper('homepageblocks')->__('Store View'),
                'index' => 'store_code',
                'type' => 'store',
                'store_all' => true,
                'store_view' => true,
                'sortable' => true,
                'filter_condition_callback' => array($this, '_filterStoreCondition'),
            ));
        }

        $this->addColumn('status', array(
            'header' => Mage::helper('homepageblocks')->__('Status'),
            'align' => 'left',
            'width' => '80px',
            'index' => 'status',
            'type' => 'options',
            'options' => array(
                1 => 'Enabled',
                2 => 'Disabled',
            ),
        ));

        $this->addColumn('action', array(
            'header' => Mage::helper('homepageblocks')->__('Action'),
            'width' => '100',
            'type' => 'action',
            'getter' => 'getId',
            'actions' => array(
                array(
                    'caption' => Mage::helper('homepageblocks')->__('Edit'),
                    'url' => array('base' => '*/*/edit'),
                    'field' => 'id'
                )
            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'stores',
            'is_system' => true,
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('homepageblocks')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('homepageblocks')->__('XML'));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction() {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('homepageblocks');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('homepageblocks')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('homepageblocks')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('homepageblocks/status')->getOptionArray();

        array_unshift($statuses, array('label' => '', 'value' => ''));
        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('homepageblocks')->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('homepageblocks')->__('Status'),
                    'values' => $statuses
                )
            )
        ));
        return $this;
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}