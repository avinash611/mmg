<?php

class Mapmygenomie_Customerenquiry_Block_Adminhtml_Customerenquiry_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('customerenquiry_form', array('legend' => 'Doctor Section'));

        $fieldset->addField('doctor_comment', 'text', array(
            'label' => 'Doctor Comment',
            'class' => 'required-entry',
            'required' => true,
            'name' => 'doctorcomment',
        ));
        if (Mage::registry('mapmygenomie_customerenquiry_data')->getDoctorReport()) {
            $filepath_link = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'customer_reports/' . Mage::registry('mapmygenomie_customerenquiry_data')->getDoctorReport();
        } else {
            $filepath_link = "";
        }
        $settings = array(
            'label' => 'Doctor Report',
            'name' => 'doctor_report',
            'disabled' => false,
            'readonly' => true,
            'after_element_html' => '<p class="note"><a href="'.$filepath_link.'" target="_blank">'.$filepath_link.'</a> <br/><span>Upload .pdf files, Maximum File Upload Size is 4MB</span></p>',
        );

        if (!Mage::registry('mapmygenomie_customerenquiry_data')->getDoctorReport()) {
            $settings['required'] = true;
            $settings['class'] = 'required-entry required-file';
        }
        $fieldset->addField('doctor_report', 'file', $settings);

        $fieldset->addField('notify_customer', 'checkbox', array(
            'label' => Mage::helper('mapmygenomie_customerenquiry')->__('Notify Customer by Email / SMS'),
            'name' => 'is_customer_notified',
            'value' => 1,
            //'checked' => ($model->getFeatured() == 1) ? 'true' : '',
            'onclick' => 'this.value = this.checked ? 1 : 0;',
            'disabled' => false,
            'readonly' => false,
        ));

        if (Mage::registry('mapmygenomie_customerenquiry_data')) {
            $form->setValues(Mage::registry('mapmygenomie_customerenquiry_data')->getData());
        }

        return parent::_prepareForm();
    }

}
