<nav class="green darken-2">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="<?= base_url() ?>panel" class="breadcrumb">Inicio</a>
        <a href="<?= base_url() ?>clientes" class="breadcrumb">Clientes</a>
        <a href="#!" class="breadcrumb">Ver</a>
      </div>
    </div>
</nav>
<section class="container">
    <div class="row">
        <div class="col s12 ">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Datos del cliente</span>
              <p>Nombre: <?= $cliente->customer_name ?> </p>
              <p>Teléfono: <?= $cliente->customer_phone ?> </p>
            </div>
          </div>
        </div>
      </div>
      <!-- Proximos cobros -->
        <?php if($contratos != false){ ?>
        <ul class="collection with-header">
            <li class="collection-header"><h4>Contratos del cliente</h4></li>
            <?php foreach ($contratos->result() as $contrato) { 
                if($contrato->customer_name == ''){
                    $cliente = 'No encontrado';
                }else{
                    $cliente = $contrato->customer_name;
                }
            ?>     
            <li id="<?= $contrato->contract_id  ?>" class="collection-item avatar">
                <i class="material-icons circle">description</i>
                <span class="title">
                    <a href="contratos/ver/<?= $contrato->contract_id ?>">Contrato Nro. <?= $contrato->contract_id ?></a>
                </span>               
                <p>Capital prestado: <?= $contrato->capital ?> $USD</p>
            </li>
            <?php } ?>
        </ul>    
    <?php }else{  ?>
        <h5>No se encontró ningun contrato relacionado con este cliente.</h5>
    <?php } ?>
</section>