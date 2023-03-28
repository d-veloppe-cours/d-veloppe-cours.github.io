<?php
    set_page_name("Mon IP");
?>
<div class="home main-home white-blur">
    <div class="container">
        <div data-aos="flip-up">
            <center>
            <div class="small-card white-tr text-muted" style="padding-top: 5%;">
                <h6>Votre Adresse-IP : </h6>
                <h1 type="text" id="address-ip"><?= get_ip() ?></h1>
                    <br>
                <button type="button" class="btn btn-lg btn-info" onclick="copy_text('address-ip', 'copy-id')" id="copy-id">
                    <i class="bi bi-clipboard"></i> Copier
                </button>
            </div>
            </center>
        </div>
    </div>
</div>