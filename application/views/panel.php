<nav class="teal darken-2">
	<div class="nav-wrapper">
	  <div class="col s12">
	    <a href="#!" class="breadcrumb">Inicio</a>
	  </div>
	</div>
</nav>
<section class="container">
    <div class="row">
        <?php if($cuentas != false){ foreach ($cuentas->result() as $cuenta) { ?>  
        <div class="col s12 m6">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Saldo cuenta Nro <?= $cuenta->count_id ?></span>
              <p><?= $cuenta->balance ?> <?= $cuenta->currency ?></p>
            </div>
            <div class="card-action">
              <a href="#">Ver movimientos</a>
            </div>
          </div>
        </div>
        <?php }}else{ ?> 
            <h3>Lo sentimos <?= $username ?> no tiene ninguna cuenta asignada.</h3>
        <?php } ?> 
      </div>
</section>