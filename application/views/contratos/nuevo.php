<nav class="green darken-2">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="panel" class="breadcrumb">Inicio</a>
        <a href="clientes" class="breadcrumb">Contratos</a>
        <a href="clientes" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>
<section class="container">
	<div class="row">
		<h4 class="green-text text-darken-2">Nuevo contrato</h4>
	</div>
	<form action="insertar" method="post">
		<div class="row">
			<div class="input-field col s12 m6">
	          	<input type="text" id="autocomplete-input" class="autocomplete clientes">
          		<label for="autocomplete-input">Autocomplete</label>
	        </div>
			<div class="input-field col s12 m6">
	          <input id="name" name="name" type="text" class="validate" required>
	          <label for="name">Nombre completo</label>
	        </div>
	        <div class="input-field col s12 m6">
	          <input id="email" name="email" type="text" class="validate" required>
	          <label for="email">Email</label>
	        </div>
	        <div class="input-field col s12 m6">
	          <input id="address" name="address" type="text" class="validate" required>
	          <label for="address">Dirección</label>
	        </div>
	        <div class="input-field col s12 m6">
	          <input id="phone" name="phone" type="text" class="validate" required>
	          <label for="phone">Telefono</label>
	        </div>
	        <div class="input-field col s12 m6">
	          <input id="guarantee" name="guarantee" type="text" class="validate" required>
	          <label for="guarantee">Garante</label>
	        </div>
		</div>
        <div class="row">
	        <div class="input-field col s12">
	          <input type="submit" class="btn-large green col s12" value="Guardar">
	        </div>
        </div>
	</form>
</section>