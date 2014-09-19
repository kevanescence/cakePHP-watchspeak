<?php 
    if(!isset($cssClass)) {
        $cssClass = "";
    }
    echo $this->Form->create('User', array("class" => "form-signin $cssClass",
                                            "role" => "form",
                                            "action" => "add"));     
?>
    <legend>S'inscrire</legend>    
<?php
    echo $this->Form->input("email", array("class" => "form-control",
                                           "label" => "Votre email*",
                                           "placeholder" => "Votre email",
                                           ));
    echo $this->Form->input("username", array("class" => "form-control",
                                           "label" => "Votre pseudo*",
                                           "placeholder" => "Votre pseudo",
                                           ));
    echo $this->Form->input("firstname", array("class" => "form-control",
                                               "label" => "Votre prénom*",
                                               "placeholder" => "Votre prénom"));
    echo $this->Form->input("name", array("class" => "form-control",
                                               "label" => "Votre nom*",
                                               "placeholder" => "Votre nom"));
    echo $this->Form->radio("sexe", array('m' => 'Homme',
                                         'f' => 'Femme'),
                                    array('legend'=>false,
                                          'value' => 'm'));
    
    echo $this->Form->input('birthday', array( 'label' => 'Date de naissance*',
                                               'dateFormat' => 'DMY',
                                               'minYear' => date('Y') - 70,
                                               'maxYear' => date('Y') - 18 ));

    echo $this->Form->input("password", array("class" => "form-control",
                                              "label" => "Mot de passe*",
                                              "placeholder" => "Votre mot de passe"));
    
    echo $this->Form->input("conf-password", array("class" => "form-control",
                                              "label" => "Confirmation*",
                                              "type" => "password",
                                              "placeholder" => "Confirmation mot de passe"));
    
    echo $this->Form->end(array("label" => "S'incrire",
                                "id" => "btn-login",
                                "class" => "btn btn-lg btn-primary")); 
?>