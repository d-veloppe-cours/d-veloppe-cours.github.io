<?php

function has_space(string $string)

{
    return (
        str_contains($string, " ") ||
        str_contains($string, "\f") ||
        str_contains($string, "\n") ||
        str_contains($string, "\r") ||
        str_contains($string, "\t") ||
        str_contains($string, "\v")
    );
}

function login(string $user_email, string $user_password)
{
    $db = mysql_connect();

    if ($db)
    
    {
        $requser = $db->prepare("SELECT * FROM members WHERE email = ? AND password = ?");
        $requser->execute(array($user_email, $user_password));
        $userexist = $requser->rowCount();
        if($userexist == 1)
        {
            $user_data = $requser->fetch();
            $_SESSION['id'] = $user_data['ID'];
            $_SESSION['account'] = $user_data['account'];
            $_SESSION['email'] = $user_data['email'];
            $_SESSION['firstname'] = $user_data['firstname'];
            $_SESSION['lastname'] = $user_data['name'];

            //send_login_mail($user_email);
            if (get_config()["https"] == true)
                header("Location: https://".get_config()["url"]."/profil");
            else
                header("Location: http://".get_config()["url"]."/profil");
        }

        else

        {
            print_error("Mail ou mot de passe incorrect.");
        }
    }

    else

    {
        print_error("Erreur interne, contactez l'adminisateur.");
    }
}

function let_login()

{
    if (!empty($_POST["user_email"]) && !empty($_POST["user_password"]))

    {
        $user_email = htmlspecialchars($_POST["user_email"]);
        $user_password = sha1($_POST["user_password"]);

        $secret = "6Leyp6gkAAAAAKnSgL-0M226oi7D6FE_z6RVXEXD";
        $response = htmlspecialchars($_POST['g-recaptcha-response']);
        $remoteip = get_ip();
        $request = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";

        $get = file_get_contents($request);
        $decode = json_decode($get, true);

        if ($decode["success"])

        {
            login($user_email, $user_password);
            return(true);
        }

        else

        {
            print_error("Veuillez valider le captcha");
        }
    }

    else

    {
        print_error("Veuillez remplir tous les champs");
    }
    return(false);
}

function register(array $user)

{
    $db = mysql_connect();
    if ($db)

    {
        try {
            $insert_user = $db->prepare("INSERT INTO members(last_name, first_name, account, email, password, last_login_ip) VALUES(?, ?, ?, ?, ?, ?)");
            $insert_user->execute(array($user["lastname"], $user["firstname"], $user["account"],  $user["email"], $user["password"], get_ip()));
            send_register_mail($user["email"]);
            return (true);
        }
        catch (PDOException $error) {
            console_log("Accès refusé à la base de données.");
        }
    }
    return (false);
}

function let_register()

