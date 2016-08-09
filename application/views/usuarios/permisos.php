<nav class="green darken-2">
	<div class="nav-wrapper">
	  <div class="col s12">
	    <a href="<?= base_url() ?>" class="breadcrumb">Inicio</a>
	    <a href="<?= base_url() ?>usuarios" class="breadcrumb">Usuarios</a>
	    <a href="#!" class="breadcrumb">Permisos</a>
	  </div>
	</div>
</nav>
<div class="progress">
	<div class="indeterminate"></div>
</div>
<section class="container">
	<div class="row">
		<h4 class="green-text text-darken-2">Permisos para  <strong><?= $user->username ?></strong></h4>
	</div>
	<ul class="collection with-header">
		<?php foreach ($menus->result() as $menu) { 
			if($menu->checked == 1){
				$checked = 'checked';
			}else{
				$checked = '';
			}
		?>				
        <li class="collection-item">
        	<div>
        		<a href="<?= base_url().$menu->url ?>"><?= $menu->description ?></a>
	        	<div class="switch secondary-content">
				    <label>
				      	Off

				      	<input type="checkbox" <?= $checked ?> onchange="permiso_menu(this, <?= $menu->menu_id ?>, <?= $user->user_id ?>)">
				      	<span class="lever"></span>
				      	On
				    </label>
				</div>
        	</div>
        </li>        
		<?php } ?>
    </ul>       
</section>