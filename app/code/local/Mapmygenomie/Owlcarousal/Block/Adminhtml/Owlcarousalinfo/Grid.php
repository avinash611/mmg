<?php

class Mapmygenomie_Owlcarousal_Block_Adminhtml_Owlcarousalinfo_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('mapmygenomie_owlcarousal_OwlcarousalinfoGrid');
        $this->setDefaultSort('carousal_priority');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('mapmygenomie_owlcarousal/owlcarousalinfo')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {

        $this->addColumn('carousal_image', array(
            'header' => Mage::helper('mapmygenomie_owlcarousal')->__('Image'),
            'align' => 'center',
            'width' => '100px',
            'filter' => false,
            'sortable' => false,
            'renderer' => 'mapmygenomie_owlcarousal/adminhtml_widget_grid_renderer',
        ));

        $this->addColumn('carousal_headtitle', array(
            'header' => Mage::helper('mapmygenomie_owlcarousal')->__('Title'),
            'align' => 'left',
            'width' => '100px',
            'index' => 'carousal_headtitle',
        ));

        $this->addColumn('category_id', array(
            'header' => Mage::helper('mapmygenomie_owlcarousal')->__('Category'),
            'align' => 'left',
            'width' => '80px',
            'index' => 'category_id',
            'type' => 'options',
            'options' => Mage::getSingleton('mapmygenomie_owlcarousal/owlcarousalinfo')->getCarousalCategoryArray(),
        ));

        $this->addColumn('carousal_status', array(
            'header' => Mage::helper('mapmygenomie_owlcarousal')->__('Status'),
            'align' => 'left',
            'width' => '80px',
            'index' => 'carousal_status',
            'type' => 'options',
            'options' => Mage::getSingleton('mapmygenomie_owlcarousal/owlcarousalinfo')->getStatusOptionArray(),
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction() {
        $this->setMassactionIdField('owlcarousal_id');
        $this->getMassactionBlock()->setFormFieldName('mapmygenomie_owlcarousal');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('mapmygenomie_owlcarousal')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('mapmygenomie_owlcarousal')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('mapmygenomie_owlcarousal/owlcarousalinfo')->getStatusOptionArray();
        array_unshift($statuses, array('label' => '', 'value' => ''));
        $this->getMassactionBlock()->addItem('carousal_status', array(
            'label' => Mage::helper('mapmygenomie_owlcarousal')->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'carousal_status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('mapmygenomie_owlcarousal')->__('Status'),
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
