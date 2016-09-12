<nav class="green darken-2">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="panel" class="breadcrumb">Inicio</a>
        <a href="<?= base_url() ?>contratos" class="breadcrumb">Contratos</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>
<?php if($this->session->flashdata('message')){  ?>
    <div class="message green lighten-2 center">
        <h5 class="white-text"><?= $this->session->flashdata('message'); ?></h5>
    </div>
<?php } ?>
<section class="row">
    <section class="col s12 l8">
        <h4 class="green-text text-darken-2">Nuevo contrato</h4>
        <form action="insertar" method="post">
            <div class="row">
                <div class="input-field col s2">
                    <label>ID Cliente</label>
                    <input id="customer_id" type="text" name="customer_id" placeholder="*Obligatorio" readonly required>  
                </div>
                <div class="input-field col s12 m4">
                    <input type="text" id="cliente" name="customer_name" class="autocomplete clientes" required>
                    <label for="cliente">Cliente</label>
                </div>
                <div class="input-field col s6 m2">
                    <input id="fecha_inicio" type="date" name="date_initial" class="datepicker" required>
                    <label for="fecha_inicio">Fecha inicio</label>
                </div> 
                <div class="input-field col s6 m3">
                  <input id="capital" name="capital" type="number" class="validate" required>
                  <label for="capital">Capital de Prestamo</label>
                </div>
                <div class="input-field col s6 m3">
                  <input id="porcentaje" name="percentage" type="number" min="0" max="100" class="validate" placeholder="Entre 0 y 100%" required>
                  <label for="porcentaje">Porcentaje Mensual</label>
                </div>

                <div class="input-field col s12 m2">
                  <input id="fraccionamiento" name="fraccionamiento" type="number" class="validate" placeholder="Nro. Meses" required>
                  <label for="fraccionamiento">Fraccionamiento</label>
                </div>
                <div class="input-field col s12 m10">
                  <input id="guarantee" name="guarantee" type="text" class="validate" required>
                  <label for="guarantee">Garante</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                  <input id="preview" type="submit" class="btn-large grey col s12" value="Previsualizar">
                </div>
                <div class="input-field col s12 m6">
                  <input type="submit" class="btn-large green col s12" value="Confirmar">
                </div>
            </div>
        </form>
    </section>

    <section class="col s12 l4">
        <h4 class="green-text text-darken-2">Pre Contrato</h4>
        <div class="card">
            <div class="card-content">
              <span class="card-title">Cliente</span>
              <p>Nombre: <span id="pre_customer_name"></span></p>
              <p>Telefono: <span id="pre_customer_phone"></span></p>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
              <span class="card-title">Contrato</span>
              <p>Capital: <span id="pre_capital"></span></p>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
              <span class="card-title">Cuotas</span>
              <span id="cuotas">                
              </span>
            </div>
        </div>
    </section>
</section>