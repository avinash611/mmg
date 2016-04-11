<?php


class Mapmygenomie_Career_Block_Adminhtml_Position_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	
	/**
     * Set defaults
     */

  public function __construct()
  {
      parent::__construct();
      $this->setId('mapmygenomie_career_PositionGrid');
      $this->setDefaultSort('position_name');
      $this->setDefaultDir('ASC');
     $this->setSaveParametersInSession(true);
  }
  
   /**
     * Prepare collection
     *
     * @return Mapmygenomie_Career_Block_Adminhtml_Position_Grid
     */

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('mapmygenomie_career/position')->getCollection();   
     
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }
  
  /**
     * Prepare grid columns
     *
     * @return Mapmygenomie_Career_Block_Adminhtml_Position_Grid
     */
  protected function _prepareColumns()
  {
      $this->addColumn('position_id', array(
          'header'    => Mage::helper('mapmygenomie_career')->__('ID'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'position_id',
      ));

      $this->addColumn('position_name', array(
          'header'    => Mage::helper('mapmygenomie_career')->__('Position Name'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'position_name',
      ));
      
      $categories = Mage::getResourceModel('mapmygenomie_career/category_collection')
	 		->addFieldToFilter('category_status', Mapmygenomie_Career_Model_Category::STATUS_ENABLED )
	 		->load()
	        ->toOptionHash();

      $this->addColumn('category_id', array(
          'header'    => Mage::helper('mapmygenomie_career')->__('Category Name'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'category_id',
		  'type'      =>  'options',
          'options'   =>  $categories,	 
      ));
      
      $this->addColumn('position_count', array(
          'header'    => Mage::helper('mapmygenomie_career')->__('Vacancies'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'position_count',
      ));
      
        $this->addColumn('position_status', array(
          'header'    => Mage::helper('mapmygenomie_career')->__('Status'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'position_status',
          'type' 	  => 'options',
          'options'   => Mage::getSingleton('mapmygenomie_career/position')->getStatusOptionArray(),
      ));
     
      return parent::_prepareColumns();
  }

   
  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }
 

}