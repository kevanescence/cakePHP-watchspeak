<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP post
 * @author kremy
 */
class Post extends AppModel {
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );
    
    public $belongsTo = array(
        'owner' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'fields'=> array('username','id')
        )
    );
    
    public $hasMany = array(
        'post_comments' => array(
            'className' => 'Comment',
            'order' => array('post_comments.id' => 'DESC')            
        )
    );
    
    // app/Model/Post.php

public function isOwnedBy($post, $user) {
    return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
}
}
