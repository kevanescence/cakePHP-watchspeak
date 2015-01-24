<?php
//Display posts
foreach ($posts as $post):   
    $option = array(
        'message' => $post['UserPosts']['body'],
        'author' => $post['owner']['username'],
        'author_id' => $post['owner']['id'],
        'created' => $post['UserPosts']['created'],
        'id' => $post['UserPosts']['id'],
        'nbComments' => $post['UserPosts']['nbComments'],
        'comments' => $post['post_comments']
    );
    echo $this->element('Posts/view', $option);
endforeach;

//Configure the pagination tool
$this->Paginator->options(array(
    'update' => '#publications-content',
    'evalScripts' => true,
    'before' => $this->Js->get('#busy-indicator')->effect(
            'fadeInf', array('buffer' => false))
    ,
    'complete' => 'updatePagination("#publications")',
    'url' => array(
        'controller' => 'Users',
        'action' => 'view',$id_user,
        'publications')
));

//Display the pagination
echo $this->element("UI/pagination", 
        array("nbElem" => count($posts),
              "class" => "pagination-md col-md-offset-4",
              "model" => "UserPosts",
              "emptyMessage" => "Pas de publication"));
?>