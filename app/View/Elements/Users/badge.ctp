<?php
/** parameter lists:
 *          - $username     : the username
 *          - $id           : the user id
 *          - $userAction   : [delete|add] determines if the element has to
 *                           display a delete friend or add friend link. 
 */
?>
<?php
    //For compatibility purpose
    if(!isset($userAction)) {
        $userAction = "add";
    }
?>
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
    if (AuthComponent::user('id') != $id) {
        $css = 'col-lg-10 col-lg-offset-1 col-md-4 col-md-offset-4 ' .
                'col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2 ' .
                'btn ';
        $tmpAction;
        $textButton;
        if ($userAction == "add") {
            $css .= 'btn-primary btn-add-friend';
            $tmpAction = "addFriend";
            $textButton = "Ajouter en ami";
        } else {
            $tmpAction = "deleteFriend";
            $css .= 'btn-danger btn-delete-friend';
            $textButton = "Supprimer des amis";
        }
        echo $this->Form->create('User', array('controller' => 'users',
            'action' => $tmpAction));
        echo $this->Form->input('friends1.receives_id', array('type' => 'hidden',
            'value' => $id));
        echo $this->Form->input('id', array('type' => 'hidden',
            'value' => AuthComponent::user('id')));
        echo $this->Form->end(array('label' => $textButton, 'class' => $css));
    }
    ?>
</div>