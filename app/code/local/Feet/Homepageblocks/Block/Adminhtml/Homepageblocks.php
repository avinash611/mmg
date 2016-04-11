<?php
/**
 * @category    22Feet
 * @package     Feet_HomepageBlocks
 * @author      Chanchal Sarkar <chanchal@22feet.in>
 */
class Feet_Homepageblocks_Block_Adminhtml_Homepageblocks extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_controller = 'adminhtml_homepageblocks';
        $this->_blockGroup = 'homepageblocks';
        $this->_headerText = Mage::helper('homepageblocks')->__('Item Manager');
        $this->_addButtonLabel = Mage::helper('homepageblocks')->__('Add Item');
        parent::__construct();
    }

    public function resizeHomepageImage($imgname, $width, $height, $path) {
        try {
            /* Starting upload */
            $uploader = new Varien_File_Uploader($imgname);

            // Any extention would work
            $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
            $uploader->setAllowRenameFiles(false);

            // Set the file upload mode 
            // false -> get the file directly in the specified folder
            // true -> get the file in the product like folders 
            //	(file.jpg will go in something like /media/f/i/file.jpg)
            $uploader->setFilesDispersion(false);

            // We set media as the upload dir

            $uploader->save($path, $_FILES[$imgname]['name']);
            $imageUrl = $path . $_FILES[$imgname]['name'];
            $imageResized = $path . 'resized' . DS;
            if (is_writable($imageResized) && is_file($imageUrl)) :
                $imageObj = new Varien_Image($imageUrl);
                $imageObj->keepFrame(FALSE);
                $imageResized = $path . 'resized' . DS . $_FILES[$imgname]['name'];
                $imageObj->resize($width, $height);
                $imageObj->save($imageResized);
            endif;
        } catch (Exception $e) {
            Mage::logException($e);
        }
    }

}