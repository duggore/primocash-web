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
        <h2 class="teal-text text-darken-3">Reestablecer contraseña</h2> 
        <div class="divider"></div>
        <p>Te olvidaste tu contraseña, no te preocupes, dinos cual es tu email y te mandaremos inmediatamente un correo para que puedas reestablecer tu contraseña.</p>
    </div>
    <div class="row">   
        <form class="col s12" action="reestablecer/validar" method="post">
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" type="email" name="email" class="validate" required>
                    <label for="email">Ingresa tu correo electrónico</label>
                </div>
            </div>
            <div class="row">
                <input type="submit" class="col s12 btn-large green" value="Enviarme el correo" />
            </div>
        </form>
    </div>
</section>