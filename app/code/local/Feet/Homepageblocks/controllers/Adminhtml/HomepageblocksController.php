<?php

/**
 * @category    22Feet
 * @package     Feet_HomepageBlocks
 * @author      Chanchal Sarkar <chanchal@22feet.in>
 */

class Feet_Homepageblocks_Adminhtml_HomepageblocksController extends Mage_Adminhtml_Controller_action {

    protected function _initAction() {
        $this->loadLayout()
                ->_setActiveMenu('homepageblocks/items')
                ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));

        return $this;
    }

    public function indexAction() {
        $this->_initAction()
                ->renderLayout();
    }

    public function formAction() {
        $this->loadLayout();
        $this->getResponse()->setBody($this->getLayout()->createBlock('homepageblocks/adminhtml_homepageblocks_edit_tab_form')->toHtml());
    }

    public function editAction() {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('homepageblocks/homepageblocks')->load($id);
        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('homepageblocks_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('homepageblocks/items');

            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('homepageblocks/adminhtml_homepageblocks_edit'))
                    ->_addLeft($this->getLayout()->createBlock('homepageblocks/adminhtml_homepageblocks_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('homepageblocks')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {
            if( isset($data['stores']) ) {
                if( in_array('0', $data['stores']) ){
                    $data['store_code'] = '0';
                } else {
                    $data['store_code'] = join(",", $data['stores']);
                }
                unset($data['stores']);
            }

            $path = Mage::getBaseDir('media') . DS . 'homepageBlocks' . DS;
            if (!is_writable($path)) {
                mkdir(Mage::getBaseDir('media') . DS . 'homepageBlocks');
                mkdir(Mage::getBaseDir('media') . DS . 'homepageBlocks' . DS . 'resized');
            }

            if (isset($_FILES['homepageblock1_image']['name']) && $_FILES['homepageblock1_image']['name'] != '') {
                $this->getLayout()->createBlock('homepageblocks/adminhtml_homepageblocks')->resizeHomepageImage('homepageblock1_image', 308, 182, $path);

                //this way the name is saved in DB
                $data['homepageblock1_image'] = $_FILES['homepageblock1_image']['name'];
            }
            if (is_array($data['homepageblock1_image'])) {
                unset($data['homepageblock1_image']);
            }

            if (isset($_FILES['homepageblock2_image']['name']) && $_FILES['homepageblock2_image']['name'] != '') {
                $this->getLayout()->createBlock('homepageblocks/adminhtml_homepageblocks')->resizeHomepageImage('homepageblock2_image', 149, 182, $path);

                //this way the name is saved in DB
                $data['homepageblock2_image'] = $_FILES['homepageblock2_image']['name'];
            }
            if (is_array($data['homepageblock2_image'])) {
                unset($data['homepageblock2_image']);
            }

            if (isset($_FILES['homepageblock3_image']['name']) && $_FILES['homepageblock3_image']['name'] != '') {
                $this->getLayout()->createBlock('homepageblocks/adminhtml_homepageblocks')->resizeHomepageImage('homepageblock3_image', 149, 182, $path);

                //this way the name is saved in DB
                $data['homepageblock3_image'] = $_FILES['homepageblock3_image']['name'];
            }
            if (is_array($data['homepageblock3_image'])) {
                unset($data['homepageblock3_image']);
            }
            
            if (isset($_FILES['homepageblock4_image']['name']) && $_FILES['homepageblock4_image']['name'] != '') {
                $this->getLayout()->createBlock('homepageblocks/adminhtml_homepageblocks')->resizeHomepageImage('homepageblock4_image', 307, 379, $path);

                //this way the name is saved in DB
                $data['homepageblock4_image'] = $_FILES['homepageblock4_image']['name'];
            }
            if (is_array($data['homepageblock4_image'])) {
                unset($data['homepageblock4_image']);
            }

            if (isset($_FILES['homepageblock5_image']['name']) && $_FILES['homepageblock5_image']['name'] != '') {
                $this->getLayout()->createBlock('homepageblocks/adminhtml_homepageblocks')->resizeHomepageImage('homepageblock5_image', 307, 379, $path);

                //this way the name is saved in DB
                $data['homepageblock5_image'] = $_FILES['homepageblock5_image']['name'];
            }
            if (is_array($data['homepageblock5_image'])) {
                unset($data['homepageblock5_image']);
            }

            if (isset($_FILES['homepageblock6_image']['name']) && $_FILES['homepageblock6_image']['name'] != '') {
                $this->getLayout()->createBlock('homepageblocks/adminhtml_homepageblocks')->resizeHomepageImage('homepageblock6_image', 307, 379, $path);

                //this way the name is saved in DB
                $data['homepageblock6_image'] = $_FILES['homepageblock6_image']['name'];
            }
            if (is_array($data['homepageblock6_image'])) {
                unset($data['homepageblock6_image']);
            }

            if (isset($_FILES['homepageblock7_image']['name']) && $_FILES['homepageblock7_image']['name'] != '') {
                $this->getLayout()->createBlock('homepageblocks/adminhtml_homepageblocks')->resizeHomepageImage('homepageblock7_image', 307, 379, $path);

                //this way the name is saved in DB
                $data['homepageblock7_image'] = $_FILES['homepageblock7_image']['name'];
            }
            if (is_array($data['homepageblock7_image'])) {
                unset($data['homepageblock7_image']);
            }

            if (isset($_FILES['homepageblock8_image']['name']) && $_FILES['homepageblock8_image']['name'] != '') {
                $this->getLayout()->createBlock('homepageblocks/adminhtml_homepageblocks')->resizeHomepageImage('homepageblock8_image', 307, 379, $path);

                //this way the name is saved in DB
                $data['homepageblock8_image'] = $_FILES['homepageblock8_image']['name'];
            }
            if (is_array($data['homepageblock8_image'])) {
                unset($data['homepageblock8_image']);
            }

            if (isset($_FILES['homepageblock9_image']['name']) && $_FILES['homepageblock9_image']['name'] != '') {
                $this->getLayout()->createBlock('homepageblocks/adminhtml_homepageblocks')->resizeHomepageImage('homepageblock9_image', 307, 379, $path);

                //this way the name is saved in DB
                $data['homepageblock9_image'] = $_FILES['homepageblock9_image']['name'];
            }
            if (is_array($data['homepageblock9_image'])) {
                unset($data['homepageblock9_image']);
            }

            $model = Mage::getModel('homepageblocks/homepageblocks');
            $model->setData($data)
                    ->setId($this->getRequest()->getParam('id'));

            try {
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('homepageblocks')->__('Homepages Blocks Successfully saved'));
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
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('homepageblocks')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction() {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('homepageblocks/homepageblocks');

                $model->setId($this->getRequest()->getParam('id'))
                        ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Homepage Block successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction() {
        $homepageblocksIds = $this->getRequest()->getParam('homepageblocks');
        if (!is_array($homepageblocksIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($homepageblocksIds as $homepageblocksId) {
                    $homepageblocks = Mage::getModel('homepageblocks/homepageblocks')->load($homepageblocksId);
                    $homepageblocks->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('adminhtml')->__(
                                'Total of %d record(s) were successfully deleted', count($homepageblocksIds)
                        )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function massStatusAction() {
        $homepageblocksIds = $this->getRequest()->getParam('homepageblocks');
        if (!is_array($homepageblocksIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($homepageblocksIds as $homepageblocksId) {
                    $homepageblocks = Mage::getSingleton('homepageblocks/homepageblocks')
                            ->load($homepageblocksId)
                            ->setStatus($this->getRequest()->getParam('status'))
                            ->setIsMassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) were successfully updated', count($homepageblocksIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

}