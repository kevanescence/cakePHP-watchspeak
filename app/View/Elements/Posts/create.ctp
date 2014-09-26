<?php
//$this->assign('css', 'posts');
$this->append('css', $this->Html->css("Posts/posts"));
echo $this->Form->create('Post', array('novalidate' => 'novalidate',
                                        'controller' => 'Post',
                                        'action' => 'add'));
echo $this->Form->input('body', array('rows' => '1',
                        'label'=>false,
                        'div' => false,
                        'placeholder'=>'Parlez d\'un film ici ...'));
$options = array('label'=>'Publier',
                 'title' => 'Publier ce post',
                 'class' => 'btn-md btn btn-primary',
                 'div' => false);
echo $this->Form->end($options);
?>