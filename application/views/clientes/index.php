<nav class="green darken-2">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="panel" class="breadcrumb">Inicio</a>
        <a href="clientes" class="breadcrumb">Clientes</a>
      </div>
    </div>
</nav>
<section class="container">
    <?php if($this->session->flashdata('message')){  ?>
        <div class="message green center">
            <h5 class="white-text"><?= $this->session->flashdata('message'); ?></h5>
        </div>
    <?php } ?>
    <ul class="collection with-header ultimo_visto">
        <li class="collection-header"><h4>Ultimo visto</h4></li>
    </ul>
    <div class="divider"></div>
	<?php if($clientes != false){ ?>
        <ul class="collection with-header">
            <li class="collection-header"><h4>Todos los clientes</h4></li>
    		<?php foreach ($clientes->result() as $cliente) { ?>				
            <li id="<?= $cliente->customer_id ?>" class="collection-item">
            	<div>
            		<a href="clientes/ver/<?= $cliente->customer_id ?>"><?= $cliente->customer_name ?></a>
    	        	<a class="secondary-content btn-edit" href="clientes/editar/<?= $cliente->customer_id ?>" >
    	        		<i class="material-icons green-text">edit</i>
    	        	</a>
            	</div>
            </li>        
    		<?php } ?>
        </ul>    
    <?php }else{  ?>
        <h3>No se encontró ningun cliente, empieza creando uno.</h3>
    <?php } ?>        
</section>
<div class="fixed-action-btn">
    <a class="btn-floating btn-large waves-effect waves-light green lighten-1" href="clientes/nuevo"><i class="material-icons">add</i></a>
</div>
