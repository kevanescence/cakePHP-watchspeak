<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP Helper
 * @author kremy
 */
class FlashHelper extends AppHelper {

    public $helpers = array('Session');
    public $settings = null;
    public $view = null;
    
    public function error() {        
        return $this->Session->flash(FlashComponent::ERROR_NAME, 
                              array('element' => FlashComponent::ELEMENT_NAME,
                                    'params' => array('style' => FlashComponent::ERROR_NAME)));
    }
    public function warning() {
        return $this->Session->flash(FlashComponent::WARNING_NAME,
                              array('element' => FlashComponent::ELEMENT_NAME,
                                    'params' => array('style' => FlashComponent::WARNING_NAME)));
    }
    public function information() {
        return $this->Session->flash(FlashComponent::INFO_NAME,
                              array('element' => FlashComponent::ELEMENT_NAME,
                                    'params' => array('style' => FlashComponent::INFO_NAME)));
    }
    public function validation() {
        return $this->Session->flash(FlashComponent::VALID_NAME,
                              array('element' => FlashComponent::ELEMENT_NAME,
                                    'params' => array('style' => FlashComponent::VALID_NAME)));
    }
    
    /**
     * Display one of the previous set flash messages considering their priority
     * Display prioritly: error, warning, validation, information
     */
    public function priority(){
        $tmp = self::error();
        if($tmp != ""){
            return $tmp;
        }
        $tmp = self::warning();
        if($tmp != ""){
            return $tmp;
        }
        $tmp = self::validation();
        if($tmp != ""){            
            return $tmp;
        }
        $tmp = self::information();
        if($tmp != ""){
            return $tmp;
        }                                    
    }
}
