<nav class="green darken-2">
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
	<?php if($contratos != false){ ?>
        <ul class="collection with-header">
            <li class="collection-header"><h4>Todos los contratos</h4></li>
            <?php foreach ($contratos->result() as $contrato) { ?>                
            <li id="<?= $contrato->contract_id ?>" class="collection-item">
                <div>
                    <a href="contratos/ver/<?= $contrato->contract_id ?>">Contrato Nro. <?= $contrato->contract_id ?></a>
                    <a style="display: none" class="secondary-content btn-edit" href="clientes/editar/<?= $contrato->contract_id ?>" >
                        <i class="material-icons green-text">edit</i>
                    </a>
                </div>
            </li>        
            <?php } ?>
        </ul>    
    <?php }else{  ?>
        <h3>No se encontró ningun contrato, empieza creando uno.</h3>
    <?php } ?>       
</section>
<div class="fixed-action-btn">
    <a class="btn-floating btn-large waves-effect waves-light green lighten-1" href="contratos/nuevo">
    	<i class="material-icons">add</i>
    </a>
</div>
