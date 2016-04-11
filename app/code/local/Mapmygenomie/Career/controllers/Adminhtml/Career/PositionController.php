<?php

class Mapmygenomie_Career_Adminhtml_Career_PositionController extends Mage_Adminhtml_Controller_Action
{

    protected function getHelperFile()
    {
        return Mage::helper('mapmygenomie_career');
    }
    public function indexAction()
    {
        $this->loadLayout()
			->_title($this->getHelperFile()->__('Positions'))
			->_setActiveMenu('mapmygenomie_career/position')
			->_addContent($this->getLayout()->createBlock('mapmygenomie_career/adminhtml_position'))->renderLayout();
    }
	/**
     * New Position action
     *
     * @return void
     */
    public function newAction()
    {
        $this->_forward('edit');
    }
	/**
     * Edit Position action
     */
    public function editAction()
    {
        $this->_title($this->getHelperFile()->__('Position Manager'));

        $model = Mage::getModel('mapmygenomie_career/position');
        if ($modelId = $this->getRequest()->getParam('id', false)) {
            $model->load($modelId);
        }

        $this->_title($model->getId() ? $model->getPositionName() : $this->__('New Position'));

        $sessionData = Mage::getSingleton('adminhtml/session')->getEventData(true);
        if (!empty($sessionData)) {
            $model->addData($sessionData);
        }

        Mage::register('mapmygenomie_career_position_data', $model);
        
        $this->loadLayout()
			->_title($this->getHelperFile()->__('Position Manager'))
            ->_setActiveMenu('mapmygenomie_career/position')
            ->_addContent($this->getLayout()->createBlock('mapmygenomie_career/adminhtml_position_edit'));
            
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->renderLayout();
    }
	/**
     * Save Position action
     */
    public function saveAction()
    {  
        if ($data = $this->getRequest()->getPost()) {
            $model = Mage::getModel('mapmygenomie_career/position');
            $model->setData($data)->setId($this->getRequest()->getParam('id'));

            try {

                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('mapmygenomie_career')->
                    __('Position was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            }
            catch (exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('mapmygenomie_career')->
            __('Unable to find Position to save'));
        $this->_redirect('*/*/');
    }
    /**
     * Delete Position action
     */
    public function deleteAction()
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('mapmygenomie_career/position');

                $model->setId($this->getRequest()->getParam('id'))->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->
                    __('Position was successfully deleted'));
                $this->_redirect('*/*/');
            }
            catch (exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }
	
	protected function _isAllowed()
    {
       return Mage::getSingleton('admin/session')->isAllowed('mapmygenomie_career/position');
    }
	
}
