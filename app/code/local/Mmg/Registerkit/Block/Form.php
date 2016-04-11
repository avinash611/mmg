<?php
/**
 * Created by PhpStorm.
 * User: Avinash
 * Date: 4/11/16
 * Time: 2:26 PM
 */

class Mmg_Registerkit_Block_Form extends Mage_Core_Block_Template
{


    public function getSuccessMessage()
    {
        $message = Mage::getSingleton('newsletter/session')->getSuccess();
        return $message;
    }

    public function getErrorMessage()
    {
        $message = Mage::getSingleton('newsletter/session')->getError();
        return $message;
    }

    /**
     * Retrieve form action url and set "secure" param to avoid confirm
     * message when we submit form from secure page to unsecure
     *
     * @return string
     */
    public function getFormActionUrl()
    {
        return $this->getUrl('newsletter/subscriber/new', array('_secure' => true));
    }

    public function getCustomer()
    {
        return Mage::getSingleton('customer/session')->getCustomer();
    }

    /**
     * Get back url in account dashboard
     *
     * This method is copypasted in:
     * Mage_Wishlist_Block_Customer_Wishlist  - because of strange inheritance
     * Mage_Customer_Block_Address_Book - because of secure url
     *
     * @return string
     */
    public function getBackUrl()
    {
        // the RefererUrl must be set in appropriate controller
        if ($this->getRefererUrl()) {
            return $this->getRefererUrl();
        }
        return $this->getUrl('kit/register/');
    }
}