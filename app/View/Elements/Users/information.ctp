<?php
$this->append("css", $this->Html->css("Users/information"));
$this->append("script", $this->Html->script("Users/information"));
?>

<div class="col-md-3">
    <img alt="200x200" class="img-responsive" data-src="holder.js/200x200/auto/sky" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMDAiIGhlaWdodD0iMjAwIj48cmVjdCB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iIzBEOEZEQiIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjEwMCIgeT0iMTAwIiBzdHlsZT0iZmlsbDojZmZmO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEzcHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+MjAweDIwMDwvdGV4dD48L3N2Zz4=">
    
    <input id="btn-add-friend" type="button" class="btn btn-primary" value="+ Ajouter en ami" />
</div>
<div class="col-md-4">
<?php
$hasRight = AuthComponent::user('id') == $user['User']['id'] 
            || AuthComponent::user('role') == 'admin';
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
</div>