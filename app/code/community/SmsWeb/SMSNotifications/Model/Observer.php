<?php

class SmsWeb_SMSNotifications_Model_Observer {

    // This method is called whenever an order is saved. It checks if the order's
    // status has been updated and if yes, checks if the new order status should
    // trigger sending a notification
	
	/*
     * Added By Binu -to send order success message
     */
    public function orderSucessNotification(Varien_Event_Observer $observer) {

        // Get the settings
        $settings = Mage::helper('smsnotifications/data')->getSettings();
        if ($settings['sms_enable'] == 0) {
            return;
        }
        $orderIds = $observer->getData('order_ids');
        foreach ($orderIds as $_orderId) {
            $order = Mage::getModel('sales/order')->load($_orderId);
            if ($order->getStoreId() == 2) {
                return;
            }
            // Generate the body for the notification
            $store_name = Mage::app()->getStore()->getFrontendName();
            $customer_name = $order->getCustomerFirstname();
            $customer_name .= ' ' . $order->getCustomerLastname() . '!';
            $order_amount = $order->getBaseCurrencyCode();
            $order_amount .= ' ' . $order->getBaseGrandTotal();
            $order_id = $order->getIncrementId();

            $shippingAdress = $order->getShippingAddress();
            $telephoneNumber = trim($shippingAdress->getTelephone());

            $text = Mage::getStoreConfig('smsnotifications/order_notification/order_status');
            $text = str_replace('{{name}}', ucwords($customer_name), $text);
            $text = str_replace('{{amount}}', $order_amount, $text);
            $text = str_replace('{{order}}', $order_id, $text);

            // Send the order notification by SMS

            array_push($settings['order_noficication_recipients'], $telephoneNumber);
          
            $result = Mage::helper('smsnotifications/data')->sendSms($text, $settings['order_noficication_recipients']);
            // Display a success or error message
            if ($result) {
                $sendNumber1 = implode(',', $settings['order_noficication_recipients']);
                Mage::getSingleton('adminhtml/session')->addSuccess(sprintf('The order notification has been sent via SMS to: %s', $sendNumber1));
            } else {
                Mage::getSingleton('adminhtml/session')->addError('There has been an error sending the order notification SMS.');
            }
        }
    }


    public function salesOrderSaveAfter($observer) {

        // Get the settings
        $settings = Mage::helper('smsnotifications/data')->getSettings();

        if ($settings['sms_enable'] == 0) {
            return;
        }
        // Get the new order object
        $order = $observer->getEvent()->getOrder();
        if ($order->getStoreId() == 2) {           
            return;
        }

        // Get the old order data
        $oldOrder = $order->getOrigData();


        $oreder_notification_status = [];  // 'processing','complete',
        $oreder_notification_status = array('pending', 'holded', 'closed', 'canceled');

        if (!in_array($order->getStatus(), $oreder_notification_status)) {
            return;
        }

        // If the order status hasn't changed, don't do anything
        if ($oldOrder['status'] === $order->getStatus()) {
            return;
        }


        if (Mage::app()->getStore()->isAdmin() && $order->getStatus() == "pending") {

            $resource = Mage::getSingleton('core/resource');
            $readConnection = $resource->getConnection('core_read');
            $table = $resource->getTableName('sales/order_status_history');

            $query = 'SELECT count(status) as status FROM ' . $table . ' WHERE status = "pending" and parent_id = '
                    . (int) $order->getId() . ' LIMIT 1';
            $pendingStatus = $readConnection->fetchOne($query);
        } else {
            $pendingStatus = 1;
        }

        // Generate the body for the notification
        $store_name = Mage::app()->getStore()->getFrontendName();
        $customer_name = $order->getCustomerFirstname();
        $customer_name .= ' ' . $order->getCustomerLastname().'!';
        $order_amount = $order->getBaseCurrencyCode();
        $order_amount .= ' ' . $order->getBaseGrandTotal();
        $order_id = $order->getIncrementId();

        $shippingAdress = $order->getShippingAddress();
        $telephoneNumber = trim($shippingAdress->getTelephone());


        $ordermethod = ($order->getRemoteIp()) ? 1 : 0;

       /* if ($ordermethod == 1 && $order->getStatus() == "pending" && $pendingStatus <= 1) {
            $text = Mage::getStoreConfig('smsnotifications/order_notification/order_status');
        } elseif ($ordermethod == 0 && $order->getStatus() == "pending" && $pendingStatus <= 1) {
            $text = Mage::getStoreConfig('smsnotifications/order_notification/order_status');
        } elseif ($order->getStatus() == "pending") {
            $text = Mage::getStoreConfig('smsnotifications/order_notification/order_unhold_status');
        } */
		
		if ($order->getStatus() != "pending" || $order->getStatus() != "processing") {
			if ($order->getStatus() == "holded") {
				$text = Mage::getStoreConfig('smsnotifications/order_notification/order_hold_status');
			} elseif ($order->getStatus() == "canceled") {
				$text = Mage::getStoreConfig('smsnotifications/order_notification/order_canceled_status');
			} elseif ($order->getStatus() == "closed") {
				$text = Mage::getStoreConfig('smsnotifications/order_notification/order_closed_status');
			} elseif ($order->getStatus() == "complete") {
				$text = Mage::getStoreConfig('smsnotifications/shipment_notification/message');
			}

			$text = str_replace('{{name}}', ucwords($customer_name), $text);
			$text = str_replace('{{amount}}', $order_amount, $text);
			$text = str_replace('{{order}}', $order_id, $text);

			// If no recipients have been set, we can't do anything
			/*if (!count($settings['order_noficication_recipients'])) {
				return;
			}*/

			// Send the order notification by SMS

			array_push($settings['order_noficication_recipients'], $telephoneNumber);        
		   
			//file_put_contents('sms.txt',$text.PHP_EOL,FILE_APPEND);
			$result = Mage::helper('smsnotifications/data')->sendSms($text, $settings['order_noficication_recipients']);

			// Display a success or error message
			if ($result) {
				$sendNumber1 = implode(',', $settings['order_noficication_recipients']);
				Mage::getSingleton('adminhtml/session')->addSuccess(sprintf('The order notification has been sent via SMS to: %s', $sendNumber1));
			} else {
				Mage::getSingleton('adminhtml/session')->addError('There has been an error sending the order notification SMS.');
			}
		}
    }