{
    if ($_POST["CGU"])

    {
        if (
            !empty($_POST["user_lastname"]) &&
            !empty($_POST["user_firstname"]) &&
            !empty($_POST["user_account"]) &&
            !empty($_POST["user_email"]) &&
            (isset($_POST["user_password"]) && !empty($_POST["user_password"])) &&
            (isset($_POST["user_confirm_password"]) && !empty($_POST["user_confirm_password"]))
        )

        {
            $user = array(
                "lastname" => htmlspecialchars(trim($_POST['user_lastname'])),
                "firstname" => htmlspecialchars(trim($_POST['user_firstname'])),
                "account" => htmlspecialchars(trim($_POST['user_account'])),
                "email" => htmlspecialchars(trim($_POST['user_email'])),
                "password" => sha1(trim($_POST['user_password']))
            );

            $user_password = htmlspecialchars(trim($_POST['user_password'])); 
            $confirm_password = htmlspecialchars(trim($_POST['user_confirm_password'])); //sha1($_POST['user_confirm_password']);

            $secret = "6Leyp6gkAAAAAKnSgL-0M226oi7D6FE_z6RVXEXD";
            $response = htmlspecialchars($_POST['g-recaptcha-response']);
            $remoteip = get_ip();
            $request = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";

            $get = file_get_contents($request);
            $decode = json_decode($get, true);

            if ($decode["success"])

            {
                unset($_POST['user_password']);
                unset($_POST['user_confirm_password']);

                if (
                    !contains_non_ascii($user["lastname"]) &&
                    !contains_non_ascii($user["firstname"]) &&
                    !contains_non_ascii($user["account"]) &&
                    !contains_non_ascii($user["email"]) &&
                    !contains_non_ascii($user_password) &&
                    !contains_non_ascii($confirm_password)
                )

                {
                    $len = strlen($user["lastname"]);
                    if ($len > 0 && $len < 31)

                    {
                        $len = strlen($user["firstname"]);
                        if ($len > 0 && $len < 26)

                        {
                            $len = strlen($user["account"]);
                            if ($len > 2  && $len < 19)

                            {
                                if (!has_space($user["account"]))

                                {
                                    if (!has_space($user["email"]) && filter_var($user["email"], FILTER_VALIDATE_EMAIL))

                                    {
                                        $len = strlen($user["email"]);
                                        if ($len > 0 && $len < 41)

                                        {
                                            $len = strlen($user_password);
                                            if ($len > 7 && $len < 33)

                                            {
                                                if (!has_space($user_password))

                                                {
                                                    if ($user_password == $confirm_password)

                                                    {
                                                        $db = mysql_connect();

                                                        if ($db)
                                                        
                                                        {
                                                            $reqmail = $db->prepare("SELECT * FROM members WHERE email = ?");
                                                            $reqmail->execute(array($user["email"]));

                                                            if($reqmail->rowCount() == 0)

                                                            {
                                                                $reqaccount = $db->prepare("SELECT * FROM members WHERE account = ?");
                                                                $reqaccount->execute(array($user["account"]));

                                                                if ($reqaccount->rowCount() == 0)

                                                                {
                                                                    register($user);
                                                                    if (get_config()['autolog'])
                                                                    {
                                                                        login($user["email"], $user["password"]);
                                                                    }
                                                                    return (true);
                                                                }

                                                                else

                                                                {
                                                                    print_error("Le nom du compte est déjà utilisé.");
                                                                }
                                                            }
                                                            
                                                            else

                                                            {
                                                                print_error("Ce mail est déjà utilisé.");
                                                            }
                                                        }

                                                        else

                                                        {
                                                            print_error("Erreur interne, contactez l'adminisateur.");
                                                        }
                                                    }

                                                    else

                                                    {
                                                        print_error("Les deux mots de passe ne correspondent pas!");
                                                    }
                                                }

                                                else

                                                {
                                                    print_error("Le mot de passe ne peut pas contenir d'espace!");
                                                }
                                            }

                                            else

                                            {
                                                print_error("Le mot de passe doit être composé de 8 à 32 caractères!");
                                            }
                                        }

                                        else

                                        {
                                            print_error("L'email ne peut pas faire plus de 40 caractères!");
                                        }
                                    }

                                    else

                                    {
                                        print_error("Veuillez donner un mail valide!");
                                    }
                                }

                                else

                                {
                                    print_error("Le nom du compte ne doit pas contenir d'espace!");
                                }
                            }

                            else

                            {
                                print_error("Le nom du compte doit être composé de 3 à 18 caractères!");
                            }
                        }

                        else

                        {
                            print_error("Le prénom doit être composé de 1 à 25 caractères!");
                        }
                    }

                    else

                    {
                        print_error("Le nom doit être composé de 1 à  30 caractères!");
                    }
                }

                else

                {
                    print_error("Veuillez donner des caractères ASCII uniqument !");
                }
            }

            else

            {
                print_error("Veuillez valider le captcha!");
            }
        }

        else

        {
            print_error("Veuillez remplir tous les champs!");
        }
    }

    else

    {
        print_error("Veuillez accepter les CGU!");
    }
    return (false);
}