<?php

class Mapmygenomie_Career_Block_Adminhtml_Jobbackend_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('mapmygenomie_career_JobbackendGrid');
        $this->setDefaultSort('job_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('mapmygenomie_career/jobmanagement')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('job_id', array(
            'header' => Mage::helper('mapmygenomie_career')->__('ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'job_id',
        ));

        $this->addColumn('applicant_name', array(
            'header' => Mage::helper('mapmygenomie_career')->__('Applicant Name'),
            'align' => 'left',
            'index' => 'applicant_name',
        ));

        $this->addColumn('applicant_email', array(
            'header' => Mage::helper('mapmygenomie_career')->__('Applicant Email'),
            'width' => '150px',
            'index' => 'applicant_email',
        ));

        $this->addColumn('applicant_phone', array(
            'header' => Mage::helper('mapmygenomie_career')->__('Applicant Phone'),
            'width' => '150px',
            'index' => 'applicant_phone',
        ));
          $this->addColumn('applied_post_name', array(
            'header' => Mage::helper('mapmygenomie_career')->__('Applicant Post'),
            'width' => '150px',
            'index' => 'applied_post_name',
        ));

        $this->addColumn('filename', array(
            'header' => Mage::helper('mapmygenomie_career')->__('File Path'),
            'width' => '100px',
            'index' => 'filename',
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('mapmygenomie_career')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('mapmygenomie_career')->__('XML'));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction() {
        $this->setMassactionIdField('job_id');
        $this->getMassactionBlock()->setFormFieldName('job');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('mapmygenomie_career')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('mapmygenomie_career')->__('Are you sure?')
        ));

        return $this;
    }

}
