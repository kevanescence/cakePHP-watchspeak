<?php

// app/Controller/UsersController.php
class UsersController extends AppController {

    public $components = array('Paginator');
    public $paginate = array(
        'limit' => 2,
        'order' => array(
            'Post.id' => 'desc'
        )
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout', 'login');
        //$this->Auth->deny('view');
    }

    public function isAuthorized($user) {
        // For view actions, current user has to be the integorated one ...        
        if (in_array($this->action, array('view', 'edit'))) {
            return true;
            $userId = (int) $this->request->params['pass'][0];
            if ($userId == $this->Auth->user('id')) {
                return true;
            }
        }
        // .. or have the default rules
        return parent::isAuthorized($user);
    }

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__("Nom d'user ou mot de passe invalide, réessayer"));
            }
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function index() {
        $this->User->recursive = 0;

        $option = array('order' => array('created DESC'),
            'limit' => '5');
        //$data = $this->Paginator->paginate('Recipe');
        $this->Paginator->settings = $this->User->UserPosts > paginate;

        $this->set('posts', $this->Paginator->paginate()); //User->UserPosts->find('all', $option));
        //$this->Paginator->settings = $this->paginate;
        //$this->set('posts', $this->User->UserPosts->find('all', $option));

        $this->set('users', $this->paginate());
    }

    public function view($id = null, $onglet = 'infos') {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('User invalide'));
        }
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings = array(
            'limit' => '5',
            'conditions' => array('UserPosts.user_id' => $id)
        );
        $this->set('posts', $this->Paginator->paginate('UserPosts'));
        //$this->set('posts', $this->User->UserPosts->find('all', $option));
        $this->set('user', $this->User->read(null, $id));
        $this->set('onglet', $onglet);
    }

    /**
     * Add a user considering the data posted. If success, log the user in and
     * redirect to the users' index page.
     * @return type
     */
    public function add() {
        //If something is posted
        if ($this->request->is('post')) {
            $this->User->create();
            //Try to save the user
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Vous voilà inscrit'));
                //Connect him and redirect
                $id = $this->User->id;
                $this->request->data['User'] = array_merge(
                        $this->request->data['User'], array('id' => $id)
                );
                $this->Auth->login($this->request->data['User']);
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('L\'user n\'a pas été sauvegardé. Merci de réessayer.'));
            }
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('User Invalide'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('L\'user a été sauvegardé'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('L\'user n\'a pas été sauvegardé. Merci de réessayer.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        $this->request->onlyAllow('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('User invalide'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User supprimé'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('L\'user n\'a pas été supprimé'));
        return $this->redirect(array('action' => 'index'));
    }

}
