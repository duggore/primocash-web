<nav class="green darken-2">
	<div class="nav-wrapper">
	  <div class="col s12">
	    <a href="<?= base_url() ?>panel" class="breadcrumb">Inicio</a>
	    <a href="#!" class="breadcrumb">Menus</a>
	  </div>
	</div>
</nav>
<section class="container">
    <?php if($this->session->flashdata('mensaje')){  ?>
        <div class="message green lighten-2 center">
            <h5 class="white-text"><?= $this->session->flashdata('mensaje'); ?></h5>
        </div>
    <?php } ?>
	<ul class="collection with-header">
		<?php if($menus != false){foreach ($menus->result() as $menu) { ?>				
        <li class="collection-item">
        	<div>
        		<a href="<?= $menu->url ?>"><?= $menu->description ?></a>
	        	<a class="secondary-content" href="menus/delete/<?= $menu->menu_id ?>">
	        		<i class="material-icons green-text">delete</i>
	        	</a>
	        	<a class="secondary-content" href="menus/editar/<?= $menu->menu_id ?>" >
	        		<i class="material-icons green-text">edit</i>
	        	</a>
        	</div>
        </li>        
		<?php }} ?>
      </ul>            
</section>
<div class="fixed-action-btn">
	<a class="btn-floating btn-large waves-effect waves-light green lighten-1" href="menus/nuevo"><i class="material-icons">add</i></a>
</div>
        