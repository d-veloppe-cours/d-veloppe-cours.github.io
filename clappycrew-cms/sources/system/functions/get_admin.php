<?php

function get_admin_header()

{
    return (import_file('./sources/system/admin/header.php'));
}

function get_admin_footer()

{
    return (import_file('./sources/system/admin/footer.php'));
}


function get_admin_page()

{
    /*if (!isset($_SESSION['account']))
    {
        if (get_config()["https"] == true)
            header("Location: https://".get_config()["url"]."/login");
        else
            header("Location: http://".get_config()["url"]."/login");
    }

    else*/

    {
        set_page_name("Admin");
        return (
'<!DOCTYPE html>
    <html lang="fr-BE">
        <title>' . get_page_name() . ' | ' . get_name() . '</title>' .
        get_admin_header() .
        import_file('./sources/system/admin/home.php') .
        get_admin_footer() .
'</html>'
        );
    }
}