<?php
 
class Mworks_Pendingorders_Block_Adminhtml_Sales_Order_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('pending_order_grid');
        $this->setDefaultSort('increment_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
 
    protected function _prepareCollection()
    {
		$time = time();
		$to = date('Y-m-d H:i:s', $time);
		$lastTime = $time - 86400; // 60*60*24
		$from = date('Y-m-d H:i:s', $lastTime);

        $collection = Mage::getResourceModel('sales/order_collection')
			//->addAttributeToFilter('created_at', array('from' => $from, 'to' => $to))
			->addFieldToFilter('status', 'pending')
            ->join(array('a' => 'sales/order_address'), 'main_table.entity_id = a.parent_id AND a.address_type != \'billing\'', array(
                'city'       => 'city',
                'country_id' => 'country_id'
            ))
            ->join(array('c' => 'customer/customer_group'), 'main_table.customer_group_id = c.customer_group_id', array(
                'customer_group_code' => 'customer_group_code'
            ))
            ->addExpressionFieldToSelect(
                'fullname',
                'CONCAT({{customer_firstname}}, \' \', {{customer_lastname}})',
                array('customer_firstname' => 'main_table.customer_firstname', 'customer_lastname' => 'main_table.customer_lastname'))
            ->addExpressionFieldToSelect(
                'products',
                '(SELECT GROUP_CONCAT(\' \', x.name)
                    FROM sales_flat_order_item x
                    WHERE {{entity_id}} = x.order_id
                        AND x.product_type != \'configurable\')',
                array('entity_id' => 'main_table.entity_id')
            )
        ;
 
        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }
 
    protected function _prepareColumns()
    {
        $helper = Mage::helper('mworks_pendingorders');
        $currency = (string) Mage::getStoreConfig(Mage_Directory_Model_Currency::XML_PATH_CURRENCY_BASE);
 
        $this->addColumn('increment_id', array(
            'header' => $helper->__('Order #'),
            'index'  => 'increment_id'
        ));
 
        $this->addColumn('purchased_on', array(
            'header' => $helper->__('Purchased On'),
            'type'   => 'datetime',
            'index'  => 'created_at',
			/*'filter'    => false,*/
			'sortable'  => true
        ));
 
        $this->addColumn('products', array(
            'header'       => $helper->__('Products Purchased'),
            'index'        => 'products',
            'filter_index' => '(SELECT GROUP_CONCAT(\' \', x.name) FROM sales_flat_order_item x WHERE main_table.entity_id = x.order_id AND x.product_type != \'configurable\')'
        ));
 
        $this->addColumn('fullname', array(
            'header'       => $helper->__('Name'),
            'index'        => 'fullname',
            'filter_index' => 'CONCAT(customer_firstname, \' \', customer_lastname)'
        ));
 
        $this->addColumn('city', array(
            'header' => $helper->__('City'),
            'index'  => 'city'
        ));
 
        $this->addColumn('country', array(
            'header'   => $helper->__('Country'),
            'index'    => 'country_id',
            'renderer' => 'adminhtml/widget_grid_column_renderer_country'
        ));
 
        $this->addColumn('customer_group', array(
            'header' => $helper->__('Customer Group'),
            'index'  => 'customer_group_code'
        ));
 
        $this->addColumn('grand_total', array(
            'header'        => $helper->__('Grand Total'),
            'index'         => 'grand_total',
            'type'          => 'currency',
            'currency_code' => $currency
        ));
 
        $this->addColumn('shipping_method', array(
            'header' => $helper->__('Shipping Method'),
            'index'  => 'shipping_description'
        ));
 
        $this->addColumn('order_status', array(
            'header'  => $helper->__('Status'),
            'index'   => 'status',
            'type'    => 'options',
            'options' => Mage::getSingleton('sales/order_config')->getStatuses(),
			'filter'    => false,
			'sortable'  => false
        ));
		
		$this->addColumn('update_status',
		array(
			'header'=> $helper->__('Update Status'),
			'index' => 'update_status',
			'renderer'  => 'Mworks_Pendingorders_Block_Adminhtml_Sales_Renderer_Status',
			'filter'    => false,
			'sortable'  => false
		));
 
        $this->addExportType('*/*/exportInchooCsv', $helper->__('CSV'));
        $this->addExportType('*/*/exportInchooExcel', $helper->__('Excel XML'));
 
        return parent::_prepareColumns();
    }
 
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }
}