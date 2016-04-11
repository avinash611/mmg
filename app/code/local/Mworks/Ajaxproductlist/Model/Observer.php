<?php

class Mworks_Ajaxproductlist_Model_Observer {

  /**
   * Observes the URL before rendering the final O/P
   */
  public function getProductList($observer) {
    if(Mage::getStoreConfig('mworks_ajaxproductlist/settings/enabled') == '1') {
		if(Mage::app()->getRequest()->getModuleName() == 'catalogsearch' || Mage::app()->getRequest()->getModuleName() == 'catalog') {
			if( Mage::app()->getRequest()->getParam('pcl') ) {
				Mage::app()->getLayout()->removeOutputBlock('root')->addOutputBlock('content');
			}
		}
    }
  }

}