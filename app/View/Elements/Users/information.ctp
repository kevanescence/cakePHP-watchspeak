<?php
$this->append("css", $this->Html->css("Users/information"));
$this->append("script", $this->Html->script("Users/information"));
if (!isset($text))
    $text = "";
if (!isset($class))
    $class = "";
if ($hasRight) {
    echo $this->Form->create('User', array(
                                        'role' => 'form',
                                        'inputDefaults' => array(
                                        'class' => 'form-control',
                                        'div' => array('class' => 'form-group')),
                                        'url' => array('controller' => 'users',
                                        'action' => 'edit',
                                        $user['User']['id'])));
    echo $this->Form->input('id', array('type' => 'hidden', 
                                        'value' => $user['User']['id']));
}
?>
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
<div class="input-group">
    <span class="input-group-addon  glyphicon glyphicon-user"></span>
    <?php
    if($hasRight) {
        echo $this->Form->input("User.name", array('label' => false,
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Nom',
                                                    'value' => $user['User']['name']));
    } else {
        echo $this->Html->tag("span", $user['User']['name']
                                    , array('class' => "form-control"));
    }
    ?>
</div>
<div class="input-group">
    <span class="input-group-addon glyphicon glyphicon-user"></span>
    <?php
    if($hasRight) {
        echo $this->Form->input("User.firstname", array('label' => false,
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Prénom',
                                                    'value' => $user['User']['firstname']));
    } else {
        echo $this->Html->tag("span", $user['User']['firstname']
                                    , array('class' => "form-control"));
    }
    ?>
</div>
<div id="birthdayDiv" class="input-group">
    <span class="input-group-addon  glyphicon glyphicon-gift"></span>
    <?php
    if($hasRight) {
        echo $this->Form->input("User.birthday", array('label' => false,
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Prénom',
                                                    'dateFormat' => 'DMY',
                                                    'div' => false,
                                                    'value' => $user['User']['birthday']));
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
                                              'value' => 'm',
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
        echo $this->Form->end(array("label" => "Enregistrer",
                                    "id" => "btn-save-info",
                                     'div' => false,
                                    "class" => "btn btn-md btn-success"));
    }
 ?>