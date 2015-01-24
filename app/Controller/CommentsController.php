<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP CommentsController
 * @author kremy
 */
class CommentsController extends AppController {

    private $ERROR_MSG = array('add' => "Vous ne pouvez pas commenter ce post",
                            'delete' => "Suppression du commentaire impossible");    
    
    public function isAuthorized($user) {
        $user_id = $this->Auth->user('id');
        $commented_post = $this->Comment->commented_post;
        
        if($this->action == "add") {
            $post_id = $this->request->data['Comment']['post_id'];            
            
            //Root access
            if(parent::isAuthorized($user)) {
                return true;
            }
            
            //Only owner of the post or one of his friend can add a comment
            if (!$commented_post->isOwnedBy($post_id, $user_id)
                  && !$commented_post->isOwnedByAFriend($post_id, $user_id)){
                $this->Flash->setError($this->ERROR_MSG[$this->action]);
                return $this->redirect($this->referer());
            }
        }

        else if($this->action == "delete") {     
            
            //Root access
            if(parent::isAuthorized($user)) {
                return true;
            }
            
            $comment_id =  $this->request->params['pass'][0];
            $com = $this->Comment->read(null,$comment_id);                
            //Only owner of the post or owner of the comment can delete it
            if (!$commented_post->isOwnedBy($com['Comment']['post_id'], $user_id)
                  && !$this->Comment->isOwnedBy($com['Comment']['id'], $user_id)){
                $this->Flash->setError($this->ERROR_MSG[$this->action]);
                return $this->redirect($this->referer());
            }
        }
                           
        //Default checking
        return parent::isAuthorized($user);
    }

    /**
     * Delete the given comment
     * @param <int> $id the comment id to delete
     * @return type
     * @throws MethodNotAllowedException
     */
    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        
        if ($this->Comment->delete($id)) {
            $this->Flash->setValidation(
                    __('Le commentaire a été supprimé')
            );
            return $this->redirect(array('controller' => 'posts',
                        'action' => 'index'));
        }
    }
    
    /**
     * Add a new comment to a post
     * @return type
     */
    public function add() {
        $post_id = $this->request->data['Comment']['post_id'];
        $user_id = $this->Auth->user('id');
        
                
        if ($this->request->is('post')) {
                      
            //Post id is not numeric (avoid SQL injection)
            if (!is_numeric($post_id)) {
                $this->Flash->setError(__("Vous ne pouvez pas commenter ce post"));
                return $this->redirect($this->referer());
            }
                        
            //Everything is ok, create the comment
            $this->Comment->create();
            $this->request->data['Comment']['user_id'] = $user_id;
            if ($this->Comment->save($this->request->data)) {
                return $this->redirect($this->referer());
            }
            
            $this->Flash->error(__('Ajout de commentaire impossible.'));
        }
    }

}
