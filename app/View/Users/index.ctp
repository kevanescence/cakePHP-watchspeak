<!--Bienvenue<br/>-->
<?php $this->append("css", $this->Html->css("Users/home")); ?>
<?= $this->Session->read('Auth.User.username'); ?>
<br/><div class="col-lg-4 col-md-4"></div>
<section title="actualités" class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
    <div class="ribbon-wrapper">
        <header class="ribbon-front">
            Actualités de vos amis
        </header>
        <div class="ribbon-edge-topleft"></div>
        <div class="ribbon-edge-topright"></div>
        <div class="ribbon-edge-bottomleft"></div>
        <div class="ribbon-edge-bottomright"></div>
        <div class="ribbon-back-left"></div>
        <div class="ribbon-back-right"></div>
        <div id="recent-posts">
            <?php 
            echo $this->element('Posts/create');               
            foreach ($posts as $post):                
                $option = array(
                  'message' => $post['UserPosts']['body'],
                  'author'  => $post['owner']['username'],
                  'created' => $post['UserPosts']['created'],
                  'id'      => $post['UserPosts']['id']
                );
                echo $this->element('Posts/view', $option);
            endforeach;
            ?>
        </div>
    </div>
</section>
