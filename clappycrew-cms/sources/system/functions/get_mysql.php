<?php

function mysql_connect()

{
    $db = 'mysql:host='.get_config()['db_host'].';dbname='.get_config()['db_name'].';charset=utf8mb4';
    $user = get_config()['db_user'];
    $password = get_config()['db_key'];
    $error = false;
    
    if (!get_config()['db_host'])

    {
        console_log("Adresse de la base de données non défini.");
        printf("Adresse de la base de données non défini.");
        $error = true;
    }

    if (!get_config()['db_name'])

    {
        console_log("Nom de la base de données non défini.");
        printf("Nom de la base de données non défini.");
        $error = true;
    }

    if (!$user)
    {
        console_log("Utilisateur de la base de données non défini.");
        printf("Utilisateur de la base de données non défini.");
        $error = true;
    }

    if (!$password)
    {
        console_log("Clef de la base de donnée non définie.");
        printf("Clef de la base de donnée non définie.");
        $error = true;
    }

    if (!$error)

    {
        try {
            $connect = new PDO($db, $user, $password);
            if ($connect)
            {
                init_db($connect);
                return ($connect);
            }
        }
        catch (PDOException $error) {
            console_log("Accès refusé à la base de données.");
            printf($error);
        }
    }
    return (false);
}

function init_db(PDO $db)

{
    try {
        $sql = "SELECT 1 FROM members;";
        $db->query($sql);
        $table_exists = true;
    }
    catch (PDOException $error) {
        $table_exists = false;
    }

    if (!$table_exists)

    {
        $sql = "CREATE table members(
            ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
            last_name VARCHAR( 30 ) NOT NULL,
            first_name VARCHAR( 25 ) NOT NULL,
            account VARCHAR( 18 ) NOT NULL,
            email VARCHAR( 40 ) NOT NULL,
            password VARCHAR( 40 ) NOT NULL,
            roles INT (16) NOT NULL DEFAULT '0',
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            coins INT (11) NOT NULL DEFAULT '0',
            last_login_ip VARCHAR( 50 ) NOT NULL,
            sanctions INT (1) NOT NULL DEFAULT '0')
            CHARSET=utf8 COLLATE utf8_unicode_ci;";
        $db->exec($sql);
        console_log("Base de données initialisée -> table membres.");
    }

    try {
        $sql = "SELECT 1 FROM roles;";
        $db->query($sql);
        $table_exists = true;
    }
    catch (PDOException $error) {
        $table_exists = false;
        //print($error);
    }

    if (!$table_exists)

    {
        $sql = "CREATE table roles(
            ID INT( 16 ) PRIMARY KEY,
            name VARCHAR( 30 ) NOT NULL,
            prefix VARCHAR( 30 ) NULL,
            color VARCHAR( 25 ) NOT NULL,
            permissions INT (32) NOT NULL DEFAULT '0',
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP)
            CHARSET=utf8 COLLATE utf8_unicode_ci;";
        $db->exec($sql);
        console_log("Base de données initialisée -> table roles.");

        try {
            $sql = "INSERT INTO roles(ID, name, prefix, color, permissions) VALUES(?, ?, ?, ?, ?)";

            $insert_role = $db->prepare($sql);
            $insert_role->execute(array(0, "Membres", NULL, "#167D7F", 0));

            $insert_role = $db->prepare($sql);
            $insert_role->execute(array(1, "Fondateur", "[F]", "#F37970", 1));

            $insert_role = $db->prepare($sql);
            $insert_role->execute(array(2, "Administrateur", "[A]", "#E43D40", 2));

            $insert_role = $db->prepare($sql);
            $insert_role->execute(array(4, "Modérateur", "[M]", "#FF9636", 80));
            return (true);
        }
        catch (PDOException $error) {
            //console_log($error);
        }
    }
}