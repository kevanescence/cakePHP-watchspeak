<section class="comment">    
    <div class="comment-body">
        <p class="comment">
            <?=$body?>
        </p>
        <?php echo $this->Form->postLink('X',
                   array('controller'=>'comments','action' => 'delete', $id),
                   array('class' => 'delete',
                         'confirm' => 'Etes-vous sûr de supprimer ce commentaire?'));?>
    </div>            
    <span class="comment-triangle"></span>
    <a href="" class="pseudo"><?= $username ?></a>
    <span class="date"><?= $date ?></span>
</section>
