<?php
$this->append("css", $this->Html->css("Users/information"));
$this->append("script", $this->Html->script("Users/information"));
$hasRight = AuthComponent::user('id') == $user['User']['id'] 
            || AuthComponent::user('role') == 'admin';
?>

<div class="col-lg-5 user-badge-section">
    <?= $this->element('Users/badge', array('id' => $user['User']['id'],
                                            'cssClass' => "col-lg-12 col-md-12 col-sm-12 col-xs-12",
                                            'username' => $user['User']['username']));?> 
    <?php 
    if($hasRight) {
    ?><a href="" class="col-lg-10 col-lg-offset-1 btn btn-success btn-chg-picture"><span class=" glyphicon glyphicon-cloud-upload"></span> Changer la photo</a>
    <?php }
    ?>
</div>
<div class="col-md-7">
<?php

if ($hasRight) {
    echo $this->Form->create('User', array(
                                        'role' => 'form',
                                        'inputDefaults' => array(
                                            'class' => 'form-control',
                                            'div' => array('class' => 'form-group')),
                                        'url' => array('controller' => 'users',
                                        'action' => 'edit',
                                        $user['User']['id'])));
    if($settable) {
        echo "<fieldset>" . $this->Html->tag('legend', 'Modificaitons des informations');    
    }
    echo $this->Form->input('id', array('type' => 'hidden', 
                                        'value' => $user['User']['id']));
}
?>
<div class="input-group col-lg-12 col-md-12 col-xs-12 col-sm-12">    
    <?php
    if($hasRight) {
        echo $this->Form->input("User.name", array('label' => 'Nom',
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Nom',
                                                    'value' => $user['User']['name']));
    } else {
        echo $this->Html->tag("span", $user['User']['name']
                                    , array('class' => "form-control"));
    }
    ?>
</div>
<div class="input-group col-lg-12 col-md-12 col-xs-12 col-sm-12">    
    <?php
    if($hasRight) {
        echo $this->Form->input("User.firstname", array('label' => 'Prénom',
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Prénom',
                                                    'value' => $user['User']['firstname']));
    } else {
        echo $this->Html->tag("span", $user['User']['firstname']
                                    , array('class' => "form-control"));
    }
    ?>
</div>
<div class = "input-group">
    <span class="input-group-addon  glyphicon glyphicon-user"></span>
    <?php
    if($hasRight) {        
        echo $this->Form->input("User.username", array('label' => false,
                                                       'class' => 'form-control',
                                                       'placeholder' => 'Pseudo',
                                                       'value' => $user['User']['username']));
    } else {
        echo $this->Html->tag("span", $user['User']['username']
                                    , array('class' => "form-control"));
    }
    ?>
</div>
<div id="birthdayDiv" class="input-group">
    <span class="input-group-addon  glyphicon glyphicon-gift"></span>
    <?php
    $birthday = $user['User']['birthday'];
    if($hasRight) {
        
        if(is_string($birthday)) {
            $birthday = explode("-", $birthday);
            $year = $birthday[0];
            $month = $birthday[1];
            $day = $birthday[2];  
        }
        else {
            $year = $birthday["year"];
            $month = $birthday["month"];
            $day = $birthday["day"];  
        }        
                    

        echo $this->Form->day('User.birthday', array('class' => 'form-control',
            'empty' => false,
            'value'=>$day));
        echo $this->Form->month('User.birthday', array('class' => 'form-control',
            'empty' => false,
            'value'=>$month));
        echo $this->Form->year('User.birthday', date('Y') - 100, date('Y') - 13, 
                                array('class' => 'form-control',
                                      'empty' => false,
                                      'value'=>$year));
        
    } else {
        echo $this->Html->tag("span", $user['User']['birthday']
                                    , array('class' => "form-control"));
    }
    ?>
</div>
<div class="input-group">
    <span class="input-group-addon glyphicon">@</span>
    <?php
    if($hasRight) {
        echo $this->Form->input("User.email", array('label' => false,                                                    
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Email',
                                                    'value' => $user['User']['email']));
    } else {
        echo $this->Html->tag("span", $user['User']['email']
                                    , array('class' => "form-control"));
    }
    ?>
</div>
<div class="input-group">    
    <?php
    if($hasRight) {
        echo $this->Form->radio("sexe", array( 'm' => 'Homme',
                                               'f' => 'Femme'),
                                        array('legend'=>false,
                                              'value' => $user['User']['sexe'],
                                              'class' => 'btn btn-default'));
    } else {
        $sexe = $user['User']['sexe']=='m'?'Homme':'Femme';
        echo $this->Html->tag("span",$sexe,
                                      array('class' => "form-control"));
    }
    ?>
</div>
<div class="input-group">
    <span class="input-group-addon glyphicon glyphicon-film"></span>
    <span class="form-control">Bienvenu à Gattaca</span>
</div>
<?php    
    if($hasRight) {
        echo $this->Html->link('Annuler' , array('controller' => 'users',
                                                 'action' => 'view', $user['User']['id'] ),
                                           array('class' => 'btn btn-danger'
                                               . ' col-lg-4 col-lg-offset-1'
                                               . ' col-sm-4 col-sm-offset-1'
                                               . ' col-md-4 col-md-offset-1'
                                               . ' col-xs-4 col-xs-offset-1',
                                                 'id' => 'btn-cancel'));
        echo $this->Form->end(array("label" => "Enregistrer",
                                    "id" => "btn-save-info",
                                     'div' => false,
                                    "class" => "btn btn-md btn-success "
                                                . "col-lg-4 col-lg-offset-2"
                                                ." col-sm-4 col-sm-offset-2"
                                                .' col-md-4 col-md-offset-2'
                                                ." col-xs-4 col-xs-offset-2"));
    }
 ?>
    </fieldset>
</div>