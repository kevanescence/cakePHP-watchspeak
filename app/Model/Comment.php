<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Comment
 * @author kremy
 */
class Comment extends AppModel {
    public $validate = array(
        'body' => array(
            'rule' => 'notEmpty'
        )
    );
    
    public $belongsTo = array(
        'commented_post' => array(
            'className' => 'Post',
            'foreignKey' => 'post_id'
        ),
        'owner' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'fields'=> array('username','id')
        )
    );
        
}