    // This method is called whenever a new shipment is created for an order
    public function salesOrderInvoiceSaveAfter($observer) {

        // Get the settings
        $settings = Mage::helper('smsnotifications/data')->getSettings();
        if ($settings['sms_enable'] == 0) {
            return;
        }
        $text = Mage::getStoreConfig('smsnotifications/invoice_notification/message');
        // If no invoice notification has been specified, no notification can be sent
        if (!$text) {
            return;
        }


        $order = $observer->getEvent()->getInvoice()->getOrder();
          if ($order->getStoreId() == 2) {
            return;
        }  
        $order_id = $order->getIncrementId();

        $invoice = $order->getInvoiceCollection()->getFirstItem();
        $invoiceId = $invoice->getIncrementId();


        $store_name = Mage::app()->getStore()->getFrontendName();
        $customer_name = $order->getCustomerFirstname();
        $customer_name .= ' ' . $order->getCustomerLastname().'!';

        $order_amount = $order->getBaseCurrencyCode();
        $order_amount .= ' ' . $order->getBaseGrandTotal();

        $shippingAdress = $order->getShippingAddress();
        $telephoneNumber = trim($shippingAdress->getTelephone());


        //file_put_contents('invoice.txt',$order_id);
        // Check if a telephone number has been specified
        if ($telephoneNumber) {
            $text = Mage::getStoreConfig('smsnotifications/invoice_notification/message');

            // Send the shipment notification to the specified telephone number
            $text = $settings['invoice_notification_message'];

            $text = str_replace('{{name}}', ucwords($customer_name), $text);
            $text = str_replace('{{order}}', $order_id, $text);
            $text = str_replace('{{amount}}', $order_amount, $text);
            $text = str_replace('{{invoiceno}}', $invoiceId, $text);

            array_push($settings['order_noficication_recipients'], $telephoneNumber);
            //file_put_contents('invoice.txt',$text.PHP_EOL,FILE_APPEND);
            $result = Mage::helper('smsnotifications/data')->sendSms($text, $settings['order_noficication_recipients']);

            // Display a success or error message
            if ($result) {
                $recipients_string = implode(',', $settings['order_noficication_recipients']);
                Mage::getSingleton('adminhtml/session')->addSuccess(sprintf('The invoice notification has been sent via SMS to: %s', $recipients_string));
            } else {
                Mage::getSingleton('adminhtml/session')->addError('There has been an error sending the invoice notification SMS.');
            }
        }
    }

