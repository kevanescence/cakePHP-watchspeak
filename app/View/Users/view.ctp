<ul class="nav nav-pills" role="tablist">  
  <li class="active"><a href="#">Home</a></li>
  <li><a href="#">Profile</a></li>
  <li><a href="#">Messages</a></li>
</ul>
<div class="col-md-3">
    <img alt="200x200" class="img-responsive" data-src="holder.js/200x200/auto/sky" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMDAiIGhlaWdodD0iMjAwIj48cmVjdCB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iIzBEOEZEQiIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjEwMCIgeT0iMTAwIiBzdHlsZT0iZmlsbDojZmZmO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEzcHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+MjAweDIwMDwvdGV4dD48L3N2Zz4=">
    
    <input id="btn-add-friend" type="button" class="btn btn-primary" value="+ Ajouter en ami" />
</div>
<div class="col-md-4">
<?php    
    $hasRight = AuthComponent::user('id') == $user['User']['id'] 
                    || AuthComponent::user('role') == 'admin';
    
    echo $this->element("Users/information", array('hasRight' => $hasRight,
                                                    'user' => $user));
    
   
?>
</div>