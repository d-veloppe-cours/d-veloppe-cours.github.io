<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="<?= get_style() ?>">
</head>

<header>
    <nav class="navbar navbar-expand-md navbar-dark py-4 nav-clap">
        <!-- Brand -->
        <a class="navbar-brand item-flip" href="#"><?= get_name() ?></a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
            <li class="nav-item item-blur">
                <a class="nav-link" href="<?= get_page_url("home") ?>"><i class="bi bi-house"></i> Accueil</a>
            </li>
            <li class="nav-item item-blur">
                <a class="nav-link" href="https://icons.getbootstrap.com/"><i class="bi bi-menu-button-wide-fill"></i> Icones</a>
            </li>
            <li class="nav-item item-blur">
                <a class="nav-link" href="https://discord.gg/UvQfUbk"><i class="bi bi-question-square"></i> Support</a>
            </li>
            <li class="nav-item item-blur">
                <a class="nav-link" href="#"><i class="bi bi-three-dots"></i> Autres</a>
            </li>
            </ul>
        </div>
    </nav>
</header>
<body>