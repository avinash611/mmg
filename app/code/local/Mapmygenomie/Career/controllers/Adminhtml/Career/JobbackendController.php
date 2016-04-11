<?php

class Mapmygenomie_Career_Adminhtml_Career_JobbackendController extends Mage_Adminhtml_Controller_Action {

    protected function getHelperFile() {
        return Mage::helper('mapmygenomie_career');
    }

    public function indexAction() {
        /* $this->loadLayout()
          ->_setActiveMenu('mapmygenomie_career/jobbackend')
          ->_addBreadcrumb(Mage::helper('adminhtml')->__('Job Manager'), Mage::helper('adminhtml')->__('Job Manager'));
          $this->_title($this->__("Job Management"));
          $this->renderLayout(); */

        $this->loadLayout()
                ->_title($this->getHelperFile()->__('Job Management'))
                ->_setActiveMenu('mapmygenomie_career/jobbackend')
                ->_addContent($this->getLayout()->createBlock('mapmygenomie_career/adminhtml_jobbackend'))->renderLayout();
    }

    public function exportCsvAction() {
        $fileName = 'applicants.csv';
        $content = $this->getLayout()->createBlock('mapmygenomie_career/adminhtml_jobbackend_grid')->getCsv();
        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType = 'application/octet-stream') {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK', '');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename=' . $fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }

    public function exportXmlAction() {
        $fileName = 'applicants.xml';
        $content = $this->getLayout()->createBlock('mapmygenomie_career/adminhtml_jobbackend_grid')->getXml();
        $this->_sendUploadResponse($fileName, $content);
    }

    public function massDeleteAction() {
        $jobIds = $this->getRequest()->getParam('job');
        if (!is_array($jobIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select Applicant(s)'));
        } else {
            try {
                foreach ($jobIds as $jobId) {
                    $job = Mage::getModel('mapmygenomie_career/jobmanagement')->load($jobId);
                    $image = $job->getFilename();

                    // echo Mage::getBaseDir('media').'/stores/'.$image; exit;
                    /* Remove Mass Images */
                    $path = Mage::getBaseDir('media') . DS . 'cv';
                    unlink(Mage::getBaseDir('media') . '/stores/' . $image);

                    $job->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('adminhtml')->__(
                                'Total of %d record(s) were successfully deleted', count($jobIds)
                        )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

}
