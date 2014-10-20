<ul class="pagination <?=$class?>">
    <?php
    if ($this->Paginator->hasPrev()) {
        echo $this->Paginator->prev("<<", array('tag' => "li",
            'title' => 'Page précédente',
            'model' => $model));
    }
    if($nbElem > 0){
        echo $this->Paginator->numbers(array('tag' => "li",
            'separator' => false,
            'class' => 'disable',
            'currentClass' => 'active',
            "model" => $model
        ));
    }
    else {
        echo $this->element('Messages/alert-info', 
                            array('text' => $emptyMessage));
    }
    if($this->Paginator->hasNext()){
        echo $this->Paginator->next(">>", array('tag' => "li",
            'title' => 'Page suivante',
            'model' => $model));
    } 
    ?>
</ul> 