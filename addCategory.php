<?php
    require_once "load.php";
    session_start();

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true){              
        header("location: login.php");
    }

    if(isset($_POST['addCategory']) && $_POST['categoryName']){              
            $category_name = $_POST['categoryName'];
            $adminObj->addcategory($category_name);
    }
?>