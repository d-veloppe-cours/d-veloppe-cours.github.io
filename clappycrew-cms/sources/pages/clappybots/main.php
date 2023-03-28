<?php
    set_page_name("ClappyBots");
?>

<section>
    <div class="home row justify-content-center">
            <h1 class="animate__animated animate__backInUp white text-uppercase"> ClappyBots </h1>
    </div>

    <div class="paper">
        <center>
            <h1 data-aos="zoom-in" class="text-uppercase">
                Informations <a href="#informations"><i class="bi bi-caret-down"></i></a>
            </h1>
        </center>
    </div>

    <div class="home main-home white-blur" id="informations">
        <div class="container">
            <a data-aos="zoom-out-up" class="no-underline" href="<?= get_page_url("clappybots/packages") ?>">
                <h2 class="bg-light-blue white text-uppercase button">
                    <i class="bi bi-box-seam"></i> Nos modules 
                </h2>
            </a>
            <br>
            <a data-aos="zoom-out-up" class="no-underline" href="https://discord.gg/UvQfUbk" target="_blank">
                <h2 class="bg-purple white text-uppercase button">
                    <i class="bi bi-discord"></i> Notre discord 
                </h2>
            </a>
        </div>
    </div>
</section>
