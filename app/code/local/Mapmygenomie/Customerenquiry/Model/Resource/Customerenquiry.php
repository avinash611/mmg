<?php
class Mapmygenomie_Customerenquiry_Model_Resource_Customerenquiry extends Mage_Core_Model_Resource_Db_Abstract
{
     public function _construct()
     {
         $this->_init('mapmygenomie_customerenquiry/customerenquiry', 'id');
     }
}