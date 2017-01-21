<nav class="green darken-4">
	<div class="nav-wrapper">
	  <div class="col s12">
	    <a href="<?= base_url() ?>panel" class="breadcrumb">Inicio</a>
	    <a href="<?= base_url() ?>contratos" class="breadcrumb">Contratos</a>
	  </div>
	</div>
</nav>
<section class="container">
    <?php if($this->session->flashdata('mensaje')){  ?>
        <div class="message green lighten-2 center">
            <h5 class="white-text"><?= $this->session->flashdata('mensaje'); ?></h5>
        </div>
    <?php } ?>
    <div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s3"><a class="active" href="#proximos">Proximos cobros</a></li>
        <li class="tab col s3"><a href="#todos">Todos los contratos</a></li>
      </ul>
    </div>
    <div id="proximos" class="col s12">
        <!-- Proximos cobros -->
        <?php if($proximos != false){ ?>
        <ul class="collection with-header">
            <li class="collection-header"><h4>Proximos cobros</h4></li>
            <?php foreach ($proximos->result() as $contrato) { 
                if($contrato->customer_name == ''){
                    $cliente_id = '#!';
                    $cliente_nombre = 'No encontrado';
                }else{
                    $cliente_id     = base_url() .'cliente/ver/'. $contrato->customer_id;
                    $cliente_nombre = $contrato->customer_name;
                }
            ?>     
            <li id="<?= $contrato->contract_id  ?>" class="collection-item avatar">
                <i class="material-icons circle">description</i>
                <span class="title"><a href="contratos/ver/<?= $contrato->contract_id ?>">Contrato Nro. <?= $contrato->contract_id ?></a></span>
                <p> Cliente: <a href="<?= $cliente_id ?>"> <?= $cliente_nombre ?> </a><br>
                    Monto cuota: <?= $contrato->amount ?> $USD
                </p>
                <?php 
                    $date = new DateTime($contrato->payment_date);
                    
                ?>
                <a href="#!" class="secondary-content">Fecha de pago: <?= $date->format('m-d-Y'); ?></a>
            </li>
            <?php } ?>
        </ul>    
        <?php }else{  ?>
            <h3>No se encontró ningun contrato, empieza creando uno.</h3>
        <?php } ?>      
    </div>
    <div id="todos" class="col s12">
        <!--  Contratos -->
    	<?php if($contratos != false){ ?>
            <ul class="collection with-header">
                <li class="collection-header"><h4>Todos los contratos</h4></li>
                <?php foreach ($contratos->result() as $contrato) { 
                    if($contrato->customer_name == ''){
                        $cliente_id = '#!';
                        $cliente_nombre = 'No encontrado';
                    }else{
                        $cliente_id =  base_url() . 'cliente/ver/' . $contrato->customer_id;
                        $cliente_nombre =  $contrato->customer_name;
                    }
                ?>                
                <li id="<?= $contrato->contract_id  ?>" class="collection-item avatar">
                    <i class="material-icons circle">description</i>
                    <span class="title"><a href="contratos/ver/<?= $contrato->contract_id ?>">Contrato Nro. <?= $contrato->contract_id ?></a></span>
                    <p>Cliente: <a href="<?= $cliente_id ?>"> <?= $cliente_nombre ?> </a> <br>
                    </p> 
                </li>   
                <?php } ?>
            </ul>    
        <?php }else{  ?>
            <h3>No se encontró ningun contrato, empieza creando uno.</h3>
        <?php } ?>       
    </div>
  </div>        
    
</section>
<div class="fixed-action-btn">
    <a class="btn-floating btn-large waves-effect waves-light green lighten-1" href="contratos/nuevo">
    	<i class="material-icons">add</i>
    </a>
</div>
