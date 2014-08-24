<!-- app/View/Users/add.ctp -->
<div class="users form col-lg-6">
    <?php echo $this->Form->create('User', array("class" => "toto")); ?>
    <fieldset>
        <legend><?php echo __('Ajouter User'); ?></legend>
        <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('role', array(
            'options' => array('admin' => 'Admin', 'auteur' => 'Auteur')
        ));
        ?>
    </fieldset>
<?php echo $this->Form->end(__('Ajouter')); ?>
</div>
<?php 
    echo $this->Form->create('User', array("class" => "form-signin col-lg-4",
                                             "role" => "form"));     
?>
    <h2 class="form-signin-heading">S'inscrire</h2>    
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
                                "class" => "btn btn-lg btn-primary")); 
?>

    
    