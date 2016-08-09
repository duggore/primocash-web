<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>PrimoCash</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="icon" href="<?= base_url() ?>materialize/images/logo_100x100.png" type="image/png" >
	<!--Import Google Icon Font-->
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="<?= base_url() ?>materialize/css/materialize.min.css"  media="screen,projection"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>materialize/css/main.css">
	<!--Let browser know website is optimized for mobile-->
</head>
<body>
	<header>
		<nav class="green darken-1">
		    <div class="nav-wrapper">
		      <a href="<?= base_url() ?>panel" class="brand-logo">PrimoCash</a>
		      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
		      <ul id="nav-mobile" class="right hide-on-med-and-down">
		      	<?php if($menus_permitidos != false){ foreach ($menus_permitidos->result() as $menu_permitido) {?> 
		      			<li><a href="<?= base_url().$menu_permitido->url ?>"><?= $menu_permitido->description ?></a></li>
		      	<?php }} ?>
				<li><a href="<?= base_url() ?>perfil"><?= $username ?></a></li>
		        <li><a href="<?= base_url() ?>home/cerrar_sesion" class="btn-large green darken-4">Cerrar Sesión</a></li>
		      </ul>
		    </div>
		    <ul class="side-nav" id="mobile-demo">
		    	<?php if($menus_permitidos != false){ foreach ($menus_permitidos->result() as $menu_permitido) {?> 
		      			<li><a href="<?= base_url().$menu_permitido->url ?>"><?= $menu_permitido->description ?></a></li>
		      	<?php }} ?>
		      	<li><a href="<?= base_url() ?>perfil"><?= $username ?></a></li>
		        <li><a href="<?= base_url() ?>home/cerrar_sesion" class="btn-large green darken-4">Cerrar Sesión</a></li>
		    </ul>
		</nav>        
	</header>