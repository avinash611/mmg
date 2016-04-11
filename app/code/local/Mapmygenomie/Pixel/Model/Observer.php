<?php

class Mapmygenomie_Pixel_Model_Observer {

    public function registerSuccessPixel($observer) {
        if (Mage::getStoreConfig('mapmygenomie_pixel/facebookcustomaudience/enable', Mage::app()->getStore()) == 1) {
            Mage::getSingleton('core/session')->setFirstTimeRegister(1);          
        }
    }

}
