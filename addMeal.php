<?php
    require_once "load.php";
    session_start();

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true){              
        header("location: login.php");
    }

    if(isset($_POST['addMeal']) && isset($_FILES['mealImage'])){    
        $name = $_POST['mealName'];

        //for image start

        $img_name = $_FILES['mealImage']['name'];
        $tmp_name = $_FILES['mealImage']['tmp_name'];
        $error = $_FILES['mealImage']['error'];

        if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg", "jpeg", "png"); 
            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = 'assets/uploads/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
            }else {
                $_SESSION['error'] = "You can't upload files of this type";
                header("location: admin.php");
            }
        }else {
            $_SESSION['error'] = "unknown error occurred!";
            header("location: admin.php");
        }

        //for image end

        $price = $_POST['mealPrice'];
        $category = $_POST['mealCategory'];
        $subCategory = $_POST['mealSubCategory'];
        $desc = $_POST['mealDesc'];

        //the function calll
        $adminObj->addmeal($name,$new_img_name,$price,$category,$subCategory,$desc);
    }
?>