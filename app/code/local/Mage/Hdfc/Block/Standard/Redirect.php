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
 * Redirect to Hdfc
 *
 * @category    Mage
 * @package     Mage_Hdfc
 * @name        Mage_Hdfc_Block_Standard_Redirect
 * @author      Magento Core Team <core@magentocommerce.com>
 */

class Mage_Hdfc_Block_Standard_Redirect extends Mage_Core_Block_Abstract
{

    protected function _toHtml()
    {
        $standard = Mage::getModel('hdfc/standard');
        $form = new Varien_Data_Form();
        $form->setAction($standard->getHdfcUrl())
            ->setId('hdfc_standard_checkout')
            ->setName('hdfc_standard_checkout')
            ->setMethod('POST')
            ->setUseContainer(true);
		
		$secret_key = Mage::getSingleton('hdfc/config')->getSecretKey();
		if(Mage::getSingleton('hdfc/config')->getTransactionMode() == 1) {
			$mode = "TEST";
			$actionUrl = "https://testing.secure.ebs.in/pg/ma/payment/request/";
		} else { 
			$mode = "LIVE";
			$actionUrl = "https://secure.ebs.in/pg/ma/payment/request/";
		}
		$hashType = Mage::getSingleton('hdfc/config')->getHashType();
		$pageId = Mage::getSingleton('hdfc/config')->getPageId();
				
		$params = $standard->setOrder($this->getOrder())->getStandardCheckoutFormFields();
		$params['mode'] =  $mode;
		$params['page_id'] =  $pageId;	
		ksort($params);
		$hashData = $secret_key;
    	foreach ($params as $key => $value){
			if (strlen($value) > 0) {
				$hashData .= '|'.$value;
			}
		}
		if (strlen($hashData) > 0) {
			if($hashType == "SHA512")
				$hashValue = strtoupper(hash('SHA512',$hashData));	
			if($hashType == "SHA1")
				$hashValue = strtoupper(sha1($hashData)); 
            if($hashType == "md5")
				$hashValue = strtoupper(md5($hashData));		
		}

		$fields = "";
        foreach ($params as $key => $val) {		
        	$fields .= '<input type="hidden" name="'.$key.'" value="'.$val.'" size="60" />';       	
        }
        $fields .= '<input type="hidden" name="secure_hash" value="'.$hashValue.'" size="60" />';         
        $html = '<html><body><form name="hdfcForm" id="hdfcFormId" action="'.$actionUrl.'" method="POST">';
        $html .= $this->__('You will be redirected to HDFC Payment Gateway in a few seconds.');
        $html .= $fields;
        $html .= '</form><script type="text/javascript">setTimeout(function(){document.getElementById("hdfcFormId").submit()},2000)</script>';
        $html .= '</body></html>';
        
        return $html;
    }
}
