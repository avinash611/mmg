<?php

class Mapmygenomie_Owlcarousal_Adminhtml_Carousal_CategoryController extends Mage_Adminhtml_Controller_Action {

    protected function getHelperFile() {
        return Mage::helper('mapmygenomie_owlcarousal');
    }

    public function indexAction() {
        $this->loadLayout()
                ->_title($this->getHelperFile()->__('Category'))
                ->_setActiveMenu('cms/mapmygenomie_owlcarousal')
                ->_addContent($this->getLayout()->createBlock('mapmygenomie_owlcarousal/adminhtml_owlcarousalinfo'))->renderLayout();
    }

    /**
     * New action
     *
     * @return void
     */
    public function newAction() {
        $this->_forward('edit');
    }

    /**
     * Edit Action
     */
    public function editAction() {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('mapmygenomie_owlcarousal/owlcarousalinfo')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('mapmygenomie_owlcarousal_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('cms/mapmygenomie_owlcarousal');

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('mapmygenomie_owlcarousal/adminhtml_owlcarousalinfo_edit'))
                    ->_addLeft($this->getLayout()->createBlock('mapmygenomie_owlcarousal/adminhtml_owlcarousalinfo_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('mapmygenomie_owlcarousal')->__('Carousal does not exist'));
            $this->_redirect('*/*/');
        }
    }

    /**
     * Save Action
     * @return type
     */
    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {                       
           
            
            if (isset($_FILES['carousal_image']['name']) && $_FILES['carousal_image']['name'] != '') {               
                try {
                    $uploader = new Varien_File_Uploader('carousal_image');

                    $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                    $uploader->setAllowRenameFiles(false);

                    $uploader->setFilesDispersion(false);

                    $path = Mage::getBaseDir('media') . DS . 'social';               
                    $uploader->save($path, $_FILES['carousal_image']['name']);
                } catch (Exception $e) {
                    
                }
                $data['carousal_image'] = 'social/' . $_FILES['carousal_image']['name'];
            }else{
               // echo $model->getCarousalImage();die;
                $data['carousal_image'] =$data['carousal_image']['value'];
                
              
            }

            if (isset($data['carousal_image']['delete'])){              
                
                $data['carousal_image'] = '';
            }            
         
            try {
                 $model = Mage::getModel('mapmygenomie_owlcarousal/owlcarousalinfo');
                 $model->setData($data)->setId($this->getRequest()->getParam('id'));
                 $model->setCarousalImage($data['carousal_image']);
                if ($model->getCreatedAt() == NULL || $model->getUpdatedAt() == NULL) {
                    $model->setCreatedAt(now())->setUpdateAt(now());
                } else {
                    
                    $model->setUpdatedAt(now());
                }

                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('mapmygenomie_owlcarousal')->__('Carousal was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('mapmygenomie_owlcarousal')->__('Unable to save carousal information'));
        $this->_redirect('*/*/');
    }

    /**
     * Delete Action
     */
    public function deleteAction() {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('mapmygenomie_owlcarousal/owlcarousalinfo');
                $model->setId($this->getRequest()->getParam('id'))->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('mapmygenomie_owlcarousal')->__('Carousal was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    /**
     * Mass Delete Action
     */
    public function massDeleteAction() {
        $carousalIds = $this->getRequest()->getParam('mapmygenomie_owlcarousal');
        if (!is_array($carousalIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('mapmygenomie_owlcarousal')->__('Please select carousal(s)'));
        } else {
            try {
                foreach ($carousalIds as $carousalId) {
                    $carousalInfo = Mage::getModel('mapmygenomie_owlcarousal/owlcarousalinfo')->load($carousalId);
                    $carousalInfo->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('adminhtml')->__(
                                'Total of %d record(s) were successfully deleted', count($carousalIds)
                        )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * Mass status Action
     */
    public function massStatusAction() {
        $carousalIds = $this->getRequest()->getParam('mapmygenomie_owlcarousal');
        if (!is_array($carousalIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select carousal(s)'));
        } else {
            try {
                foreach ($carousalIds as $carousalId) {
                    $carousalInfo = Mage::getSingleton('mapmygenomie_owlcarousal/owlcarousalinfo')
                            ->load($carousalId)
                            ->setCarousalStatus($this->getRequest()->getParam('carousal_status'))
                            ->setIsMassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) were successfully updated', count($carousalIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

}
