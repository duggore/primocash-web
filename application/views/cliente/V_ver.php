<nav class="green darken-2">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="<?= base_url() ?>panel" class="breadcrumb">Inicio</a>
        <a href="<?= base_url() ?>cliente" class="breadcrumb">Clientes</a>
        <a href="#!" class="breadcrumb">Ver</a>
      </div>
    </div>
</nav>
<section class="container">
    <?php if($this->session->flashdata('message')){  ?>
        <div class="message green center">
            <h5 class="white-text"><?= $this->session->flashdata('message'); ?></h5>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col s12 ">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Datos del cliente Nro: <?= $cliente->customer_id  ?></span>
              <p>Saldo disponible: <?= $cliente->saldo ?> $USD</p>
              <p>Nombre: <?= $cliente->customer_name ?> </p>
              <p>Teléfono: <?= $cliente->customer_phone ?> </p>
            </div>
          </div>
        </div>
      </div>
      <!-- Contratos del cliente -->
        <?php if($contratos != false){ ?>
        <ul class="collection with-header">
            <li class="collection-header"><h4>Contratos del cliente</h4></li>
            <?php foreach ($contratos->result() as $contrato) { ?>     
            <li id="<?= $contrato->contract_id  ?>" class="collection-item avatar">
                <i class="material-icons circle">description</i>
                <span class="title">
                    <a href="<?= base_url() ?>contratos/ver/<?= $contrato->contract_id ?>">Contrato Nro. <?= $contrato->contract_id ?></a>
                </span>               
                <p>Capital prestado: <?= $contrato->capital ?> $USD</p>
            </li>
            <?php } ?>
        </ul>    
        <?php }else{  ?>
            <h5>No se encontró ningun contrato relacionado con este cliente.</h5>
        <?php } ?>
</section>
<div class="fixed-action-btn">
    <a  class="btn-floating btn-large waves-effect waves-light green lighten-1" href="<?= base_url() ?>cliente/pago/<?= $cliente->customer_id ?>">
        <i class="material-icons">add</i>
    </a>
</div>
