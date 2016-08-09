<?php if($this->session->flashdata('mensaje')){  ?>
  	<div class="message green darken-2 center">
  		<h5 class="white-text"><?= $this->session->flashdata('mensaje'); ?></h5>
  	</div>
<?php } ?>
<div class="progress">
   	<div class="indeterminate"></div>
</div>
<section class="container">	
	<div class="row center">
		<h2 class="teal-text text-darken-3">Iniciar Sesión</h2>	
	</div>
	<form class="col s12" action="login/validar" method="post">
		<div class="row">
			<div class="input-field col s12">
				<input id="username" name="username" type="text" class="validate">
				<label for="username">Usuario</label>
			</div>
		</div>
		<div class="row">
	        <div class="input-field col s12">
	          <input id="password" name="password" type="password" class="validate">
	          <label for="password">Contraseña</label>
	        </div>
	    </div>
		<div class="row">
			<div class="input-field col s12">
				<input id="login" type="submit" class="col s12 m12 l12 btn-large green" value="Iniciar Sesión" />
			</div>
		</div>
		<div class="row">
			<a href="reestablecer">Olvidé mi contraseña</a>
		</div>
	</form>
</section>
