<?php
    require_once "load.php";
    session_start();

    if(isset($_GET['edit_id'])){
        $meal_id = (int)$_GET['edit_id'];
        $mealDetail = $adminObj->getMealDetail($meal_id);
    }

    
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true){              
        header("location: login.php");
    }
    if(isset($_POST['editMeal'])){   
        $name = $_POST['mealName'];

        //for image start
        if(isset($_FILES['mealImage'])){
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
        }

        //for image end

        $price = $_POST['mealPrice'];
        $category = $_POST['mealCategory'];
        $subCategory = $_POST['mealSubCategory'];
        $desc = $_POST['mealDesc'];

        //the function calll
        $adminObj->editmeal((int)$_GET['edit_id'],$name,$new_img_name,$price,$category,$subCategory,$desc);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/edit.css">
    <link rel="stylesheet" href="assets/css/reuse.css">
    <title>Edit Page</title>
</head>
<body>

    <div class="edit">
        <div class="previous-data">
            <div class="view">
                <h2>Previous Data</h2>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <img src="assets/uploads/<?php echo $mealDetail['image_url'] ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>
                    <div class="food-menu-desc">
                        <h3><?php echo $mealDetail['name'] ?></h3>
                        <p class="food-detail">
                            <?php echo $mealDetail['description'] ?>
                        </p>      
                    </div>
                </div>
            </div>
        </div>
        <div class="new-data-form">
            <h2>New Data Form</h2>
            <form action="edit.php?edit_id=<?php echo $meal_id ?>" method="post" enctype="multipart/form-data">
                <div class="editMeal-input">
                    <label for="MealName">Name</label>
                    <input type="text" id="mealName" name="mealName" placeholder="Meal Name">
                </div>
                <div class="editMeal-input">
                    <label for="mealImage">Image</label>
                    <input type="file" name="mealImage" id="mealImage" placeholder="Upload">
                </div>
                <div class="editMeal-input">
                    <label for="mealPrice">Price</label>
                    <input type="number" id="mealPrice" name="mealPrice" placeholder="Meal Price">
                </div>
                <div class="editMeal-input">
                    <label for="mealCategory">Category</label>
                    <select name="mealCategory" id="mealCategory">
                        <option value="">------------</option>
                        <?php $dataCategory = $adminObj->getCategory(); ?>
                        <?php foreach($dataCategory as $row){ ?>
                            <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="editMeal-input">
                    <label for="mealSubCategory">Sub Category</label>
                    <select name="mealSubCategory" id="mealSubCategory">
                        <option value="">------------</option>
                        <?php $dataSubCategory = $adminObj->getSubCategory(); ?>
                        <?php foreach($dataSubCategory as $row){ ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="editMeal-input">
                    <label for="mealDesc">Description</label>
                    <textarea name="mealDesc" id="mealDesc" cols="48" rows="8"></textarea>
                </div>
                <div class="editMeal-submit">
                    <input type="submit" id="editMeal" name="editMeal" value="edit Meal">
                </div>
            </form>
        </div>
    </div>

    
</body>
</html>