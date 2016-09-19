<nav class="green darken-2">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="<?= base_url() ?>panel" class="breadcrumb">Inicio</a>
        <a href="<?= base_url() ?>contratos" class="breadcrumb">Contratos</a>
        <a href="#!" class="breadcrumb">Ver</a>
      </div>
    </div>
</nav>
<?php if($this->session->flashdata('message')){  ?>
    <div class="message green center">
        <h5 class="white-text"><?= $this->session->flashdata('message'); ?></h5>
    </div>
<?php } ?>
<section class="container">
    <h3 class="green-text">Contrato Nro: <?= $contrato->contract_id ?></h3>
    <div class="divider"></div>
    <h4>Datos del cliente</h4>
    <div class="row">
        <div class="col s12">                           
            <?php if($contrato->customer_id){ ?>
                  <div class="card">
                    <div class="card-content">
                      <span class="card-title"><?= $contrato->customer_name ?></span>
                      <p>Telefono: <?= $contrato->customer_phone ?></p>
                    </div>
                  </div>            
            <?php }else{ ?>
                <p>No hemos encontrado datos del cliente, por favor escoge el cliente al que le pertenece este contrato y dale clic en actualizar</p>
                <form action="../update_client" class="col s12" method="post">
                    <div class="input-field col s12 m8">
                        <input name="contract_id" type="hidden" value="<?= $contrato->contract_id ?>" />
                        <select name="customer_id">
                            <option value="" disabled selected>Escoge una opción</option>
                            <?php foreach ($clientes->result() as $cliente) { ?>
                                <option value="<?= $cliente->customer_id ?>">
                                    <?= $cliente->customer_name ?>
                                </option>
                            <?php } ?>
                        </select>
                        <label>Clientes</label>
                    </div>
                    <div class="input-field col s12 m4">
                        <input class="btn-large col s12 green" type="submit" value="Actualizar"> 
                    </div>
                </form>                
            <?php } ?>
        </div>
    </div>
    <div class="divider"></div>
    <h4>Detalles del contrato</h4>
    <div class="row">
        <div class="col s12 m6 l3">
            <div class="card-panel">
                <span>Capital: <?= $contrato->capital ?> $USD</span>
            </div>
        </div>
        <div class="col s12 m6 l3">
            <div class="card-panel">
                <span>Fraccionamiento: <?= $contrato->division ?> cuotas</span>
            </div>
        </div>
        <div class="col s12 m6 l3">
            <div class="card-panel">
                <span>Garantia: <?= $contrato->guarantee ?></span>
            </div>
        </div>
        <div class="col s12 m6 l3">
            <div class="card">
                <div class="card-content">
                    <span>Porcentaje: <?= $contrato->percentage ?>% mensual </span>                    
                </div>    
                <?php if($contrato->customer_id){ ?>
                <div class="card-action">
                    <a href="#edit_percentage" class="valign-wrapper modal-trigger">
                        <i class="material-icons valign">edit</i>
                        <span class="valign">Editar</span>
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="divider"></div>
    <h4>Cuotas</h4>
    <div class="row">
        <?php if($cuotas != false){
            foreach ($cuotas->result() as $cuota) { ?>  
            <div class="col s12 m6">
              <div class="card">
                <div class="card-content">
                    <span class="card-title">Cuota Nro:  <?= $cuota->contract_fee ?> 
                        <span style="font-size: 16px; float:right;"> Fecha de pago: <?= $cuota->payment_date ?></span>
                    </span>
                    <p>Monto a pagar: <?= $cuota->amount ?> $USD</p>
                    <p></p>
                </div>
              </div>
            </div>
            <?php  } }else{ ?>
            <div class="col s12 m6">
              <div class="card">
                <div class="card-content">
                    <span class="card-title">No se encontraron cuotas </span>
                </div>
              </div>
            </div>
            <?php } ?>
    </div>
</section>
<!-- Modal Structure -->
<div id="edit_percentage" class="modal">
    <form action="../recalcular_cuotas" method="post">
        <div class="modal-content">
            <h4>Ingresa el nuevo porcentaje</h4>  
            <div class="divider"></div>
            <div class="input-field col s12">
                <input type="hidden" name="contract_id" value="<?= $contrato->contract_id ?>">
                <input id="porcentaje" name="new_percentage" type="text" class="porcentaje">
                <label for="porcentaje">Porcentaje</label>
            </div>          
        </div>
        <div class="modal-footer">
            <input type="submit" class="modal-action modal-close waves-effect waves-green btn-flat"  value="Recalcular cuotas" />
        </div>
    </form>
</div>