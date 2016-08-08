<?php if($this->session->flashdata('mensaje')){  ?>
    <div class="message teal center">
        <h5 class="white-text"><?= $this->session->flashdata('mensaje'); ?></h5>
    </div>
<?php } ?>
<div class="progress">
    <div class="indeterminate"></div>
</div>
<section class="container">
     <div class="row center">
        <h2 class="teal-text text-darken-3">Reestablece tu contraseña <?= $first_name ?></h2> 
        <div class="divider"></div>
        <p>Ahora puedes reestablecer tu contraseña con total libertad, recuerda que las contraseñas mas seguras son las mas largas como una frase y no una pequeña combinación de numeros y letras.</p>
    </div>
    <div class="row">   
        <form class="col s12" action="../update" method="post">
            <div class="row">
                <input type="hidden" name="token" value="<?= $token ?>">
                <div class="input-field col s12">
                    <input id="password" type="password" name="password" class="validate" required>
                    <label for="password">Nueva contraseña</label>
                </div>
            </div>
            <div class="row">
                <input type="submit" class="col s12 btn-large" value="Reestablecer mi contraseña" />
            </div>
        </form>
    </div>
</section>