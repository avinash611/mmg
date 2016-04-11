<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category   Mage
 * @package    Mage_Hdfc
 * @copyright  Copyright (c) 2008 Irubin Consulting Inc. DBA Varien (http://www.varien.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Hdfc Standard Front Controller
 *
 * @category   Mage
 * @package    Mage_Hdfc
 * @name       Mage_Hdfc_StandardController
 * @author     Magento Core Team <core@magentocommerce.com>
*/

class Mage_Hdfc_StandardController extends Mage_Core_Controller_Front_Action
{
    /**
     * Order instance
     */
    protected $_order;

    /**
     *  Return debug flag
     *
     *  @return  boolean
     */
    public function getDebug ()
    {
        return Mage::getSingleton('hdfc/config')->getDebug();
    }

    /**
     *  Get order
     *
     *  @param    none
     *  @return	  Mage_Sales_Model_Order
     */
    public function getOrder ()
    {
        if ($this->_order == null) {
            $session = Mage::getSingleton('checkout/session');
            $this->_order = Mage::getModel('sales/order');
            $this->_order->loadByIncrementId($session->getLastRealOrderId());
        }
        return $this->_order;
    }

    /**
     * When a customer chooses Hdfc on Checkout/Payment page
     *
     */
    public function redirectAction()
    {
        $session = Mage::getSingleton('checkout/session');
        $session->setHdfcStandardQuoteId($session->getQuoteId());

        $order = $this->getOrder();

        if (!$order->getId()) {
            $this->norouteAction();
            return;
        }

        $order->addStatusToHistory(
            $order->getStatus(),
            Mage::helper('hdfc')->__('Customer was redirected to Hdfc')
        );
        $order->save();

        $this->getResponse()
            ->setBody($this->getLayout()
                ->createBlock('hdfc/standard_redirect')
                ->setOrder($order)
                ->toHtml());

        $session->unsQuoteId();
    }

    /**
     *  Success response from Secure Hdfc
     *
     *  @return	  void
     */
    public function  successAction()
    {
    	$secret_key = Mage::getSingleton('hdfc/config')->getSecretKey(); // Your Secret Key
    	$hashType = Mage::getSingleton('hdfc/config')->getHashType(); // Your Secret Key
    	$params = $secret_key;
    	$response = $_POST;    	
    	$secureHash = $response['SecureHash'];		
    	
		unset($response['SecureHash']);
		ksort($response);
		foreach ($response as $key => $value){
			if (strlen($value) > 0) {
				$params .= '|'.$value;
			}
		}	
			
		if (strlen($params) > 0) {
			if($hashType == "SHA512")
				$hashValue = strtoupper(hash('SHA512',$params));	
			if($hashType == "SHA1")
				$hashValue = strtoupper(sha1($params));	
            if($hashType == "md5")
				$hashValue = strtoupper(md5($params));
		}		
		$hashValid = ($hashValue == $secureHash) ? true : false;
    		
    	if($response['ResponseCode'] == 0 && $hashValid) {
    		$session = Mage::getSingleton('checkout/session');
    		$session->setQuoteId($session->getHdfcStandardQuoteId());
    		$session->unsHdfcStandardQuoteId();

    		$order = $this->getOrder();
    		$order->setStatus('processing');

    		if (!$order->getId()) {
    			$this->norouteAction();
    			return;
    		}

    		$order->addStatusToHistory(
	    		$order->getStatus(),
	    		Mage::helper('hdfc')->__('Customer successfully returned from Hdfc')
    		);

    		$order->save();
    		$order->sendNewOrderEmail();
    		$this->_redirect('checkout/onepage/success');
    	}
    	else
    	{
    		$this->_redirect('hdfc/standard/failure');
    	}
    }
   
    /**
     *  Notification Action from Secure Hdfc
     *
     *  @param    none
     *  @return	  void
     */
    public function notifyAction ()
    {
        $postData = $this->getRequest()->getPost();

        if (!count($postData)) {
            $this->norouteAction();
            return;
        }

        if ($this->getDebug()) {
            $debug = Mage::getModel('hdfc/api_debug');
            if (isset($postData['cs2']) && $postData['cs2'] > 0) {
                $debug->setId($postData['cs2']);
            }
            $debug->setResponseBody(print_r($postData,1))->save();
        }

        $order = Mage::getModel('sales/order');
        $order->loadByIncrementId(Mage::helper('core')->decrypt($postData['cs1']));
        if ($order->getId()) {
            $result = $order->getPayment()->getMethodInstance()->setOrder($order)->validateResponse($postData);

            if ($result instanceof Exception) {
                if ($order->getId()) {
                    $order->addStatusToHistory(
                        $order->getStatus(),
                        $result->getMessage()
                    );
                    $order->cancel();
                }
                Mage::throwException($result->getMessage());
                return;
            }

            $order->sendNewOrderEmail();

            $order->getPayment()->getMethodInstance()->setTransactionId($postData['transaction_id']);

            if ($this->saveInvoice($order)) {
                $order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true);
            }
            $order->save();
        }
    }

    /**
     *  Save invoice for order
     *
     *  @param    Mage_Sales_Model_Order $order
     *  @return	  boolean Can save invoice or not
     */
    protected function saveInvoice (Mage_Sales_Model_Order $order)
    {
        if ($order->canInvoice()) {
            $invoice = $order->prepareInvoice();
            $invoice->register()->capture();
            Mage::getModel('core/resource_transaction')
               ->addObject($invoice)
               ->addObject($invoice->getOrder())
               ->save();
            return true;
        }

        return false;
    }

    /**
     *  Failure response from Hdfc
     *
     *  @return	  void
     */
    public function failureAction ()
    {
        $errorMsg = Mage::helper('hdfc')->__('There was an error occurred during paying process.');

        $order = $this->getOrder();
		//$order->setStatus('pending');

        if (!$order->getId()) {
            $this->norouteAction();
            return;
        }

        if ($order instanceof Mage_Sales_Model_Order && $order->getId()) {
            $order->addStatusToHistory($order->getStatus(), $errorMsg);
            $order->cancel();
            $order->save();
        }

        //$this->loadLayout();
        //$this->renderLayout();
        $this->_redirect('checkout/onepage/failure');

        Mage::getSingleton('checkout/session')->unsLastRealOrderId();
    }

}

