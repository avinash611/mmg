<?php

class Mapmygenomie_Career_IndexController extends Mage_Core_Controller_Front_Action {

    /**
     * function for index action
     *
     * @return void()
     * */
    public function indexAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

    /**
     * function for load Decription action
     *
     * @return void()
     * */
    public function loadDescriptionAction() {
        $this->getResponse()->setBody($this->getLayout()->createBlock('mapmygenomie_career/list_ajax')->toHtml());
    }

    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {

            //echo "Test 1".$_FILES['filename']['name'];
            if (isset($_FILES['filename']['name']) && $_FILES['filename']['name'] != '') {
                try {
                    $postObject = new Varien_Object();
                    $postObject->setData($data);
                    $error = false;
                    if (!Zend_Validate::is(trim($data['applicant_name']), 'NotEmpty')) {
                        $error = true;
                    }

                    if (!Zend_Validate::is(trim($data['applicant_email']), 'EmailAddress')) {
                        $error = true;
                    }

                    if (Zend_Validate::is(trim($data['hideit']), 'NotEmpty')) {
                        $error = true;
                    }
                    $applicant_phoneno = $data['applicant_phone'];
                    if (!empty($data['positionapplied'])) {
                        $applicant_applied = $data['positionapplied'];
                    } else {
                        $applicant_applied = "General";
                    }
                    if (!empty($applicant_phoneno)) {
                        if (!is_numeric(trim($applicant_phoneno))) {
                            Mage::getSingleton('core/session')->addError(Mage::helper('mapmygenomie_career')->__('Please enter a valid mobile number'));
                            $this->_redirect('*/*/');
                            return;
                        }
                    }

                    if ($error) {
                        throw new Exception();
                    }


                    if (isset($postObject['applicant_name']) && ($postObject['applicant_name'] != '') && isset($postObject['applicant_email']) && ($postObject['applicant_email'] != '')) {
                        /* Starting upload */
                        $uploader = new Varien_File_Uploader('filename');

                        /* Any extention would work */
                        $uploader->setAllowedExtensions(array('doc', 'docx', 'pdf'));
                        $uploader->setAllowRenameFiles(false);

                        /*
                         * Set the file upload mode 
                         * false -> get the file directly in the specified folder
                         * true -> get the file in the product like folders 
                         * 	(file.jpg will go in something like /media/f/i/file.jpg)
                         */
                        $uploader->setFilesDispersion(false);

                        // We set media as the upload dir
                        $path = Mage::getBaseDir('media') . DS . 'cv';
                        $uploader->save($path, $_FILES['filename']['name']);

                        $uploadfilename = $uploader->getUploadedFileName();

                        //this way the name is saved in DB
                        $data['filename'] = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'cv/' . $uploadfilename;
                        $postObject['filename'] = $data['filename'];
                        $data['applied_post_name'] = $applicant_applied;
                        $postObject['applied_post_name'] = $applicant_applied;

                        //echo $data['filename']; exit;

                        $model = Mage::getModel('mapmygenomie_career/jobmanagement');

                        $model->setData($data)
                                ->setId($this->getRequest()->getParam('job_id'));

                        $model->save();

                        $mailTemplate = Mage::getModel('core/email_template');
                        $career_enquiry_emails = Mage::getStoreConfig('contacts/mapmygenomie_career/career_request_email');

                        if (!empty($career_enquiry_emails)) {
                            $emails = explode(',', $career_enquiry_emails);

                            if (file_exists(Mage::getBaseDir('media') . DS . 'cv' . DS . $uploadfilename)) {
                                $translate = Mage::getSingleton('core/translate');
                                $translate->setTranslateInline(false);
                                $sender = Array('name' => 'Career Enquires',
                                    'email' => $postObject->getapplicant_email());
                                $translate->setTranslateInline(false);
                                foreach ($emails as $email) {
                                    $mailTemplate->setDesignConfig(array('area' => 'frontend'));
                                    $mailTemplate->getMail()
                                            ->createAttachment(file_get_contents(Mage::getBaseDir('media') . DS . 'cv' . DS . $uploadfilename), Zend_Mime::TYPE_OCTETSTREAM, Zend_Mime::DISPOSITION_ATTACHMENT, Zend_Mime::ENCODING_BASE64, basename($uploadfilename)
                                    );
                                    $mailTemplate->sendTransactional(
                                            Mage::getStoreConfig('contacts/mapmygenomie_career/email_template'), $sender, $email, null, array('data' => $postObject)
                                    );
                                }
                                if (!$mailTemplate->getSentSuccess()) {
                                    throw new Exception();
                                }
                                $translate->setTranslateInline(true);
                            }
                        }
                        Mage::getSingleton('core/session')->addSuccess('You have applied Successfully.');
                    } else {
                        Mage::getSingleton('core/session')->addError(Mage::helper('mapmygenomie_career')->__('Please fill all the Required Fields'));
                        $this->_redirect('*/*/');
                        return;
                    }
                } catch (Exception $e) {
                    Mage::getSingleton('core/session')->addError($e->getMessage());
                    Mage::getSingleton('core/session')->setFormData($data);
                    $this->_redirect('*/*/');
                }
            }
        }
        $this->_redirect('*/*/');
    }

}
