<?php

class Insync_HomepageBanner_Model_Banner extends Mage_Core_Model_Abstract {

	public function _construct() {
		parent::_construct();
		$this->_init('homepagebanner/banner');
	}

	public function getBannerUrl($infos=array()) {
		return preg_replace(array('/<url>/','/<bitly>/','/<title>/'),array($this->getPUrl(),$this->getPBitly(),$this->getPTitle()),$this->getUrl());
	}

	public function getBannerImage() {
		$img = $this->getName();
		if($this->getImage() != '') {
			$img = '<img src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).$this->getImage().'" alt="'.$this->getName().'" />';
		}
		return $img;
	}

	public function getBannerTarget() {
		$target = '';
		if($this->getTarget() == 1) $target = 'target="_blank"';
		return $target;
	}

	protected function getPTitle() {
		return Mage::getSingleton('core/layout')->getBlock('head')->getTitle();
	}

	protected function getPUrl() {
		return Mage::getModel('homepagebanner/urls')->getCurrentUrl();
	}

	protected function getPBitly() {
            return Mage::getModel('homepagebanner/urls')->getBitlyUrl();
	}

        /* Deprecated */
	public function getPageInfos() {
		return array('url'=>$this->getPUrl(),'bitly'=>$this->getPBitly(),'title'=>$this->getPTitle());
	}
}