<nav class="teal darken-2">
	<div class="nav-wrapper">
	  <div class="col s12">
	    <a href="<?= base_url() ?>panel" class="breadcrumb">Inicio</a>
	    <a href="<?= base_url() ?>menus" class="breadcrumb">Mantenimiento de menus</a>
	    <a href="#!" class="breadcrumb">Editar</a>
	  </div>
	</div>
</nav>
<section class="container">
	<div class="row">
		<h4 class="teal-text text-darken-2">Editando <strong><?= $menu->description ?></strong></h4>
	</div>
	<div class="row">
		<form action="../update/<?= $menu->menu_id ?>" class="col s12" method="post">
			<div class="input-field col s12">
				<input id="description" name="description" type="text" class="validate" value="<?= $menu->description ?>">
          		<label for="description">Descripcion</label>
			</div>
			<div class="input-field col s12">
				<input id="pagina" name="page" type="text" class="validate" value="<?= $menu->url ?>">
          		<label for="pagina">Pagina</label>
			</div>
			<div class="input-field col s12">
				<input class="btn-large col s12 teal darken-2" type="submit" value="Actualizar">
			</div>
		</form>
	</div>
</section>