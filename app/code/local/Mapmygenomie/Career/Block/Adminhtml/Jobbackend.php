<?php  

class Mapmygenomie_Career_Block_Adminhtml_Jobbackend extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_jobbackend';
    $this->_blockGroup = 'mapmygenomie_career';
    $this->_headerText = Mage::helper('mapmygenomie_career')->__('Job Management');
    $this->_addButtonLabel = Mage::helper('mapmygenomie_career')->__('Add job');
    parent::__construct();
    $this->_removeButton('add');
  }
}

?>
