<nav class="green lighten-1">
	<div class="nav-wrapper">
	  <div class="col s12">
	    <a href="panel" class="breadcrumb">Inicio</a>
	    <a href="<?= base_url() ?>menus" class="breadcrumb">Menus</a>
	    <a href="#!" class="breadcrumb">Nuevo</a>
	  </div>
	</div>
</nav>
<section class="container">
	<div class="row">
		<h4 class="green-text text-darken-2">Nuevo menu</h4>
	</div>
	<form action="insertar" method="post">
		<div class="row">
			<div class="input-field col s12">
	          <input id="description" name="description" type="text" class="validate" required>
	          <label for="description">Descripción</label>
	        </div>
		</div>
		<div class="row">
	        <div class="input-field col s12">
	          <input id="page" name="page" type="text" class="validate" required>
	          <label for="page">Pagina</label>
	        </div>
		</div>
        <div class="row">
	        <div class="input-field col s12">
	          <input type="submit" class="btn-large green col s12">
	        </div>
        </div>
	</form>
</section>