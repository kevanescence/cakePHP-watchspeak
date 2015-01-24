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

    public function isAuthorized($user) {
        $user_id = $this->Auth->user('id');
        //TODO: check user is a friend or self user
        if ($this->action === 'add') {            
            return true;
        }
        //TODO: The owner of the comment or the owner of the post can delete the comment
        if (in_array($this->action, array('delete'))) {
//            $commentId = (int) $this->request->params['pass'][0];
//            if ($this->Post->isOwnedBy($postId, $user['id'])) {
                return true;
            //}
        }
        //Default checking
        return parent::isAuthorized($user);
    }

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

    public function add() {
        $post_id = $this->request->data['Comment']['post_id'];
        $user_id = $this->Auth->user('id');

        if ($this->request->is('post')) {

            //The user is not authorized to comment the given post
            if (!is_numeric($post_id) ||
                    !$this->Comment
                    ->commented_post->isOwnedByAFriend($post_id, $user_id)) {
                $this->Flash->setError(__("Vous ne pouvez pas commenter ce post"));
                return $this->redirect($this->referer());
            }

            $this->Comment->create();
            $this->request->data['Comment']['user_id'] = $user_id;
            if ($this->Comment->save($this->request->data)) {
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('Ajout de commentaire impossible.'));
        }
    }

}
