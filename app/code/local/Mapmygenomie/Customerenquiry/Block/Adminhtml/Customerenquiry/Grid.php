<?php

class Mapmygenomie_Customerenquiry_Block_Adminhtml_Customerenquiry_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('customerenquiryGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('mapmygenomie_customerenquiry/customerenquiry')->getCollection();

        $collection->getSelect()->join(
                'customer_entity', 'main_table.customer_id = customer_entity.entity_id', array('email' => 'email'));

        $fn = Mage::getModel('eav/entity_attribute')->loadByCode('1', 'firstname');
        $ln = Mage::getModel('eav/entity_attribute')->loadByCode('1', 'lastname');
        $collection->getSelect()
                ->join(array('ce1' => 'customer_entity_varchar'), 'ce1.entity_id=main_table.customer_id', array('firstname' => 'value'))
                ->where('ce1.attribute_id=' . $fn->getAttributeId())
                ->join(array('ce2' => 'customer_entity_varchar'), 'ce2.entity_id=main_table.customer_id', array('lastname' => 'value'))
                ->where('ce2.attribute_id=' . $ln->getAttributeId())
                ->columns(new Zend_Db_Expr("CONCAT(`ce1`.`value`, ' ',`ce2`.`value`) AS customer_name"));

        /* $customerEntityTableAlias = 'c_e';
          $adminUserTableAlias = 'a_u';
          $collection->join(
          array($customerEntityTableAlias => 'customer/entity'),
          'customer_id=c_e.entity_id'
          );
          $collection->join(
          array($adminUserTableAlias => 'admin/user'),
          'doctor_id=a_u.user_id'
          ); */
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('id', array(
            'header' => 'ID',
            'align' => 'right',
            'width' => '50px',
            'index' => 'id',
        ));

        $this->addColumn('customer_name', array(
            'header' => $this->__('Customer Name'),
            'index' => 'customer_name',
            'filter_name' => 'customer_name'
        ));

        $this->addColumn('email', array(
            'header' => $this->__('Customer Email'),
            'index' => 'email',
            'filter_name' => 'email'
        ));

        $this->addColumn('customer_comment', array(
            'header' => $this->__('Customer Comment'),
            'align' => 'left',
            'index' => 'customer_comment',
        ));

        $this->addColumn('customer_report', array(
            'header' => $this->__('Customer Data'),
            'align' => 'center',
            'index' => 'customer_report',
            'width' => 50,
            'type' => 'text',
            'renderer' => 'Mapmygenomie_Customerenquiry_Block_Adminhtml_Customerenquiry_Renderer_HrefRenderer'
        ));


        $this->addColumn('doctor_comment', array(
            'header' => $this->__('Doctor Comment'),
            'align' => 'left',
            'index' => 'doctor_comment',
        ));

        $this->addColumn('doctor_report', array(
            'header' => $this->__('Doctor Report'),
            'align' => 'center',
            'index' => 'doctor_report',
            'width' => 50,
            'type' => 'text',
            'renderer' => 'Mapmygenomie_Customerenquiry_Block_Adminhtml_Customerenquiry_Renderer_HrefRenderer'
        ));
       
        return parent::_prepareColumns();
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}
