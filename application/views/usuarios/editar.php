<nav class="green darken-2">
	<div class="nav-wrapper">
	  <div class="col s12">
	    <a href="<?= base_url() ?>" class="breadcrumb">Inicio</a>
	    <a href="<?= base_url() ?>usuarios" class="breadcrumb">Usuarios</a>
	    <a href="#!" class="breadcrumb">Permisos</a>
	  </div>
	</div>
</nav>
<section class="container">
	<div class="row">
		<h4 class="green-text text-darken-2">Editar  <strong><?= $user->username ?></strong></h4>
	</div>
	<form action="enviar_invitacion" method="post">
		<div class="row">
	        <div class="file-field input-field">
		      <div class="btn">
		        <span>Foto</span>
		        <input name="image" type="file">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text">
		      </div>
		    </div>
		</div>
	</form>
</section>