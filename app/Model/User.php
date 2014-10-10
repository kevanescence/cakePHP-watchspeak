<?php

// app/Model/User.php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

    public $name = 'User';
    public $validate = array(
        'username' => array(
            'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'required' => true,
                'message' => 'Chiffres et lettres uniquement !'
            ),
            'between' => array(
                'rule' => array('between', 5, 15),
                'message' => 'Entre 5 et 15 caractères'
            ),
            'unique' => array(
                'rule' => array('isUnique'),
                'message' => 'Ce pseudo est déjà utilisé'
            )
         ),
        'firstname' => array(            
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Un mot prénom est requis'
             )
        ),
        'name' => array(            
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Un mot nom est requis'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Un mot de passe est requis'
            ),
            'between' => array(
                'rule' => array('between', 5, 15),
                'message' => 'Entre 5 et 15 caractères'
            )
        ),
        'email' => array(
            'rule' => "email",
            'message' => 'Veuillez entrer un mail valide'
        ),
        'birthday' => array(
            'rule'       => 'date',
            'message'    => 'Entrez une date valide',
        ),
        'sexe' => array(
            'valid' => array(
                'rule' => array('inList', array('m', 'f')),
                'message' => 'Merci de rentrer un sexe valide'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'user')),
                'message' => 'Merci de rentrer un rôle valide',
                'allowEmpty' => false
            )
        )
    );
    
    public $hasMany = array(
        'UserPosts' => array(
            'className' => 'Post',
            'order' => array('id' => 'DESC')            
        )
    );
    
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                    $this->data[$this->alias]['password']
            );
        }
        return true;
    }
    
}

?>
