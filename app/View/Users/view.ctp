<?php $this->append("css",$this->Html->css("Posts/posts"));?>
<ul class="nav nav-tabs container" role="tablist">  
    <li class="<?php if($onglet==="infos") echo "active "?>">
        <a href="#infos" role="tab" data-toggle="tab">Infos</a>
    </li>
    <li class=" <?php if($onglet==="publications") echo "active ";?>">
        <a href="#publications" role="tab" data-toggle="tab">Publications</a>
    </li>
    <li class="<?php if($onglet==="friends") echo "active ";?>">
        <a href="#friends" role="tab" data-toggle="tab">Amis</a>
    </li>
</ul>
<div class="tab-content">   
    <div class="tab-pane <?php if($onglet==="infos") echo "active ";?>
         container" id="infos">
        <?= $this->element("Users/information", array('user' => $user)); ?>
    </div>
    <div class="tab-pane <?php if($onglet==="publications") echo "active ";?>
                container" id="publications">
        <?php
        if(AuthComponent::user('id') == $user['User']['id']) {
            echo $this->element('Posts/create');
        }           
        foreach ($posts as $post):            
            $option = array(
                'message' => $post['UserPosts']['body'],
                'author' => $post['owner']['username'],
                'author_id' => $post['owner']['id'],
                'created' => $post['UserPosts']['created'],
                'id' => $post['UserPosts']['id'],
                'nbComments' => $post['UserPosts']['nbComments']
            );
            echo $this->element('Posts/view', $option);
        endforeach;
        ?>
        <ul class="pagination pagination-md col-md-offset-4">
            <?php
                if(count($posts)){
                    echo $this->Paginator->prev("<<",array('tag' => "li",
                                                           'title' => 'Page précédente'));
                    echo $this->Paginator->numbers(array('tag' => "li",
                                                    'separator' => false,
                                                    'class' => 'disable',
                                                    'currentClass' => 'active'
                                                    ));
                    echo $this->Paginator->next(">>",array('tag' => "li",
                                                          'title' => 'Page suivante'));
                }
                else {
                     echo $this->element('Messages/alert-info', 
                                        array('text' => 'Pas de publication'));
                }
            ?>
        </ul> 
    </div>
    <div class="tab-pane container  <?php if($onglet==="friends") echo "active ";?>" id="friends">...</div>
</div>