<?php
/**
 * @category    22Feet
 * @package     Feet_HomepageBlocks
 * @author      Chanchal Sarkar <chanchal@22feet.in>
 */
class Feet_Homepageblocks_Block_Adminhtml_Homepageblocks_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'homepageblocks';
        $this->_controller = 'adminhtml_homepageblocks';

        $this->_updateButton('save', 'label', Mage::helper('homepageblocks')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('homepageblocks')->__('Delete Item'));

        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
                ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('homepageblocks_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'homepageblocks_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'homepageblocks_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText() {
        if (Mage::registry('homepageblocks_data') && Mage::registry('homepageblocks_data')->getId()) {
            return Mage::helper('homepageblocks')->__("Edit Homepage Blocks %s", $this->htmlEscape(Mage::registry('homepageblocks_data')->getTitle()));
        } else {
            return Mage::helper('homepageblocks')->__('Add Homepage Blocks');
        }
    }

}