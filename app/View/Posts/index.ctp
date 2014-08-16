<?php 
$this->assign("title","PostsIndex");
$this->Html->css("posts", null,array("inline"=>false));
?>

<!-- Here is where we loop through our $posts array, printing out post info -->
<?php 
    echo $this->Session->flash();
    echo $this->Html->link(
    'Ajouter un Post',
    array('controller' => 'posts', 'action' => 'add')
); ?>
    <?php foreach ($posts as $post): ?>
    <div>
        <?php echo $post['Post']['id']; ?>
            <?php echo $this->Html->link($post['Post']['title'],
            array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>

    <?php echo $post['Post']['created']; ?>
        <?php echo $this->Html->link(
                'Editer',
                array('action' => 'edit', $post['Post']['id'])
            ); ?>
        <?php echo $this->Form->postLink(
                'Supprimer',
                array('action' => 'delete', $post['Post']['id']),
                array('confirm' => 'Etes-vous sûr ?'));
            ?>
    </div>
    <?php endforeach; 
    unset($post);