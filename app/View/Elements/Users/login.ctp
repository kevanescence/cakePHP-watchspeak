<?php echo $this->Form->create('User',array(
                                        "class" => "$cssClass",
                                        "role" => "form",
                                        'inputDefaults' => array(
                                            'class' => 'form-control',                                            
                                            'div' => array('class' => 'form-group')),
                                        "action" => "login")); ?>
<fieldset>
    <legend> Connectez vous </legend>
    <?php
      
    echo $this->Form->input('username',array('placeholder'=>'Email','label'=>'Votre email*'));    
    echo $this->Form->input('password',array('placeholder'=>'Mot de passe','label'=>'Votre mot de passe*'));    
    $options = array(
        'label' => 'Se connecter',
        'class' => 'btn btn-success',
        'div' => false
    );
    echo $this->Form->end($options); ?>
</fieldset>