<?php

class Mapmygenomie_Customerenquiry_Block_Monblock extends Mage_Core_Block_Template {
    /*
     * Get all the customer Enquiry info
     */

    public function getCustomerEnquiry() {
        if (!Mage::getSingleton('customer/session')->isLoggedIn()) {
            return '';
        } else {
            $customerData = Mage::getSingleton('customer/session')->getCustomer();
            if (isset($customerData)) {
                $allEnquires = Mage::getResourceModel('mapmygenomie_customerenquiry/customerenquiry_collection')
                        ->addFieldToSelect('*')
                        ->addFieldToFilter('customer_id', Mage::getSingleton('customer/session')->getCustomer()->getId())
                        ->setOrder('created_at', 'desc');
                if (isset($allEnquires)) {
                    return $allEnquires;
                } else {
                    return '';
                }
            } else {
                return '';
            }
        }
    }

}
