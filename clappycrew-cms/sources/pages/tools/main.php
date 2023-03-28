<?php
    set_page_name("Outils");
?>

<div class="home row justify-content-center">
    <h1 class="animate__animated animate__backInUp white text-uppercase"> Outils</h1>
</div>

<div class="paper white-tr">
    <center>
        <h1 class="text-uppercase">
            <i class="bi bi-wrench-adjustable-circle"></i> Programmés par nous
        </h1>
    </center>
</div>

<div class="home white-blur">

    <div class="main-home container">
        <a href="<?= get_page_url("tools/show-ip")?>" class="blue-display blue-link">
        <div class="row button white-tr" data-aos="zoom-in-right">
            <h1 class="big-display" align="left"><i class="bi bi-clipboard-data"></i></h1>
            <h2 class="text-muted text-uppercase big-display">
                Récupérateur d'ip
            </h2>
        </div>
        </a>

        <br>

        <a href="<?= get_page_url("clappybots")?>" class="blue-display blue-link">
        <div class="row button white-tr" data-aos="zoom-in-right">
            <h1 class="big-display" align="left"><i class="bi bi-robot"></i></h1>
            <h2 class="text-muted text-uppercase big-display">
                Clappybot-Discord
            </h2>
        </div>
        </a>

        <br>

        <a href="<?= get_page_url("cms")?>" class="blue-display blue-link">
        <div class="row button white-tr" data-aos="zoom-in-right">
            <h1 class="big-display" align="left"><i class="bi bi-browser-safari"></i></h1>
            <h2 class="text-muted text-uppercase big-display">
                Créateur de sites
            </h2>
        </div>
        </a>
    </div>
</div>