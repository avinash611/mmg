<?php

class Mapmygenomie_Testimonial_IndexController extends Mage_Core_Controller_Front_Action {

    /**
     * function for index action
     *
     * @return void()
     * */
    public function indexAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

}
