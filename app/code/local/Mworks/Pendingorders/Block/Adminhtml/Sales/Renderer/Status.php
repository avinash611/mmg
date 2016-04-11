<?php
class Mworks_Pendingorders_Block_Adminhtml_Sales_Renderer_Status extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

 /* Render Grid Column*/
   public function render(Varien_Object $row) 
   {
	//$collection = Mage::getModel('catalog/product')->getCollection()->addFieldToFilter('entity_id', $row->getId());
	//foreach ($collection as $item){
		return sprintf('<a id="row-%s" onClick="updateStatus(%s);">%s</a>',$row->getId(),$row->getId(),'Update');
    //}  
 
   }
}