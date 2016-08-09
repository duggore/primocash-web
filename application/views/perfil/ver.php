<nav class="green darken-2">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="<?= base_url() ?>perfil" class="breadcrumb">Inicio</a>
        <a href="#!" class="breadcrumb">Mi Perfil</a>
      </div>
    </div>
</nav>
<section class="container">
    <div class="row">
      <div class="col s12">
        <div class="card-panel">
            <div class="row">
                <div class="center col s12 m4">
                    <img width="200" class="responsive-img" src="<?= base_url() ?>materialize/images/sin-foto.png">
                </div>
                <div class="col s12 m8">
                    <p>
                        <strong>Nombre de usuario: </strong> <span><?= $user->username ?></span>
                    </p>
                    <p>
                        <strong>Nombre: </strong> <span><?= $user->first_name ?></span>
                    </p>
                    <p>
                        <strong>Email: </strong> <span><?= $user->email ?></span>
                    </p>
                </div>
            </div>
        </div>
      </div>
    </div>
</section>
<div class="fixed-action-btn" style="display: none;">
    <a class="btn-floating btn-large waves-effect waves-light green lighten-1" href="perfil/editar">
        <i class="material-icons">edit</i>
    </a>
</div>
