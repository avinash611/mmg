<?php

class Mapmygenomie_Compare_Helper_Data extends Mage_Core_Helper_Abstract {

    /**
     * config path to enabled flag
     */
    const XML_ENABLED_PATH = 'mapmygenomie_compare/settings/enabled';


    /**
     * check if the module is enabled
     * @access public
     * @return bool
     * @author Marius Strajeru <marius.strajeru@gmail.com>
     */
    public function isEnabled() {
        
        return Mage::getStoreConfigFlag(self::XML_ENABLED_PATH);
    }

}

?>
