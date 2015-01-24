<?php
/** parameter lists:
 *          - $username     : the username
 *          - $id           : the user id
 *          - $isFriend     : [null|true|false] determines if the element has to
 *                              display a delete friend or add friend link.
 */
?>
<?php
    //What kind of button should we display ?
    $userAction = "";
    if(!isset($isFriend)) {
        $userAction = "";
    }
    else if(!$isFriend) {
        $userAction = "add";
    }
    else if($isFriend  
                || AuthComponent::user('role') == 'admin'){
        $userAction = "delete";
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
        } else if($userAction == "delete") {
            $tmpAction = "deleteFriend";
            $css .= 'btn-danger btn-delete-friend';
            $textButton = "Supprimer des amis";
        }
        if($userAction != "") {
            echo $this->Form->create('User', array('controller' => 'users',
                'action' => $tmpAction));
            echo $this->Form->input('friends.friend_id', array('type' => 'hidden',
                'value' => $id));
            echo $this->Form->input('id', array('type' => 'hidden',
                'value' => AuthComponent::user('id')));
            echo $this->Form->end(array('label' => $textButton, 'class' => $css));
        }
    }
    ?>
</div>