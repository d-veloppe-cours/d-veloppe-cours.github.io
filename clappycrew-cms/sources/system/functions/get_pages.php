<?php
include 'get_config.php';

function read_file(string $filepath)

{
    $file = fopen($filepath, 'r') or die("Impossible de trouver le document :/");
    $size = filesize($filepath);
    if (!$size) return ("");
    $content = fread($file, $size);
    return ($content);
}

function import_file(string $file)

{
    if (file_exists($file))
    {
        ob_start();
        include $file;
        return(ob_get_clean());
    }
    return ("");
}

function get_header()

{
    return (import_file('./sources/themes/'.get_theme().'/header.php'));
}

function get_footer()

{
    return (import_file('./sources/themes/'.get_theme().'/footer.php'));
}

function get_home()

{
    return (import_file('./sources/themes/'.get_theme().'/home.php'));
}

function get_404()

{
    return (import_file('./sources/themes/'.get_theme().'/404.php'));
}

function get_page_name()

{
    if (isset($_SESSION['page']))
        return ($_SESSION['page']);
    return ("Page");
}

function set_page_name(string $name)
{
    $_SESSION["page"] = $name;
}

function get_page_url(string $page)

{
    if ($page == "home")

    {
        return (get_url());
    }

    else

    if (
        file_exists('./sources/pages/'.$page.'.php') ||
        file_exists('./sources/pages/'.$page.'/main.php')
        )

    {
        return (get_url().'/'.$page);
    }

    else

    {
        return ("#");
    }
}

function is_html($page)

{
    return (
        in_array($page, ["/home", "/accueil", "/", "/login", "/test", "/profil"]) ||
        file_exists('./sources/pages/'.$page.'/main.php')
    );
}