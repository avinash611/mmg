<?php
/**
 * @category    22Feet
 * @package     GuestInfo
 * @author      Binu  <binuconcept@gmail.com,9986442330>
 */

class Mapmygenomie_Guestinfo_IndexController extends Mage_Core_Controller_Front_Action
{
  public function indexAction()
  {
          $this->loadLayout();
          $this->renderLayout();
  }
}