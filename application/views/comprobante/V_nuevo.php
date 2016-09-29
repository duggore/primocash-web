<nav class="green darken-2">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="<?= base_url() ?>panel" class="breadcrumb">Inicio</a>
        <a href="<?= base_url() ?>cliente" class="breadcrumb">Cliente</a>
        <a href="#!" class="breadcrumb">Comprobante</a>
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
		<h4 class="green-text text-darken-2">Nuevo comprobante</h4>
	</div>
    <form action="../recargar" method="post">
		<div class="row">
	        <div class="input-field col s12">
                <input type="hidden" name="customer_id" value="<?= $customer_id ?>">
	          <input id="monto" name="monto" type="number" class="validate" required>
	          <label for="monto">Monto</label>
	        </div>
		</div>
        <div class="row">
            <div class="input-field col s12">
            <input type="submit" class="btn-large green col s12" value="Recargar Saldo">
            </div>
        </div>
	</form>
</section>