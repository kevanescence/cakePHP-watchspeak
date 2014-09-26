<?php

class PostsController extends AppController {

    //public $scaffold;
    public $helpers = array('Html', 'Form', 'Session');    

    public function index() {
        $this->set('posts', $this->Post->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post', $post);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Post->create();            
            $this->request->data['Post']['user_id'] = $this->Auth->user('id'); //Ligne ajoutée
            $this->request->data['Post']['title'] = 'bliliblil';
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your post.'));
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Post->delete($id)) {
            $this->Session->setFlash(
                    __('Le post avec id : %s a été supprimé.', h($id))
            );
            return $this->redirect(array('action' => 'index'));
        }
    }
    
    // app/Controller/PostsController.php

public function isAuthorized($user) {
    // Tous les users inscrits peuvent ajouter les posts
    if ($this->action === 'add') {
        return true;
    }
//if (isset($user['role']) && $user['role'] === 'admin') {
//            return true;
//        }
    // Le propriétaire du post peut l'éditer et le supprimer
    if (in_array($this->action, array('edit', 'delete'))) {
                
        $postId = (int) $this->request->params['pass'][0];        
        if ($this->Post->isOwnedBy($postId, $user['id'])) {            
            return true;
        }
    }
//    return false;
    return parent::isAuthorized($user);
}
//public function beforeFilter() {
//    parent::beforeFilter();
//    //$this->allow("add");
//}

//    public function index($id){
//        $this->set("postId",$id);
////        debug($this->Post);
////        echo "Salut!";
//    }
}
