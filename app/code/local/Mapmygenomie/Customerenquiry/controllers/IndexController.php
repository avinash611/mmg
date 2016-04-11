<?php

class Mapmygenomie_Customerenquiry_IndexController extends Mage_Core_Controller_Front_Action {

    public function indexAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setTitle($this->__('Customer Report Generation for 23andMe'));
        $this->getLayout()->getBlock('head')->setDescription($this->__('Customer Report Generation for 23andMe'));
        $this->renderLayout();
    }

    public function saveAction() {
        $post = $this->getRequest()->getPost();
        if ($post) {
            if (Mage::getStoreConfig('contacts/mapmygenomie_customerenquiry/active', Mage::app()->getStore()) == 1) {
                
                if (isset($_FILES['filename']['name']) && $_FILES['filename']['name'] != '') {                   
                    try {
                        $postObject = new Varien_Object();
                        $postObject->setData($post);
                        $error = false;

                        /* Starting upload */
                        $uploader = new Varien_File_Uploader('filename');

                        /* Any extention would work */
                        $uploader->setAllowedExtensions(array('csv', 'txt','rar','zip'));
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
                        //$uploader->save($path, $_FILES['filename']['name']);
                        $path_parts = pathinfo($_FILES['filename']['name']);
                        $uploader->save($path, $path_parts['filename'] . '_' . uniqid() . '.' . $path_parts['extension']);

                        $uploadfilename = $uploader->getUploadedFileName();

                        //this way the name is saved in DB
                        $data['filename'] = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'customer_reports/' . $uploadfilename;

                        $postObject['filename'] = $data['filename'];



                        $customerenquiry = Mage::getModel('mapmygenomie_customerenquiry/customerenquiry');
                        $customerenquiry->setCustomer_report($uploadfilename);

                        $customer = Mage::getSingleton('customer/session')->getCustomer();
                        $customerenquiry->setCustomer_id($customer->getEntityId());
                        $customerenquiry->setCreatedAt(now());
                        $customerenquiry->setUpdatedAt(now());
                        $customerenquiry->save();

                        $postObject['applicant_name'] = $customer->getName();
                        $postObject['applicant_email'] = $customer->getEmail();

                        $mailTemplate = Mage::getModel('core/email_template');
                        $customer_enquiry_emails = Mage::getStoreConfig('contacts/mapmygenomie_customerenquiry/recipient_email');
                        if (!empty($customer_enquiry_emails)) {
                            $translate = Mage::getSingleton('core/translate');
                            $sender = Array('name' => 'Customer 23andme Reports',
                                'email' => $customer->getEmail());
                            $translate->setTranslateInline(false);
                            $emails = explode(',', $customer_enquiry_emails);
                            foreach ($emails as $email) {
                                $mailTemplate->setDesignConfig(array('area' => 'frontend'))
                                        ->sendTransactional(
                                                Mage::getStoreConfig('contacts/mapmygenomie_customerenquiry/email_template'), $sender, $email, null, array('data' => $postObject)
                                );
                            }
                            if (!$mailTemplate->getSentSuccess()) {
                                throw new Exception();
                            }
                            $translate->setTranslateInline(true);
                        }
                        Mage::getSingleton('core/session')->addSuccess(Mage::helper('mapmygenomie_customerenquiry')->__('Your Information was submitted and will be responded to as soon as possible. Thank you for contacting us.'));
                        $this->_redirect('*/*/');
                        return;
                    } catch (Exception $e) {                       
                        Mage::getSingleton('core/session')->addError(Mage::helper('mapmygenomie_customerenquiry')->__('Unable to submit your request. Please check the supported file format and try again later'));
                        $this->_redirect('customerenquiry/index/index');
                        return;
                    }
                } else {
                    Mage::getSingleton('core/session')->addError(Mage::helper('mapmygenomie_customerenquiry')->__('Upload File and Submit!'));
                    $this->_redirect('*/*/');
                }
            } else {
                Mage::getSingleton('core/session')->addError(Mage::helper('mapmygenomie_customerenquiry')->__("You don't have permission to upload the file."));
                $this->_redirect('*/*/');
            }
        } else {
            Mage::getSingleton('core/session')->addError(Mage::helper('mapmygenomie_customerenquiry')->__('Enter all the Fields!!'));
            $this->_redirect('*/*/');
        }
    }

}
