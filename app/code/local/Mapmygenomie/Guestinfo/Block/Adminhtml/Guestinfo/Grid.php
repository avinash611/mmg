<?php

/**
 * @category    22Feet
 * @package     GuestInfo
 * @author      Binu  <binuconcept@gmail.com,9986442330>
 */
class Mapmygenomie_Guestinfo_Block_Adminhtml_Guestinfo_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('mailguestsGrid');
        $this->setUseAjax(true);
        $this->setDefaultSort('parent_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {
        $prefix = Mage::getConfig()->getTablePrefix();

        $collection = Mage::getModel('mapmygenomie_guestinfo/guestinfo')->getCollection();
        $collection->getSelect()->joinLeft($prefix . 'sales_flat_order_address', $prefix . 'sales_flat_order_address.parent_id = main_table.entity_id AND ' . $prefix . 'sales_flat_order_address.address_type = "shipping"', array('region', 'region', 'postcode', 'street', 'city', 'telephone', 'parent_id', 'country_id'));

        $collection->getSelect()->where('main_table.customer_id IS NULL');

        //$collection->getSelect()->group('main_table.customer_email');

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {

        parent::_prepareColumns();

        $this->addColumn('parent_id', array(
            'header' => Mage::helper('mapmygenomie_guestinfo')->__('ID'),
            'align' => 'center',
            'width' => '20px',
            'index' => 'parent_id',
            'type' => 'number',
        ));

        $this->addColumn('customer_email', array(
            'header' => Mage::helper('mapmygenomie_guestinfo')->__('Customer Email'),
            'align' => 'left',
            'index' => 'customer_email',
        ));

        $this->addColumn('customer_firstname', array(
            'header' => Mage::helper('mapmygenomie_guestinfo')->__('Customer Firstname'),
            'align' => 'left',
            //'width'     => '200px',
            'index' => 'customer_firstname',
        ));

        $this->addColumn('customer_lastname', array(
            'header' => Mage::helper('mapmygenomie_guestinfo')->__('Customer Lastname'),
            'align' => 'left',
            //'width'     => '200px',
            'index' => 'customer_lastname',
        ));

        $this->addColumn('region', array(
            'header' => Mage::helper('mapmygenomie_guestinfo')->__('Region'),
            'align' => 'left',
            'width' => '200px',
            'index' => 'region',
        ));

        $this->addColumn('country_id', array(
            'header' => Mage::helper('mapmygenomie_guestinfo')->__('Country code'),
            'align' => 'left',
            'width' => '50px',
            'index' => 'country_id',
        ));
        $this->addColumn('postcode', array(
            'header' => Mage::helper('mapmygenomie_guestinfo')->__('Postcode'),
            'align' => 'left',
            'width' => '50px',
            'index' => 'postcode',
        ));


        $this->addColumn('street', array(
            'header' => Mage::helper('mapmygenomie_guestinfo')->__('Street'),
            'align' => 'left',
            'width' => '200px',
            'index' => 'street',
        ));


        $this->addColumn('city', array(
            'header' => Mage::helper('mapmygenomie_guestinfo')->__('City'),
            'align' => 'left',
            'width' => '200px',
            'index' => 'city',
        ));

        $this->addColumn('telephone', array(
            'header' => Mage::helper('mapmygenomie_guestinfo')->__('Telephone'),
            'align' => 'left',
            'width' => '50px',
            'index' => 'telephone',
        ));

        $this->addColumn('created_at', array(
            'header' => Mage::helper('mapmygenomie_guestinfo')->__('Created'),
            'align' => 'left',
            'width' => '300px',
            'index' => 'created_at',
            'type' => 'datetime',
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('mapmygenomie_guestinfo')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('mapmygenomie_guestinfo')->__('Excel XML'));

        return parent::_prepareColumns();
    }

    public function getGridUrl() {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }

    public function getRowUrl($row) {
        return '';
    }

}
