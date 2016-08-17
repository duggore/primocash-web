<!DOCTYPE html>
<html>
<head>
    <title>Login | PrimoCash</title>    
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="<?= base_url() ?>materialize/css/materialize.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="<?= base_url() ?>materialize/css/main.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

</head>
<body>
    <nav class="green">
        <div class="nav-wrapper">
          <a href="#!" class="brand-logo">Primocash</a>
          <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a class="btn-large green darken-4" href="<?= base_url() ?>login">Iniciar Sesión</a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a class="btn-large green darken-4" href="<?= base_url() ?>login">Iniciar Sesión</a></li>
            </ul>
        </div>
    </nav>