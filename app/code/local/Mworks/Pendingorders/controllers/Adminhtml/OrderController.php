<?php
class Mworks_Pendingorders_Adminhtml_OrderController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Sales'))->_title($this->__('Pending Orders'));
        $this->loadLayout();
        $this->_setActiveMenu('sales/sales');
        $this->_addContent($this->getLayout()->createBlock('mworks_pendingorders/adminhtml_sales_order'));
		
		//echo Mage::helper("adminhtml")->getUrl("/order/test");
		//echo Mage::helper("adminhtml")->getUrl("/order/test");
        
		$this->renderLayout();
    }
 
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('mworks_pendingorders/adminhtml_sales_order_grid')->toHtml()
        );
    }
 
    public function exportInchooCsvAction()
    {
        $fileName = 'orders_pending.csv';
        $grid = $this->getLayout()->createBlock('mworks_pendingorders/adminhtml_sales_order_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
    }
 
    public function exportInchooExcelAction()
    {
        $fileName = 'orders_pending.xml';
        $grid = $this->getLayout()->createBlock('mworks_pendingorders/adminhtml_sales_order_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }
	
	public function updateStatusAction()
    {
        $id = $this->getRequest()->getParam('id');
		$order = Mage::getModel("sales/order")->load($id);
		
		$responseArray = Mage::getModel('mworks_pendingorders/pendingorder')->getOrderDetailFromHDFCApi($order->getIncrementId());
		if (isset($responseArray['@attributes']['status']) && $responseArray['@attributes']['status'] === 'Processed') { 
			$order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true)->save();
			echo "success";
		} else {
			echo "failure";
		}
		
    }
	
	public function testAction()
	{
		/*$orderNumbers = '100000010'; // comma-delimited order numbers
		$collection = Mage::getModel('sales/order')->getCollection()
			->addFieldToFilter('increment_id', array('in' => $orderNumbers));
		foreach ($collection as $order) {
			$order->setState('pending')
				->setStatus('Pending')
				->save();
		}
		
		echo 'set to pending....';
		*/ 
		
		Mage::getModel('mworks_pendingorders/pendingorder')->getPreviousPendingOrders();
		
	}
	
}