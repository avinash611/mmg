<?php

class Mapmygenomie_Compare_Model_Adminhtml_System_Config_Source_Switch {
    /**
     * don't swithc images
     */
    const NO_SWITCH     = 0;
    /**
     * switch only main image
     */
    const SWITCH_MAIN   = 1;
    /**
     * switch media block
     */
    const SWITCH_MEDIA  = 2;
    /**
     * available options
     * @var null|mixed
     */
    protected $_options = null;
    /**
     * get the list of options
     * @access public
     * @return mixed|null
     * @author Marius Strajeru <marius.strajeru@gmail.com>
     */
    public function toOptionArray1(){
        if (is_null($this->_options)){
            $this->_options = array();
            $this->_options[] = array(
                'value' => self::NO_SWITCH,
                'label' => Mage::helper('mapmygenomie_compare')->__('No image switch')
            );
            $this->_options[] = array(
                'value' => self::SWITCH_MAIN,
                'label' => Mage::helper('mapmygenomie_compare')->__('Switch main image')
            );
            $this->_options[] = array(
                'value' => self::SWITCH_MEDIA,
                'label' => Mage::helper('mapmygenomie_compare')->__('Switch all media section')
            );
        }
        return $this->_options;
    }
}