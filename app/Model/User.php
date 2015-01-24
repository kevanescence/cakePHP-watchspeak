<?php

// app/Model/User.php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

    public $recursive = -1;
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
                'message' => 'Un prénom est requis'
             ),
            'alphabet' => array(
                'rule' => '/^[a-zA-Zéèïüêàù]+$/i',
                'message' => 'Uniquement des caractères alphabétiques'
             )            
        ),
        'name' => array(            
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Un nom est requis'
            ),
            'alphabet' => array(
                'rule' => '/^[a-zA-Zéèïüêàù]+$/i',
                'message' => 'Uniquement des caractères alphabétiques'
             )  
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Un mot de passe est requis'
            ),
            'between' => array(
                'rule' => array('between', 1, 15),
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
        ),
        'UserComments' => array(
            'className' => 'Comment',
            'order' => array('id' => 'DESC')            
        )
//        'ReceivedFR' => array(
//            'className' => 'Friend',
//            'foreignKey' => 'receives_id',
//            'order' => array('id' => 'DESC')
//        ),//Sent Friend request
//        'SentFR' => array(
//            'className' => 'Friend',
//            'foreignKey' => 'sends_id',
//            'order' => array('id' => 'DESC')
//        )
    );
    
    public $hasAndBelongsToMany = array(
        'friends' =>
            array(
                'className' => 'User',
                'joinTable' => 'friends',
                'foreignKey' => 'user_id',
                'associationForeignKey' => 'friend_id',
                'unique' => false
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
    
    /**
     * Return true if the  User as the given user as friend
     * @param type $idFriend the id of the userr to check
     */
    public function hasFriend($idUser, $idFriend) {
        $option =  array(            
            'joins' => array(
                array(
                    'fields' => 'friends.id',
                    'table' => 'friends',
                    'alias' => 'UsersFriend',
                    'type' => 'inner',
                    'conditions' => array(
                        'UsersFriend.friend_id = friends.id',
                    ),
                )),
            'conditions' => array('UsersFriend.user_id' => $idUser,
                                  'friends.id' => $idFriend));
        return count($this->friends->find('all',$option)) == true;                
    }
}

?>
