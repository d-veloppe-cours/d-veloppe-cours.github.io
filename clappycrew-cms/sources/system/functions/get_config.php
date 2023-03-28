<?php

function get_config()

{
    return (parse_ini_file("sources/config.ini"));
}

function get_name()

{
    if (get_config()["name"])
        return (get_config()["name"]);
    return ("Mon Site");
}

function get_theme()

{
    if (get_config()["theme"])
        return (get_config()["theme"]);
    return ("default");
}

function get_url()

{
    if (empty($_SERVER['HTTPS']) && get_config()["https"] != true)
        return ('http://'.get_config()["url"]);
    return ('https://'.get_config()["url"]);
}

function get_style(bool $admin = false)

{
    if ($admin)
        return (get_url().'/src/admin-style.css');
    return (get_url().'/src/style.css');
}

function get_script()

{
    return (get_url().'/src/script.js');
}

function get_favicon()

{
    return (get_url().'/src/favicon.ico');
}