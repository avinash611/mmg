<?php
class Mapmygenomie_Checkout_Block_Onepage extends Mage_Checkout_Block_Onepage 
{
    protected function _getStepCodes()
    {
        if (!Mage::helper('mapmygenomie_checkout')->getHideShipping()){
            return parent::_getStepCodes();
        }
        return array_diff(parent::_getStepCodes(), array('shipping_method'));
    }
	
	 /* public function getSteps()
    {
        $steps = array();
        $stepCodes = $this->_getStepCodes();

        if ($this->isCustomerLoggedIn()) {
            $stepCodes = array_diff($stepCodes, array('login'));
        }

        foreach ($stepCodes as $step) {
            $steps[$step] = $this->getCheckout()->getStepData($step);
        }

        return $steps;
    }*/
}