<?php
    require_once "load.php";
    session_start();

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true){              
        header("location: login.php");
    }

    if(isset($_POST['addSubCategory']) && $_POST['subCategoryName']){              
            $category_name = $_POST['subCategoryName'];
            $category = $_POST['mealCategory'];
            $adminObj->addSubCategory($category_name, $category);
    }
?>