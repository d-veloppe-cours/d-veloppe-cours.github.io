<?php

function get_json($page)

{
    header('Content-Type: application/json; charset=utf-8');
    $json = import_file($page);
    print_r($json);
}

function get_css(bool $admin = false)

{
    header('Content-Type: text/css; charset=utf-8');
    if ($admin)
        $json = import_file('./sources/system/admin/style.css');
    else
        $json = import_file('./sources/themes/'.get_theme().'/style.css');

    print_r($json);
}

function get_js()

{
    header('Content-Type: text/js; charset=utf-8');
    $json = import_file('./sources/themes/'.get_theme().'/script.js');
    print_r($json);
}

function get_image(string $name)

{
    return (get_url().'/storage/'.$name);
}

function show_image(string $path, string $type = "png")

{
    header ('Content-Type: image/'.$type);
    $json = import_file('./sources/'.$path);
    print_r($json);
}

function show_favicon()

{
    header ('Content-Type: image/png');
    $json = import_file('./sources/themes/'.get_theme().'/favicon.ico');
    print_r($json);
}