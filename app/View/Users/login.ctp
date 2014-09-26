<?php 
    $option = array(
                "cssClass" => "col-md-4 col-sm-6 col-xs-12 col-lg-4"
              );
    echo $this->element($this->name ."/add", $option);?>
<?php         
    echo $this->element($this->name ."/login", $option);    
 ?>