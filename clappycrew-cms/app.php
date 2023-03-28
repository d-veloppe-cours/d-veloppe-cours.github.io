<?php
include './sources/system/functions/load_page.php';
include './sources/system/functions/get_tools.php';
include './sources/system/functions/get_mysql.php';
include './sources/system/functions/send_mail.php';
include './sources/system/functions/get_admin.php';

session_start();
$target = $_SERVER['REQUEST_URI'];
?>

<?= load_page($target); ?>