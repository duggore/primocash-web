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
			<div class="input-field col s12 m4">
	          	<input type="text" id="cliente" name="cliente" class="autocomplete clientes">
          		<label for="cliente">Cliente</label>
            </div>
	        <div class="input-field col s6 m3">
	          <input id="capital" name="capital" type="number" class="validate" required>
	          <label for="capital">Capital de Prestamo</label>
	        </div>
            <div class="input-field col s6 m3">
              <input id="porcentaje" name="porcentaje" type="number" min="0"  class="validate" required>
              <label for="porcentaje">Porcentaje Mensual</label>
            </div>

	        <div class="input-field col s12 m2">
	          <input id="phone" name="phone" type="text" class="validate" placeholder="Nro. Meses" required>
	          <label for="phone">Fraccionamiento</label>
	        </div>
	        <div class="input-field col s12">
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