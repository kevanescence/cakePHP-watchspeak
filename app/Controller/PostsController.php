<?php

class PostsController extends AppController {

    //public $scaffold;
    public $helpers = array('Html', 'Form', 'Session');    
    public $components = array('Paginator');
    
    public $paginate = array(
        'limit' => 2,
        'order' => array(
            'Post.id' => 'desc'
        )
    );
    
    public function index() {
        //$this->set('posts', $this->Post->find('all'));
        $this->Paginator->settings = $this->paginate;
        $this->Post->recursive = 2;
        $this->set('posts',$this->Paginator->paginate());        
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
                return $this->redirect($this->referer());
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
            return $this->redirect(array('controller' => 'users',
                                         'action' => 'index'));
        }
    }
    
    // app/Controller/PostsController.php

public function isAuthorized($user) {
    // All user can add the post
    if ($this->action === 'add') {
        return true;
    }
    // The post owner can edit the post and delete it
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
