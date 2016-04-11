<?php

/**
 * @category    22Feet
 * @package     VideoGallery
 * @author      Binu  <binuconcept@gmail.com,9986442330>
 */
class Mapmygenomie_Videogallery_Block_Adminhtml_Videogallery_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('videogalleryGrid');
        // This is the primary key of the database
        $this->setDefaultSort('videogallery_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {

        $collection = Mage::getModel('mapmygenomie_videogallery/videogallery')->getCollection();
        $session = Mage::getSingleton('adminhtml/session');
        if ($this->getRequest()->getParam('dir'))
            $dir = $this->getRequest()->getParam('dir');
        else
            $dir = (($videogalleryGrid = $session->getData('videogalleryGrid')) ? $videogalleryGrid : 'DESC');

        if ($session->getData('videogalleryGridsort'))
            $videogalleryGridsort = $session->getData('videogalleryGridsort');
        else
            $videogalleryGridsort = 'videogallery_id';

        if ($sort = $this->getRequest()->getParam('sort'))
            $collection->getSelect()->order("$sort $dir");
        else
            $collection->getSelect()->order("$videogalleryGridsort $dir");

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('videogallery_id', array(
            'header' => Mage::helper('mapmygenomie_videogallery')->__('ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'videogallery_id',
            'filter_index' => 'videogallery_id',
            'type' => 'number',
            'sortable' => true
        ));
        $this->addColumn('video_name', array(
            'header' => Mage::helper('mapmygenomie_videogallery')->__('Name'),
            'align' => 'left',
            'index' => 'video_name',
            'filter_index' => 'video_name',
            'sortable' => true
        ));

        $this->addColumn('video_image', array(
            'header' => Mage::helper('mapmygenomie_videogallery')->__('Image'),
            'align' => 'left',
            'index' => 'video_image',
            'type' => 'image',
            'filter_index' => 'video_image',
            'width' => '75px',
            'height' => '75px',
            'filter' => false,
            'sortable' => false,
            'renderer' => 'mapmygenomie_videogallery/renderer_image',
        ));

        $this->addColumn('isexternal_video', array(
            'header' => Mage::helper('mapmygenomie_videogallery')->__('External Video'),
            'align' => 'left',
            'index' => 'isexternal_video',
            'type' => 'options',
            'sortable' => true,
            'options' => Mage::getSingleton('mapmygenomie_videogallery/videogallery')->getVideoOptionArray(),
        ));

        $this->addColumn('video_status', array(
            'header' => Mage::helper('mapmygenomie_videogallery')->__('Status'),
            'align' => 'left',
            'index' => 'video_status',
            'type' => 'options',
            'sortable' => true,
            'options' => Mage::getSingleton('mapmygenomie_videogallery/videogallery')->getStatusOptionArray(),
        ));

        $this->addColumn('video_priority', array(
            'header' => Mage::helper('mapmygenomie_videogallery')->__('Priority'),
            'align' => 'left',
            'index' => 'video_priority',
            'filter_index' => 'video_priority',
            'sortable' => true
        ));

        $this->addColumn('action', array(
            'header' => Mage::helper('mapmygenomie_videogallery')->__('Action'),
            'width' => '100',
            'type' => 'action',
            'getter' => 'getId',
            'actions' => array(
                array(
                    'caption' => Mage::helper('mapmygenomie_videogallery')->__('Delete'),
                    'url' => array('base' => '*/*/delete'),
                    'field' => 'videogallery_id',
                    'confirm' => Mage::helper('mapmygenomie_videogallery')->__('Are you sure?')
                )
            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'stores',
            'is_system' => true,
        ));
        $this->addExportType('*/*/exportCsv', Mage::helper('mapmygenomie_videogallery')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('mapmygenomie_videogallery')->__('XML'));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction() {
        $this->setMassactionIdField('videogallery_id');
        $this->getMassactionBlock()->setFormFieldName('videogallery');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('mapmygenomie_videogallery')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('mapmygenomie_videogallery')->__('Are you sure?')
        ));
        return $this;
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}
