<?php $this->append("css", $this->Html->css("Posts/posts")); ?>
<ul class="nav nav-tabs container" role="tablist">  
    <li class="<?php if ($onglet === "infos") echo "active " ?>">
        <a href="#infos" role="tab" data-toggle="tab">Infos</a>
    </li>
    <li class=" <?php if ($onglet === "publications") echo "active "; ?>">
        <a href="#publications" role="tab" data-toggle="tab">Publications</a>
    </li>
    <li class="<?php if ($onglet === "friends") echo "active "; ?>">
        <a href="#friends" role="tab" data-toggle="tab">Amis</a>
    </li>
</ul>
<div class="tab-content">   
    <div class="tab-pane <?php if ($onglet === "infos") echo "active "; ?>
         container" id="infos">
         <?= $this->element("Users/information", array('user' => $user)); ?>
    </div>
    
    <div class="tab-pane <?php if ($onglet === "publications") echo "active "; ?>
         container" id="publications">
        <?php
         if (AuthComponent::user('id') == $user['User']['id']) {
             echo $this->element('Posts/create');
         }
         ?>
        <div id="publications-content">            
            <?php
            echo $this->element("Posts/page", array('posts' => $posts));
         
            echo $this->Js->writeBuffer(); ?>
         </div>
    </div>   
    <div class="tab-pane container  <?php if ($onglet === "friends") echo "active "; ?>" id="friends">
        <div id="content">
            <?= $this->element("Users/page", array('users' => $friends));?>
            <?php echo $this->Js->writeBuffer(); ?>
            </div>
        
    </div>
</div>

