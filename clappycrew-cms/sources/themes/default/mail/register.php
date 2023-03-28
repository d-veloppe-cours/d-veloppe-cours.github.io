<?php

function get_register()
{
    return (
'<html>
   <style> .barre {
    left: 0;
    bottom: 0;
    height: 100px;
    width: 100%;
    padding-top: 35px;
    background-color: rgb(29, 24, 24);
    color: white;
    text-align: center;
} </style>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <head>
       <title>Inscription | ' .get_config()["name"]. '</title>
   </head>
   <body class="container">
   <div  style="background-color: whitesmoke;">
        <h1 class="barre">
            Inscription '.get_config()["name"]. '
        </h1>
        <br>
        <h2 class="container">
           Merci d\'avoir rejoint ' .get_config()["name"]. '<br>
            Connectez vous en cliquant <a href="http://' . get_config()["url"] . '/login">ici</a>
       </h2>
       <br>
       <p class="barre"> ClappyCrew &copy; 2018 - ' . date("Y") . ' • <a class="red-display purple-link" href="'.get_page_url("CGU").'" target="_blank"> Mentions Légales </a></p>
   </div>
   </body>
   
</html>'
    );
}