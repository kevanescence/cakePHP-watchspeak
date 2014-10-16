
<?php       
             $this->Paginator->options(array(
        'update' => '#publications-content',
        'evalScripts' => true,
        'before' => $this->Js->get('#busy-indicator')->effect(
                'fadeInf', array('buffer' => false))
        ,
        'complete' => 'updatePagination("#publications")'
    ));
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
    if (count($posts)) {
        echo $this->Paginator->prev("<<", array('tag' => "li",
            'title' => 'Page précédente',
            'model' => 'UserPosts'));
        echo $this->Paginator->numbers(array('tag' => "li",
            'separator' => false,
            'class' => 'disable',
            'currentClass' => 'active',
            "model" => 'UserPosts'
        ));
        echo $this->Paginator->next(">>", array('tag' => "li",
            'title' => 'Page suivante',
            'model' => 'UserPosts'));
    } else {
        echo $this->element('Messages/alert-info', array('text' => 'Pas de publication'));
    }
    ?>
</ul> 