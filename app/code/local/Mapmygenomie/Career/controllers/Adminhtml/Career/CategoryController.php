<?php

class Mapmygenomie_Career_Adminhtml_Career_CategoryController extends Mage_Adminhtml_Controller_Action {

    protected function getHelperFile() {
        return Mage::helper('mapmygenomie_career');
    }

    public function indexAction() {
        $this->loadLayout()
                ->_title($this->getHelperFile()->__('Category'))
                ->_setActiveMenu('mapmygenomie_career/category')
                ->_addContent($this->getLayout()->createBlock('mapmygenomie_career/adminhtml_category'))->renderLayout();
    }

    /**
     * New Category action
     *
     * @return void
     */
    public function newAction() {
        $this->_forward('edit');
    }

    /**
     * Edit Category action
     */
    public function editAction() {
        $this->_title($this->getHelperFile()->__('Category Manager'));

        $model = Mage::getModel('mapmygenomie_career/category');
        if ($modelId = $this->getRequest()->getParam('id', false)) {
            $model->load($modelId);
        }
        $this->_title($model->getId() ? $model->getCategoryName() : $this->__('New Category'));

        $sessionData = Mage::getSingleton('adminhtml/session')->getEventData(true);
        if (!empty($sessionData)) {
            $model->addData($sessionData);
        }

        Mage::register('mapmygenomie_career_category_data', $model);

        $this->loadLayout()
                ->_title($this->getHelperFile()->__('Category Manager'))
                ->_setActiveMenu('mapmygenomie_career/category')
                ->_addContent($this->getLayout()->createBlock('mapmygenomie_career/adminhtml_category_edit'));

        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->renderLayout();
    }

    /**
     * Save Category action
     */
    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {
            $model = Mage::getModel('mapmygenomie_career/category');
            $model->setData($data)->setId($this->getRequest()->getParam('id'));

            try {

                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('mapmygenomie_career')->
                                __('Category was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('mapmygenomie_career')->
                        __('Unable to find Category to save'));
        $this->_redirect('*/*/');
    }

    /**
     * Delete Category action
     */
    public function deleteAction() {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('mapmygenomie_career/category');

                $model->setId($this->getRequest()->getParam('id'))->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->
                                __('Position was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }
	
	protected function _isAllowed()
    {
       return Mage::getSingleton('admin/session')->isAllowed('mapmygenomie_career/category');
    }

}
