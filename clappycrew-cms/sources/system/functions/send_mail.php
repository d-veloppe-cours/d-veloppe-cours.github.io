<?php

function get_register_mail()
{
    if (file_exists("./sources/themes/" . get_config()["theme"] . "/mail/register.php"))
    {
        include "./sources/themes/" . get_config()["theme"] . "/mail/register.php";
        return get_login();
    }
    else if (file_exists("./sources/themes/default/mail/register.php"))
    {
        include "./sources/themes/default/mail/register.php";
        return get_login();
    }
    return (false);
}

function get_login_mail()
{
    if (file_exists("./sources/themes/" . get_config()["theme"] . "/mail/login.php"))
    {
        include "./sources/themes/" . get_config()["theme"] . "/mail/login.php";
        return (get_login());
    }
    else if (file_exists("./sources/themes/default/mail/login.php"))
    {
        include "./sources/themes/default/mail/login.php";
        console_log("test");
        return (get_login());
    }
    return (false);
}

function send_mail(string $to, string $subject, string $message, string $type = "plain")
{
    $headers = "Content-Type: text/" . $type . "; charset=utf8\r\n";
    $headers .= "FROM: Support <support@".get_config()["url"].">\r\n";
    if (mail($to, $subject, $message, $headers))
        return (true);
    console_log("Impossible d'envoyer  de mail.");
    return (false);
}

function send_login_mail(string $to)
{
    $message = get_login_mail();
    $type = "html";

    if ($message == false)

    {
        $type = "plain";
        $message = "Nouvelle connexion établie\nAdresse-IP: ".get_ip();
    }

    send_mail(
        $to,
        "Connexion ".get_config()["name"],
        $message,
        $type
    );
}

function send_register_mail(string $to)
{
    send_mail(
        $to,
        "Inscritpion ".get_config()["name"],
        "Votre compte a bien été créé !\n"
    );
}