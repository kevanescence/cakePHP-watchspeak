<!--Bienvenue<br/>-->
<?php $this->append("css", $this->Html->css("Users/home")); 
$this->append("script", $this->Html->script("Posts/home"));
?>
<div class="col-lg-4 col-md-4"></div>
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
                  'message' => $post['Post']['body'],
                  'author'  => $post['owner']['username'],
                  'author_id'  => $post['owner']['id'],
                  'created' => $post['Post']['created'],
                  'id'      => $post['Post']['id'],
                  'nbComments' => $post['Post']['nbComments'],
                  'comments' => $post['post_comments']
                );
                echo $this->element('Posts/view', $option);
            endforeach;         
            ?> <ul class="pagination pagination-md col-md-offset-4">
            <?php
                if(count($posts) >= 0) {
                    echo $this->Paginator->prev("<<",array('tag' => "li",
                                                       'title' => 'Page précédente'));
                    echo $this->Paginator->numbers(array('tag' => "li",
                                                    'separator' => false,
                                                    'class' => 'disable',
                                                    'currentClass' => 'active'
                                                    ));
                    echo $this->Paginator->next(">>",array('tag' => "li",
                                                          'title' => 'Page suivante'));
                }
                else {
                    echo $this->element('Messages/alert-info', 
                                        array('text' => 'Pas de publication.'));
                }
            ?> </ul>      
        </div>
    </div>
</section>
