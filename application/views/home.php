<!DOCTYPE html>
<html>
<head>
    <title>Login | PrimoCash</title>    
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

</head>
<body>
    <nav>
        <div class="nav-wrapper">
          <a href="#!" class="brand-logo">Primocash</a>
          <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a class="btn-large" href="mobile.html">Iniciar Sesión</a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a class="btn-large" href="mobile.html">Iniciar Sesión</a></li>
            </ul>
        </div>
    </nav>
    <section class="container">
        <div class="row center">
            <h1>Iniciar Sesión</h1>
        </div>
        <div class="row">
            <form class="col s12">
                <div class="row">
                    <div class="input-field col s12">
                      <input id="username" type="text" class="validate">
                      <label for="username">Usuario</label>
                    </div>
                    <div class="input-field col s12">
                      <input id="password" type="text" class="validate">
                      <label for="password">Contraseña</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                      <input class="btn-large col s12" type="submit" value="Entrar">
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
</body>
</html>