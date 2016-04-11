<?php
class Mworks_Pendingorders_Block_Adminhtml_Sales_Order extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'mworks_pendingorders';
        $this->_controller = 'adminhtml_sales_order';
        $this->_headerText = Mage::helper('mworks_pendingorders')->__('Pending Orders');
 
        parent::__construct();
        $this->_removeButton('add');
    }
}