<?php
    $this->Paginator->options(array(
        'update' => '#content',
        'evalScripts' => true,
        'before' => $this->Js->get('#busy-indicator')->effect(
                'fadeInf', array('buffer' => false))
        ,
        'complete' => 'updatePagination("#content")'
    ));
                foreach($friends as $friend) {      
                    echo $this->element('Users/badge',
                                 array('username'=>$friend['friends1']['username']));
                }
        ?>
        <ul class="pagination pagination-md col-lg-12 col-md-12 col-sm-12 col-xs-12">
<?php
//echo  $this->Paginator->settings(array('defaultModel' => 'Friends'));                
if (count($friends)) {
    echo $this->Paginator->prev("<<", array('tag' => "li",
        'title' => 'Page précédente',
        'model' => 'friends1'));
    echo $this->Paginator->numbers(array('tag' => "li",
        'separator' => false,
        'class' => 'disable',
        'currentClass' => 'active',
        'model' => 'friends1'
    ));
    echo $this->Paginator->next(">>", array('tag' => "li",
        'title' => 'Page suivante',
        'model' => 'friends1'));
} else {
    echo $this->element('Messages/alert-info', array('text' => 'Pas d\'ami'));
}
?>
        </ul>      
<?php // echo $this->Js->writeBuffer(); ?>
                