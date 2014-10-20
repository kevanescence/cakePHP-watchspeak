<?php
//Display friends
foreach ($users as $user) {            
    echo $this->element('Users/badge',
                        array('username' => $user['friends1']['username'],
                              'id' => $user['friends1']['id']));
}

//Configure pagination tools
$this->Paginator->options(array(
    'update' => '#content',
    'evalScripts' => true,
    'before' => $this->Js->get('#busy-indicator')->effect(
            'fadeInf', array('buffer' => false))
    ,
    'complete' => 'updatePagination("#content")',
    'url' => array(
        'controller' => 'Users',
        'action' => 'view', $id_user,
        'friends'
)));

//Display pagination
echo $this->element("UI/pagination", array(
    "nbElem" => count($users),
    "class" => "pagination-md col-lg-12 col-md-12 col-sm-12 col-xs-12",
    "model" => "friends1",
    "emptyMessage" => "Pas d'ami"));
?>