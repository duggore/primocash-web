<nav class="green darken-4">
	<div class="nav-wrapper">
	  <div class="col s12">
	    <a href="<?= base_url() ?>" class="breadcrumb">Inicio</a>
	    <a href="#!" class="breadcrumb">Usuarios</a>
	  </div>
	</div>
</nav>
<section class="container">
	<?php if($this->session->flashdata('error')){  ?>
	  	<div class="message green center">
	  		<h5 class="white-text"><?= $this->session->flashdata('error'); ?></h5>
	  	</div>
  	<?php } ?>
	<div class="row">
		<?php foreach ($users->result() as $user) { ?>	
			<div class="card small col s12 m6 l3">
			    <div class="card-image waves-effect waves-block waves-light">
			      <img class="activator" src="<?= base_url() ?>materialize/images/sin-foto.png">
			    </div>
			    <div class="card-content">
			      <span class="card-title activator grey-text text-darken-4"><?= $user->username ?><i class="material-icons right">more_vert</i></span>
			      <p><a href="usuarios/permisos/<?= $user->user_id ?>">permisos</a></p>
			    </div>
			    <div class="card-reveal">
			      <span class="card-title grey-text text-darken-4"><?= $user->first_name ?><i class="material-icons right">close</i></span>
			      <p><i class="material-icons">email</i><?= $user->email ?></p>
			    </div>
			</div>
		<?php } ?>
	</div>
<div class="fixed-action-btn">
	<a href="usuarios/nuevo" class="btn-floating btn-large waves-effect waves-light green lighten-1"><i class="material-icons">add</i></a>
</div>
