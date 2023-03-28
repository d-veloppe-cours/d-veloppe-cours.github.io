<?php

include 'get_pages.php';
include 'get_special.php';

function load_custom_page(string $file)

{
    return (import_file($file));
}

function get_page(string $page)

{
    header ('Content-Type:text/html; charset=UTF-8');
    return (
'<!DOCTYPE html>
<html lang="fr-BE">
    <title>' . get_page_name() . ' | ' . get_name() . '</title>' .
    get_header() .
    $page .
    get_footer() .
'</html>'
);
}

function load_page(string $page)

{
    if (empty($_SERVER['HTTPS']) && get_config()["https"] == true)

    {
        header('Location: '.get_url().$page);
        exit();
    }

    if (in_array($page, ["/home", "/accueil", "/"]))

    {
        set_page_name("Accueil");
        $page_data = get_page(
            get_home()
        );
    }

    else

    if ($page == "/profil" && file_exists("./sources/themes/". get_theme() ."/profil.php"))

    {
        $page_data = get_page(
            load_custom_page("./sources/themes/". get_theme() ."/profil.php")
        );
    }

    else

    if ($page == "/login" && file_exists("./sources/themes/". get_theme() ."/login.php"))

    {
        $page_data = get_page(
            load_custom_page("./sources/themes/". get_theme() ."/login.php")
        );
    }

    else

    if ($page == "/admin")

    {
        $page_data = get_admin_page();
    }

    else

    if ($page == "/src/favicon.ico")

    {
        $page_data = show_favicon();
    }

    else

    if ($page == "/src/admin-style.css")

    {
        $page_data = get_css(true);
    }

    else

    if ($page == "/src/style.css" && file_exists('./sources/themes/'.get_theme().'/style.css'))

    {
        $page_data = get_css();
    }

    else

    if ($page == "/src/script.js" && file_exists('./sources/themes/'.get_theme().'/script.js'))

    {
        $page_data = get_js();
    }

    else

    if (
        file_exists('./sources/pages/'.$page.'.php'))

    {
        $page_data = get_page(
            load_custom_page('./sources/pages/'.$page.'.php')
        );
    }

    else

    if (file_exists('./sources/pages/'.$page.'/main.php'))

    {
        $page_data = get_page(
            load_custom_page('./sources/pages/'.$page.'/main.php')
        );
    }

    else

    if (file_exists('./sources/pages/'.strtolower($page).'/main.php'))

    {
        $page_data = get_page(
            load_custom_page('./sources/pages/'.strtolower($page).'/main.php')
        );
    }

    else

    if (file_exists('./sources/pages/'.strtoupper($page).'.php'))

    {
        $page_data = get_page(
            load_custom_page('./sources/pages/'.strtoupper($page).'.php')
        );
    }

    else

    if (file_exists('./sources/pages/'.strtoupper($page).'/main.php'))

    {
        $page_data = get_page(
            load_custom_page('./sources/pages/'.strtoupper($page).'/main.php')
        );
    }

    else

    if (file_exists('./sources/pages/'.$page.'/file.json'))

    {
        $page_data = get_json('./sources/pages/'.$page."/file.json");
    }

    else

    {
        $page_data = get_page(
            get_404()
        );
    }

    header("Content-Type: text/html; charset=UTF-8");
    return ($page_data);
}