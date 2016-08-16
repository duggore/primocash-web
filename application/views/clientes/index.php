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
	<?php if($clientes != false){ ?>
        <ul class="collection with-header">
    		<?php foreach ($clientes->result() as $cliente) { ?>				
            <li class="collection-item">
            	<div>
            		<a href="#!"><?= $cliente->customer_name ?></a>
    	        	<a class="secondary-content" href="clientes/editar/<?= $cliente->customer_id ?>" >
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
