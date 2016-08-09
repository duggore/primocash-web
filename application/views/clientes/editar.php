<nav class="green darken-2">
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
		<h4 class="green-text text-darken-2">Editando <strong><?= $cliente->customer_name ?></strong></h4>
	</div>
	<div class="row">
		<form action="../update/<?= $cliente->customer_id ?>" class="col s12" method="post">
			<div class="input-field col s12 m6">
	          <input id="document" name="document" type="text" class="validate" value="<?= $cliente->customer_document ?>" required>
	          <label for="document">Doc Identidad</label>
	        </div>
			<div class="input-field col s12 m6">
	          <input id="name" name="name" type="text" class="validate" value="<?= $cliente->customer_name ?>" required>
	          <label for="name">Nombre completo</label>
	        </div>
	        <div class="input-field col s12 m6">
	          <input id="email" name="email" type="text" class="validate" value="<?= $cliente->customer_email?>" required>
	          <label for="email">Email</label>
	        </div>
	        <div class="input-field col s12 m6">
	          <input id="address" name="address" type="text" class="validate" value="<?= $cliente->customer_address ?>" required>
	          <label for="address">Dirección</label>
	        </div>
	        <div class="input-field col s12 m6">
	          <input id="phone" name="phone" type="text" class="validate" value="<?= $cliente->customer_phone ?>" required>
	          <label for="phone">Telefono</label>
	        </div>
	        <div class="input-field col s12 m6">
	          <input id="guarantee" name="guarantee" type="text" class="validate" value="<?= $cliente->customer_guarantee ?>" required>
	          <label for="guarantee">Garante</label>
	        </div>
			<div class="input-field col s12">
				<input class="btn-large col s12 green darken-2" type="submit" value="Actualizar">
			</div>
		</form>
	</div>
</section>