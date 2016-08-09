<nav class="teal darken-2">
	<div class="nav-wrapper">
	  <div class="col s12">
	    <a href="<?= base_url() ?>panel" class="breadcrumb">Inicio</a>
	    <a href="<?= base_url() ?>clientes" class="breadcrumb">Clientes</a>
	    <a href="#!" class="breadcrumb">Editar</a>
	  </div>
	</div>
</nav>
<section class="container">
	<div class="row">
		<h4 class="teal-text text-darken-2">Editando <strong><?= $cliente->customer_name ?></strong></h4>
	</div>
	<div class="row">
		<form action="../update/<?= $cliente->customer_id ?>" class="col s12" method="post">
			<div class="input-field col s12">
				<input id="description" name="description" type="text" class="validate" value="<?= $cliente->customer_name ?>">
          		<label for="description">Nombre</label>
			</div>
			<div class="input-field col s12">
				<input id="pagina" name="page" type="text" class="validate" value="<?= $cliente->customer_email ?>">
          		<label for="pagina">Pagina</label>
			</div>
			<div class="input-field col s12">
				<input class="btn-large col s12 teal darken-2" type="submit" value="Actualizar">
			</div>
		</form>
	</div>
</section>