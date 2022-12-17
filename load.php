<?php
    include 'config.php';
    include 'classes/admin.php';

    $adminObj = new Admin($conn);

    define("BASE_URL","http://localhost/asianocean");
?>