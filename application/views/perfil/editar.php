<nav class="green darken-2">
	<div class="nav-wrapper">
	  <div class="col s12">
	    <a href="<?= base_url() ?>panel" class="breadcrumb">Inicio</a>
	    <a href="<?= base_url() ?>perfil" class="breadcrumb">Mi Perfil</a>
	    <a href="#!" class="breadcrumb">Editar</a>
	  </div>
	</div>
</nav>
<section class="container">
	<div class="row">
		<h4 class="green-text text-darken-2">Editando <strong><?= $user->username ?></strong></h4>
	</div>
	<div class="row">
		<form action="update" class="col s12" method="post">
		    <div class="file-field input-field col s12 m6">
			      <div class="btn">
			        <span>Foto</span>
			        <input name="image" type="file">
			      </div>
			      <div class="file-path-wrapper">
			        <input class="file-path validate" type="text">
			      </div>
			</div>
			<div class="input-field col s12 m6">
				<input id="first_name" name="first_name" type="text" class="validate" value="<?= $user->first_name ?>">
          		<label for="first_name">Nombre</label>
			</div>
			<div class="input-field col s12">
				<input id="email" name="email" type="text" class="validate" value="<?= $user->email ?>">
          		<label for="email">Email</label>
			</div>
			<div class="input-field col s12">
				<input class="btn-large col s12 green darken-2" type="submit" value="Actualizar">
			</div>
		</form>
	</div>
</section>