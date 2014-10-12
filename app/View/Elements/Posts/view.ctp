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
