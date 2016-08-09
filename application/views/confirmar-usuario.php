<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Confirma Usuario - Academia Deportiva Drapic</title>
	<link rel="icon" href="<?= base_url() ?>materialize/images/ico.png" type="image/png" >
	<meta name="viewport" content="width = device-width, initial-scale=1, maximum-scale=1"/>
	<!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="<?= base_url() ?>materialize/css/materialize.min.css"  media="screen,projection"/>
    <!-- Otros CSS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>materialize/css/main.css">
</head>
<body>
	<header>
		<nav class="green darken-3">
		    <div class="container nav-wrapper ">
		      <a href="<?= base_url() ?>" class="brand-logo">Esandex</a>
		    </div>
		</nav>
	</header>	
	<section class="container">
		<?php if($this->session->flashdata('error')){  ?>
		  	<div class="message green center">
		  		<h5 class="white-text"><?= $this->session->flashdata('error'); ?></h5>
		  	</div>
  		<?php } ?>
		<div class="row center">
			<h2>Hola <?= $registro->first_name ?>, terminemos de configurar tu cuenta</h2>
		</div>
		<div class="row">
			<form class="col s12" action="<?= base_url() ?>registro/crear/<?= $registro->token ?>" method="post">
				<div class="row">
					<div class="input-field col s12">
						<input id="username" name="username" type="text" />
						<label for="username">Username</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input id="password" name="password" type="password" />
						<label for="password">Password</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input class="btn-large col s12 green" type="submit" value="Crear cuenta" />		
					</div>
				</div>
			</form>
		</div>
	</section>
	<!--Import jQuery before materialize.js-->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>materialize/js/materialize.min.js"></script>
    <!-- Otros JS -->
	<script type="text/javascript" src="<?= base_url() ?>materialize/js/main.js"></script>
</body>
</html>