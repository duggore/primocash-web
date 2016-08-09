<?php if($this->session->flashdata('mensaje')){  ?>
    <div class="message green darken-3 center">
        <h5 class="white-text"><?= $this->session->flashdata('mensaje'); ?></h5>
    </div>
<?php } ?>