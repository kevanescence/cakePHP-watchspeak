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
             $this->Paginator->options(array(
        'update' => '#publications-content',
        'evalScripts' => true,
        'before' => $this->Js->get('#busy-indicator')->effect(
                'fadeInf', array('buffer' => false))
        ,
        'complete' => "updatePagination('#publications-content')",
                 'url' => array(
        'controller' => 'Users',
        'action' => 'view',AuthComponent::user('id'),
        'publications'
    )
    ));
         if (AuthComponent::user('id') == $user['User']['id']) {
             echo $this->element('Posts/create');
         }
         ?>
        <div id="publications-content">
            <?php
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
                                                           'title' => 'Page précédente',
                                                            'model' => 'UserPosts'));
                    echo $this->Paginator->numbers(array('tag' => "li",
                                                    'separator' => false,
                                                    'class' => 'disable',
                                                    'currentClass' => 'active',
                                                    "model" => 'UserPosts'
                                                    ));
                    echo $this->Paginator->next(">>",array('tag' => "li",
                                                          'title' => 'Page suivante',
                                                           'model'=>'UserPosts'));
                }
                else {
                     echo $this->element('Messages/alert-info', 
                                        array('text' => 'Pas de publication'));
                }
            ?>
        </ul> 
            <?php echo $this->Js->writeBuffer(); ?>
         </div>
    </div>
    <?php
    $this->Paginator->options(array(
        'update' => '#content',
        'evalScripts' => true,
        'before' => $this->Js->get('#busy-indicator')->effect(
                'fadeInf', array('buffer' => false))
        ,
        'complete' => 'updatePagination("#content")',
        'url' => array(
        'controller' => 'Users',
        'action' => 'view', AuthComponent::user('id'),
        'friends')
    ));
    ?>
    <div class="tab-pane container  <?php if ($onglet === "friends") echo "active "; ?>" id="friends">
        <div id="content">
<?php
echo $this->Html->image(
        'indicator.gif', array('id' => 'busy-indicator', 'alt' => 'loading...')
);
foreach ($friends as $friend) {
    echo $this->element('Users/badge', array('username' => $friend['friends1']['username']));
}
?>
        
        <ul class="pagination pagination-md col-lg-12 col-md-12 col-sm-12 col-xs-12">
<?php
//echo  $this->Paginator->settings(array('defaultModel' => 'Friends'));                
if (count($friends)) {
    echo $this->Paginator->prev("<<", array('tag' => "li",
        'title' => 'Page précédente',
        'model' => 'friends1'));
    echo $this->Paginator->numbers(array('tag' => "li",
        'separator' => false,
        'class' => 'disable',
        'currentClass' => 'active',
        'model' => 'friends1'
    ));
    echo $this->Paginator->next(">>", array('tag' => "li",
        'title' => 'Page suivante',
        'model' => 'friends1'));
} else {
    echo $this->element('Messages/alert-info', array('text' => 'Pas d\'ami'));
}
?>
        </ul> 
            <?php echo $this->Js->writeBuffer(); ?>
            </div>
        
    </div>
</div>

