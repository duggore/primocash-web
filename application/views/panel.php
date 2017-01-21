<nav class="green darken-4">
	<div class="nav-wrapper">
	  <div class="col s12">
	    <a href="#!" class="breadcrumb">Inicio</a>
	  </div>
	</div>
</nav>
<section class="container">
    <h4>Bienvenido de nuevo <?= $username ?></h4>
    <!-- Proximos cobros -->
        <?php if($proximos != false){ ?>
        <ul class="collection with-header">
            <li class="collection-header"><h4>Proximos cobros</h4></li>
            <?php foreach ($proximos->result() as $contrato) { 
                if($contrato->customer_name == ''){
                    $cliente_id = '#!';
                    $cliente_nombre = 'No encontrado';
                }else{
                    $cliente_id     = $contrato->customer_id;
                    $cliente_nombre = $contrato->customer_name;
                }
                $date = new DateTime($contrato->payment_date);
            ?>      
            <li id="<?= $contrato->contract_id  ?>" class="collection-item avatar">
                <i class="material-icons circle">description</i>
                <span class="title"><a href="contratos/ver/<?= $contrato->contract_id ?>">Contrato Nro. <?= $contrato->contract_id ?></a></span>
                <p> Cliente: <a href="<?= base_url() ?>cliente/ver/<?= $cliente_id ?>"> <?= $cliente_nombre ?> </a><br>
                    Monto cuota: <?= $contrato->amount ?> $USD
                </p>
                <a href="#!" class="secondary-content">Fecha de pago: <?= $date->format('m-d-Y'); ?></a>
            </li>
            <?php } ?>
        </ul>    
    <?php }else{  ?>
        <h3>No se encontró ningun contrato, empieza creando uno.</h3>
    <?php } ?>      
</section>