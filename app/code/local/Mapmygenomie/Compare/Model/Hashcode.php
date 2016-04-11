<?php

class Mapmygenomie_Compare_Model_Hashcode extends Mage_Core_Model_Abstract {

    /**
     * Entity code.
     * Can be used as part of method name for entity processing
     */
    const ENTITY = 'mapmygenomie_compare_hascode';
    const CACHE_TAG = 'mapmygenomie_compare_hascode';

    /**
     * Prefix of model events names
     * @var string
     */
    protected $_eventPrefix = 'mapmygenomie_compare_hascode';

    /**
     * Parameter name in event
     * @var string
     */
    protected $_eventObject = 'hashcode';

    /**
     * constructor
     * @access public
     * @return void
     * @author Marius Strajeru <marius.strajeru@gmail.com>
     */
    public function _construct() {
        parent::_construct();
        $this->_init('mapmygenomie_compare/hashcode');
    }

}
