<?php

class Mapmygenomie_Career_Block_List_Ajax extends Mapmygenomie_Career_Block_List {

    protected function _construct() {
        $this->setTemplate('career/list/ajax.phtml');
    }

    /**
     * function to get Position
     *
     * @return array $position:Mapmygenomie_Career_Model_Position
     * */
    public function getPosition() {
        $positionId = $this->getRequest()->getParam('position_id');
        $position = $this->getData('position_' . $positionId);
        if (is_null($position)) {
            $position = Mage::getModel('mapmygenomie_career/position')->load($positionId);
            $this->setData('position_' . $positionId, $position);
        }
        return $position;
    }

    /**
     * to get Carrer Request Email
     *
     * @return $value
     * */
    public function getCareerRequestEmail() {
        return Mage::helper('mapmygenomie_career')->getCareerRequestEmail();
    }

}