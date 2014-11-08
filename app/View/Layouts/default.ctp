<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> <?php echo $this->fetch("title");?></title>

    <!-- Bootstrap and others css -->    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <?php         
        echo $this->Html->css("bootstrap.min");
        echo $this->Html->css("common");
        echo $this->fetch("css");        
        echo $this->Html->script("jquery.min");
    ?>  
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>    
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" 
                  data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Watchspeak</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <?= $this->Html->link("Home", array('controller'=>'Posts','action'=>'index'))?>
                </li>
                <?php            
                    if($this->Session->read('Auth.User.username')){
                        $option =  array(
                                    'controller' => 'Users',
                                    'action' => 'logout',
                                    'class' => ''
                                    );
                        echo $this->Html->tag("li",$this->Html->link('Déconnexion',$option));              
                    }
                ?>
            </ul>
            <?php
                if(!$this->Session->read('Auth.User.username')){
                    $css = 'navbar-form navbar-right';
                    echo $this->element("Users/login",array('cssClass'=>$css));
                }
                ?>
        </div><!--/.nav-collapse -->
      </div>
        
    </div>    
     
        <?php echo $this->fetch("content"); ?>

    </div><!-- /.container -->    
    <!-- Bootstrap and other plugins -->    
    <?php echo $this->Html->script("bootstrap.min");?>
    <?php echo $this->Html->script("common");?>
    <!-- Include all scripts of the page -->
    <?php echo $this->fetch("script");?>
    <?php echo $this->Flash->priority(); ?>
  </body>  
</html>
