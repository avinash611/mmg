<?php

class Mworks_Ajax_Helper_Data extends Mage_Core_Helper_Abstract
{
	
	  public function getSecureUrlFrontend($url) {
        if (!empty($url)) {
            $isSecure = Mage::app()->getFrontController()->getRequest()->isSecure();
            if ($isSecure) {
                $pageUrl = preg_replace("/^http:/i", "https:", $url);
            } else {
                //$pageUrl = $url;
				$pageUrl = preg_replace("/^https:/i", "http:", $url);
            }
            return $pageUrl;
        } else {
            return 0;
        }
    }

}