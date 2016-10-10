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
<section class="container row">
    <section class="col s12">
        <h4 class="green-text text-darken-2">Nuevo contrato</h4>
        <form action="insertar" method="post">
            <div class="row">
                <div class="input-field col s12 m6">
                    <select name="customer_id" class="left-align">
                      <option value="" disabled selected>Escoge una opción</option>
                      <?php foreach ($clientes->result() as $cliente) { ?>
                          <option value="<?= $cliente->customer_id ?>">
                              <?= $cliente->customer_name ?>
                          </option>
                      <?php } ?>
                    </select>
                    <label for="cliente">Cliente</label>
                </div>
                <div class="input-field col s6 m3">
                    <input id="fecha_inicio" type="date" name="date_initial" class="datepicker" required>
                    <label for="fecha_inicio">Fecha inicio</label>
                </div> 
                <div class="input-field col s6 m3">
                  <input id="capital" name="capital" type="number" class="validate" required>
                  <label for="capital">Capital de Prestamo</label>
                </div>
                <div class="input-field col s12 m4">
                  <input id="porcentaje" name="percentage" type="number" min="0" max="100" class="validate" placeholder="Entre 0 y 100%" required>
                  <label for="porcentaje">Porcentaje Mensual</label>
                </div>

                <div class="input-field col s12 m4">
                  <input id="fraccionamiento" name="fraccionamiento" type="number" class="validate" placeholder="Nro. Meses" required>
                  <label for="fraccionamiento">Fraccionamiento</label>
                </div>
                <div class="input-field col s12 m4">
                  <input id="guarantee" name="guarantee" type="text" class="validate" required>
                  <label for="guarantee">Garante</label>
                </div>
            </div>
            <div class="row"> 
                <div class="input-field col s12">
                  <input type="submit" class="btn-large green col s12" value="Confirmar">
                </div>
            </div>
        </form>
    </section>
</section>