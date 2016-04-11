<?php
class Mworks_Pendingorders_Model_Pendingorder extends Mage_Core_Model_Abstract
{

	const ACTION = 'statusByRef';
	const ACCOUNTID = '18206';
	const SECRETKEY = '680fef07e4930ba0def434b16b39d854';

	public function getOrderDetailFromHDFCApi($ordernumber){
        
		$ch = curl_init();
	
		curl_setopt($ch, CURLOPT_URL,"https://api.secure.ebs.in/api/1_0");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('Action' => self::ACTION, 'AccountID' => self::ACCOUNTID, 'SecretKey' => self::SECRETKEY, 'RefNo' => $ordernumber)));
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec ($ch);

		curl_close ($ch);
		
		$jsonArrayResponse = json_decode(json_encode(simplexml_load_string($server_output)), true);
		
		//print_r($jsonArrayResponse);
		
		//Success
		//$jsonArrayResponse['@attributes']['status'])
		//[status] => Processed
		
		//Error
		//[@attributes] => Array
        //(
        //    [errorCode] => 3
        //    [error] => Invalid Refrence No
        //)

		return $jsonArrayResponse;
		
	}
	
	
	public function getPreviousPendingOrders() {
	
		$time = time();
		$toDate = date('Y-m-d H:i:s', $time);
		$lastTime = $time - 172800; // 60*60*48 // 2 days
		$fromDate = date('Y-m-d H:i:s', $lastTime);
		 
		/* Get the collection */
		$orders = Mage::getModel('sales/order')->getCollection()
			->addAttributeToFilter('created_at', array('from'=>$fromDate, 'to'=>$toDate))
			->addFieldToFilter('status', 'pending');
			
		foreach($orders as $order) {
			$responseArray = Mage::getModel('mworks_pendingorders/pendingorder')->getOrderDetailFromHDFCApi($order->getIncrementId());
			if (isset($responseArray['@attributes']['status']) && $responseArray['@attributes']['status'] === 'Processed') { 
				$order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true)->save();
				return "success";
			} else {
				return "failure";
			}
		}
			
	}

}