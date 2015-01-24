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
    public $recursive = -1;
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
            'foreignKey' => 'post_id',
            'limit' => 3,
            'order' => array('post_comments.id' => 'DESC')            
        )
    );

    /**
     * Return true if the post belongs to the given user id 
     * @param   <int> $post the post id to check
     * @param   <int> $user the user id to check
     * @return  <bool> 
     */
    public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
    }
    
    /**
     * Return true if the post belongs to the given user id or
     *  belongs to one of his friend
     * @param   <int> $postId the post id to check
     * @param   <int> $userId the user id to check
     * @return  <bool> 
     */    
    public function isOwnedByAFriend($postId, $userId) {       
        $options =  array(            
            'joins' => array(
                array(
                    'fields' => 'friends.id',
                    'table' => 'friends',
                    'alias' => 'UsersFriend',
                    'type' => 'inner',
                    'conditions' => array(
                        'UsersFriend.friend_id = commented_post.user_id',
                    ),
                )),
            'conditions' => array('UsersFriend.user_id' => $userId,
                                  'commented_post.id' => $postId));
        $res = $this->find('all',$options);
        //debug($res);die();
        return count($res) != 0;                
    }
}
