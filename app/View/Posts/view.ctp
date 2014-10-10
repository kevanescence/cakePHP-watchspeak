<!-- Fichier : /app/View/Posts/view.ctp -->
<?php
$this->append("css", $this->Html->css("Posts/posts"));
//debug($post);
$option = array(
    'message'   => $post['Post']['body'],
    'author'    => $post['owner']['username'],
    'created'   => $post['Post']['created'],
    'id'        => $post['Post']['id'],
    'nbComments' => $post['Post']['nbComments']
);
echo $this->element("Posts/view", $option);
?>
