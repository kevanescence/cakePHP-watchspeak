<div class="<?= $cssClass ?> user-badge">
    <img src="http://lorempixel.com/150/150/" alt="" />   
    <?= $this->Html->link($username,
                            array('controller' => 'Users',
                                'action' => 'view',
                                 $id),
                            array('class' => 'username'));?>    
    <div class="stats">
        <span class="glyphicon glyphicon-eye-open">56</span>
        <span class="glyphicon glyphicon-user">42</span>
    </div>
    <?php
    
    if(AuthComponent::user('id') != $id) {
        ?>       
    <?php 
    echo $this->Form->create('User', array('controller' => 'users', 'action' => 'addFriend'));
    $css = 'col-lg-10 col-lg-offset-1 col-md-4 col-md-offset-4 '.
           'col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2 '.
           'btn btn-primary btn-add-friend ' ;
    echo $this->Form->input('friends1.receives_id', array('type' => 'hidden', 'value' => $id));
    echo $this->Form->input('id', array('type' => 'hidden',
                                        'value' => AuthComponent::user('id')));
    echo $this->Form->end(array('label' => 'Ajouter en ami', 'class' => $css));
    }
    ?>
</div>