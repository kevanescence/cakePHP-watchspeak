<!-- Fichier : /app/View/Posts/view.ctp -->
<?php
$this->append("css", $this->Html->css("Posts/posts"));
$option = array(
    'message' => $post['Post']['body'],
    'author' => $post['owner']['username'],
    'created' => $post['Post']['created'],
    'id' => $post['Post']['id']
);
echo $this->element("Posts/view", $option);
?>
