<?php
/**
 * @category    22Feet
 * @package     Feet_HomepageBlocks
 * @author      Chanchal Sarkar <chanchal@22feet.in>
 */
class Feet_Homepageblocks_Block_Adminhtml_Homepageblocks_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId('homepageblocks_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle($this->__('Homepage Block Information'));
    }

    protected function _beforeToHtml() {

        $this->addTab('images', array(
            'label' => $this->__('Homepageblocks'),
            'title' => $this->__('Homepageblocks'),
            'content' => $this->getLayout()->createBlock('homepageblocks/adminhtml_homepageblocks_edit_tab_images')->toHtml(),
                )
        );

        $this->addTab('status', array(
            'label' => $this->__('Status'),
            'title' => $this->__('Status'),
            'content' => $this->getLayout()->createBlock('homepageblocks/adminhtml_homepageblocks_edit_tab_status')->toHtml(),
                )
        );

        return parent::_beforeToHtml();
    }

}