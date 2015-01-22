<section class="postAndComments">
    <article class="post" title="">
        <a class="author" href="<?= $this->Html->url(array('controller' => 'Users',
                                                           'action' => 'view',
                                                            $author_id, 'infos'));?>"
                 title="Voir son profil"><?=$author?></a>
        <time datetime="2014-10-03">
            <?= "le " . date("d F Y \à H:i:s",strtotime($created))?>
        </time>
        <?php    
        echo $this->Form->postLink('X',
                   array('controller'=>'posts','action' => 'delete', $id),
                   array('class' => 'corner fold delete',
                         'confirm' => 'Etes-vous sûr ?'));?>
        <p><?=$message?></p>
        <a href="#" class="display-comments"><?=$nbComments?></a>
    </article>
    <?php
    echo $this->Form->create('Comment', array('novalidate' => 'novalidate',
                                            'class' => 'comment',
                                            'controller' => 'Comment',
                                            'action' => 'add',
                                            'id' => 3));
    echo $this->Form->input('body', array('rows' => 10, 
                                          'cols' => 30,
                                          'label'=>false,
                                          'div' => false,
                                          'placeholder'=>'Commentez ...'));
    echo $this->Form->input('post_id', array('type' => 'hidden', 'value'=>$id));    
    echo $this->Form->end('Valider');
    ?>
    <section class="comments">
        <?php
        foreach ($comments as $comment) {
            $option = array('body' => $comment['body'], 
                            'username' => $comment['owner']['username'],
                            'date' => $comment['created'],
                            'id' => $comment['id']);
            echo $this->element("Comments/view", $option);    
        }
        ?>
    </section>
</section>