    // This method is called whenever a new shipment is created for an order
    public function salesOrderShipmentSaveAfter($observer) {
        // Get the settings
        $settings = Mage::helper('smsnotifications/data')->getSettings();
        if ($settings['sms_enable'] == 0) {
            return;
        }
        // If no shipment notification has been specified, no notification can be sent
        if (!$settings['shipment_notification_message']) {
            return;
        }

        // Get the new order object
        $order = $observer->getEvent()->getShipment()->getOrder();
         if ($order->getStoreId() == 2) {
            return;
        }  

        // Get the telephone # associated with the shipping (or billing) address


        $customer_name = $order->getCustomerFirstname();
        $customer_name .= ' ' . $order->getCustomerLastname().'!';
        $order_id = $order->getIncrementId();
        $order_amount = $order->getBaseCurrencyCode();
        $order_amount .= ' ' . $order->getBaseGrandTotal();


        $shippingAdress = $order->getShippingAddress();
        $telephoneNumber = trim($shippingAdress->getTelephone());


        $shipment = $order->getShipmentsCollection()->getFirstItem();
        $shipId = $shipment->getIncrementId();


        // Check if a telephone number has been specified
        if ($telephoneNumber) {
            // Send the shipment notification to the specified telephone number
            $text = $settings['shipment_notification_message'];
            $text = str_replace('{{name}}', ucwords($customer_name), $text);
            $text = str_replace('{{order}}', $order_id, $text);
            $text = str_replace('{{amount}}', $order_amount, $text);
            $text = str_replace('{{shipmentno}}', $shipId, $text);

            array_push($settings['order_noficication_recipients'], $telephoneNumber);

            //file_put_contents('ship.txt',$text);
            $result = Mage::helper('smsnotifications/data')->sendSms($text, $settings['order_noficication_recipients']);

            // Display a success or error message
            if ($result) {
                $recipients_string = implode(',', $settings['order_noficication_recipients']);
                Mage::getSingleton('adminhtml/session')->addSuccess(sprintf('The shipment notification has been sent via SMS to: %s', $recipients_string));
            } else {
                Mage::getSingleton('adminhtml/session')->addError('There has been an error sending the shipment notification SMS.');
            }
        }
    }

    // This method is called whenever the application's setting in the
    // adminhtml are changed
    public function configSaveAfter($observer) {
        // Get the settings
        $settings = Mage::helper('smsnotifications/data')->getSettings();
        //echo Mage::app()->getStore()->getStoreId();
        //echo $settings['sms_enable'].'binu';die;
        if ($settings['sms_enable'] == 0) {
            return;
        }
        // If no recipients have been set, we can't do anything
        if (!count($settings['order_noficication_recipients'])) {
            return;
        }

        // Verify the settings by sending a test message
        $result = Mage::helper('smsnotifications/data')->sendSms('Congratulations, you have configured the extension correctly!', $settings['order_noficication_recipients']);

        // Display a success or error message
        if ($result) {
            // If everything has worked, let the user know that a test message
            // has been sent to the recipients
            $recipients_string = implode(',', $settings['order_noficication_recipients']);
            Mage::getSingleton('adminhtml/session')->addNotice(sprintf('A test message has been sent to the following recipient(s): %s. Please verify that all recipients received this test message. If not, correct the number(s) below.', $recipients_string));
        } else {
            Mage::getSingleton('adminhtml/session')->addError('Unable to send test message. Please verify that all your settings are correct and try again.');
        }
    }
	
	public function twenty23ReportNotification(Varien_Event_Observer $observer) {
        $settings = Mage::helper('smsnotifications/data')->getSettings();
        if ($settings['sms_enable'] == 0) {
            return;
        }
        $customerInfo = $observer->getData('customerdata');
        if ($customerInfo['store_id'] == 2) {
            return;
        }
        $telephoneNumber = trim($customerInfo->getPrimaryBillingAddress()->getTelephone());
        $customer_name = $customerInfo['firstname'];
        $customer_name .= ' ' . $customerInfo['lastname'] . '!';

        $text = Mage::getStoreConfig('contacts/mapmygenomie_customerenquiry/sms_tempalte_ofcustomers');

        $text = str_replace('{{name}}', ucwords($customer_name), $text);

        array_push($settings['order_noficication_recipients'], $telephoneNumber);

        $result = Mage::helper('smsnotifications/data')->sendSms($text, $settings['order_noficication_recipients']);
        // Display a success or error message
        if ($result) {
            $sendNumber1 = implode(',', $settings['order_noficication_recipients']);
            Mage::getSingleton('adminhtml/session')->addSuccess(sprintf('The Report notification has been sent via SMS to: %s', $sendNumber1));
        } else {
            Mage::getSingleton('adminhtml/session')->addError('There has been an error sending the report notification SMS.');
        }
    }

}
