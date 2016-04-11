<?php

class Mapmygenomie_Customerenquiry_Adminhtml_Customerenquiry_IndexController extends Mage_Adminhtml_Controller_Action {

    protected function _initAction() {
        $this->loadLayout()->_setActiveMenu('mapmygenomie_customerenquiry/enquiry')->_addBreadcrumb('customerenquiry Manager', 'customerenquiry Manager');
        return $this;
    }

    public function indexAction() {
        $this->_initAction()
                ->_addContent($this->getLayout()->createBlock('mapmygenomie_customerenquiry/adminhtml_enquiry'))
                ->renderLayout();
    }

    public function editAction() {
        $customerenquiryId = $this->getRequest()->getParam('id');
        $customerenquiryModel = Mage::getModel('mapmygenomie_customerenquiry/customerenquiry')->load($customerenquiryId);

        if ($customerenquiryModel->getId() || $customerenquiryId == 0) {
            Mage::register('mapmygenomie_customerenquiry_data', $customerenquiryModel);
            $this->loadLayout();
            $this->_setActiveMenu('mapmygenomie_customerenquiry/enquiry');
            $this->_addBreadcrumb('customerenquiry Manager', 'customerenquiry Manager');
            $this->_addBreadcrumb('customerenquiry Description', 'customerenquiry Description');
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $customerData = Mage::getModel('customer/customer')->load($customerenquiryModel->getCustomer_id())->getData();
            $html = '';
            if (isset($customerData) && $customerData['email']) {
                $html .= '<p> Customer Name: ' . $customerData['firstname'] . ' ' . $customerData['lastname'] . '</p>';
                $html .= '<p> Customer Email: ' . $customerData['email'] . '</p>';
            }

            // $html .= '<p>' . $customerenquiryModel->getCustomer_comment() . '</p>';
            if ($customerenquiryModel->getCustomer_report() != '' && $customerenquiryModel->getCustomer_report() != null) {
                $html .= '<p>Customer Data: <a target="_blank" href="' . Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'customer_reports/' . $customerenquiryModel->getCustomer_report() . '">' . $customerenquiryModel->getCustomer_report() . '</a></p>';
            }

            $block = $this->getLayout()
                    ->createBlock('core/text', 'example-block')
                    ->setText($html);


            $this->_addContent($this->getLayout()->createBlock('mapmygenomie_customerenquiry/adminhtml_customerenquiry_edit'))
                    ->_addLeft($this->getLayout()
                            ->createBlock('mapmygenomie_customerenquiry/adminhtml_customerenquiry_edit_tabs')
            );

            $this->_addContent($block);

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError('customerenquiry does not exist');
            $this->_redirect('*/*/');
        }
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function saveAction() {
        if ($this->getRequest()->getPost()) {
            try {
                $postData = $this->getRequest()->getPost();
                $customerenquiryModel = Mage::getModel('mapmygenomie_customerenquiry/customerenquiry');
                if ($this->getRequest()->getParam('id') <= 0)
                    $customerenquiryModel->setCreated_at(
                            Mage::getSingleton('core/date')
                                    ->gmtDate()
                    );

                /* ------Upload-------------- */
                if (isset($_FILES['doctor_report']['name']) && $_FILES['doctor_report']['name'] != '') {
                    
                    /* Starting upload */
                    $uploader = new Varien_File_Uploader('doctor_report');

                    /* Any extention would work */
                    $uploader->setAllowedExtensions(array('pdf'));
                    $uploader->setAllowRenameFiles(false);

                    /*
                     * Set the file upload mode 
                     * false -> get the file directly in the specified folder
                     * true -> get the file in the product like folders 
                     * 	(file.jpg will go in something like /media/f/i/file.jpg)
                     */
                    $uploader->setFilesDispersion(false);

                    // We set media as the upload dir
                    $path = Mage::getBaseDir('media') . DS . 'customer_reports';
                    $path_parts = pathinfo($_FILES['doctor_report']['name']);
                    $uploader->save($path, $path_parts['filename'] . '_' . uniqid() . '.' . $path_parts['extension']);

                    $uploadfilename = $uploader->getUploadedFileName();
                    
                   

                    //this way the name is saved in DB
                    $data['fileinputname'] = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'customer_reports/' . $uploadfilename;
                }
                /* -------------------------- */

                $customerenquiryModel->setDoctor_comment($postData['doctorcomment']);
                if (isset($uploadfilename) && $uploadfilename !='') {
                    $customerenquiryModel->setDoctor_report($uploadfilename);
                }
                $admin = Mage::getSingleton('admin/session');
                $adminId = $admin->getUser()->getUserId();
                $customerenquiryModel->setDoctor_id($adminId);

                $customerenquiryModel
                        ->addData($postData)
                        ->setUpdated_at(
                                Mage::getSingleton('core/date')
                                ->gmtDate())
                        ->setId($this->getRequest()->getParam('id'))
                        ->save();
                /* now need to send a notification to the customer */
                $notifyCustomer = isset($postData['is_customer_notified']) ? $postData['is_customer_notified'] : false;
                if ($notifyCustomer) {
                    if ($this->getRequest()->getParam('id')) {
                        $customerEnquiryInfo = Mage::getModel('mapmygenomie_customerenquiry/customerenquiry')->load($this->getRequest()->getParam('id'));
                        if (isset($customerEnquiryInfo)) {
                            $customerData = Mage::getModel('customer/customer')->load($customerEnquiryInfo->getCustomer_id());
                            if (isset($customerData) && $customerData['email']) {
                                $this->_sendnotifymail($customerData, $postData['doctorcomment']);
                            }
							
							$customerTelephoneNo = trim($customerData->getPrimaryBillingAddress()->getTelephone());
                            if ($customerTelephoneNo) {
                                $mobile = "/^[1-9][0-9]*$/";
                                if (preg_match($mobile, $customerTelephoneNo)) {
                                    Mage::dispatchEvent('customerenquiry_index_controller_save_action', array('customerdata' => $customerData));
                                }
                            }
                        }
                    }
                }
                Mage::getSingleton('adminhtml/session')
                        ->addSuccess('successfully saved');

                Mage::getSingleton('adminhtml/session')
                        ->setcustomerenquiryData(false);
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {               
                Mage::getSingleton('adminhtml/session')
                        ->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')
                        ->setcustomerenquiryData($this->getRequest()
                                ->getPost()
                );
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()
                            ->getParam('id')));
                return;
            }
            //}
        }
        $this->_redirect('*/*/');
    }

    public function deleteAction() {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $customerenquiryModel = Mage::getModel('mapmygenomie_customerenquiry/customerenquiry');
                $customerenquiryModel->setId($this->getRequest()
                                ->getParam('id'))
                        ->delete();
                Mage::getSingleton('adminhtml/session')
                        ->addSuccess('successfully deleted');
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')
                        ->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    private function _sendnotifymail($customerData, $doctorComment) {
        $storeId = Mage::app()->getStore()->getId();
        $sender = Mage::getStoreConfig('contacts/mapmygenomie_customerenquiry/sender_email_identity', $storeId);
        $templateId = Mage::getStoreConfig('contacts/mapmygenomie_customerenquiry/email_template_ofcustomers', $storeId);
        $email = $customerData['email'];
        
        $emailName = ucfirst(strtolower($customerData['firstname']));
        $vars = Array('cust_name' => $emailName);
        $storeId = Mage::app()->getStore()->getId();
        $translate = Mage::getSingleton('core/translate');
        Mage::getModel('core/email_template')
                ->sendTransactional($templateId, $sender, $email, $emailName, $vars, $storeId);
        $translate->setTranslateInline(true);
    }

}
