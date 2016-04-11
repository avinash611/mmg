<?php

/**
 * @category    22Feet
 * @package     GuestInfo
 * @author      Binu  <binuconcept@gmail.com,9986442330>
 */
class Mapmygenomie_Guestinfo_Adminhtml_GuestinfoController extends Mage_Adminhtml_Controller_Action {

    protected function _initAction() {

        $this->loadLayout()
                ->_setActiveMenu('customer/guestinfo_adminform')
                ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));

        return $this;
    }

    public function indexAction() {

        $this->_initAction();       

        $this->_addContent($this->getLayout()->createBlock('mapmygenomie_guestinfo/adminhtml_guestinfo'));

        $this->renderLayout();
    }

    /**

     * Product grid for AJAX request.

     * Sort and filter result for example.

     */
    public function gridAction() {

        $this->loadLayout();
        $this->getResponse()->setBody(
                $this->getLayout()->createBlock('mapmygenomie_guestinfo/adminhtml_guestinfo_grid')->toHtml()
        );
    }

    /**
     * Export customer grid to CSV format
     */
    public function exportCsvAction() {
        $fileName = 'customersCSV.csv';

        $content = $this->getLayout()->createBlock('mapmygenomie_guestinfo/adminhtml_guestinfo_grid')
                ->getCsvFile();

        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * Export customer grid to XML format
     */
    public function exportXmlAction() {
        $fileName = 'customersXML.xml';
        $content = $this->getLayout()->createBlock('mapmygenomie_guestinfo/adminhtml_guestinfo_grid')
                ->getExcelFile();

        $this->_prepareDownloadResponse($fileName, $content);
    }

}
