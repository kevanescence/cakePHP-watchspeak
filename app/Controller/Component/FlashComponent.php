<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP Flash
 * @author kremy
 */
class FlashComponent extends Component {

    public $components = array('Session');

    const ERROR_NAME = "error";
    const WARNING_NAME = "warning";
    const INFO_NAME = "info";
    const VALID_NAME = "validation";
    const ELEMENT_NAME = "Messages/flash";
           
    public function setError($message) {
        $this->Session->setFlash($message,null,null,FlashComponent::ERROR_NAME);
    }
    public function setWarning($message) {
        $this->Session->setFlash($message,null,null,FlashComponent::WARNING_NAME);
    }
    public function setInfo($message) {
        $this->Session->setFlash($message,null,null,FlashComponent::INFO_NAME);
    }
    public function setValidation($message) {
        $this->Session->setFlash($message,null,null,FlashComponent::VALID_NAME);
    }   
}
