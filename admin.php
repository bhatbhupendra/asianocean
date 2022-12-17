<?php
    require_once "load.php";
    session_start();
    
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true){              
        header("location: login.php");
    }

    if(isset($_POST['searchMeal'])){
        $mealData = $adminObj->searchMeal($_POST['searchKey']);
    }elseif(isset($_GET['view_category_list_id'])){
        $mealData = $adminObj->category_meal_list((int)$_GET['view_category_list_id']);
    }elseif(isset($_GET['view_sub_category_list_id'])){
        $mealData = $adminObj->sub_category_meal_list((int)$_GET['view_sub_category_list_id']);
    }else{
        $mealData = $adminObj->getMeal();
    }


    if(isset($_GET['view_id'])){
        $meal_id = (int)$_GET['view_id'];
        $mealDetail = $adminObj->getMealDetail($meal_id);
    }

    
    if(isset($_GET['delete_id'])){
        $meal_id = (int)$_GET['delete_id'];
        $adminObj->removeMeal($meal_id);
    }

    if(isset($_GET['unrec_id'])){
        $meal_id = (int)$_GET['unrec_id'];
        $mealDetail = $adminObj->unrecommend($meal_id);
    }

    if(isset($_GET['delete_category_id'])){
        $id = (int)$_GET['delete_category_id'];
        $mealDetail = $adminObj->deleteCategory($id);
    }

    if(isset($_GET['delete_sub_category_id'])){
        $id = (int)$_GET['delete_sub_category_id'];
        $mealDetail = $adminObj->deleteSubCategory($id);
    }

    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="assets/css/admin/admin.css">
    <link rel="stylesheet" href="assets/css/admin/reuse.css">
    <script src="https://kit.fontawesome.com/118a820504.js" crossorigin="anonymous"></script>
</head>
<body>

    <section class="nav">
        <div class="container">
            <div class="title">Asian Ocean Admin</div>
            <div class="info">
                <div class="current-user">
                    <i class="fa-solid fa-circle-user"></i>
                    <span>
                        <?php
                           if(isset($_SESSION['email'])){
                                echo $_SESSION['email'];
                            }else{
                                echo "Unknow User";
                            }    
                        ?>
                    </span>
                </div>
                <div class="logout">
                    <button class="logout-button">
                        <a href="logout.php">Log Out</a>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="admin">
        <div class="dashboard-tab">
            <div class="overview active">
                <span>Overview</span>
            </div>
            <div class="menu">
                <span>Menu</span>
            </div>
            <div class="categories">
                <span>Categories</span>
            </div>
        </div>
        <div class="dashboard-body">
            <div class="dashboard-item-overview">
                <div class="search">
                    <form action="admin.php" method="post">
                        <div class="input-search">
                            <input type="text" id="searchKey" name="searchKey" placeholder="Search Meals & Drinks">
                        </div>
                        <div class="input-submit">
                            <input type="submit" id="searchMeal" name="searchMeal" value="Search">
                        </div>
                        <button class="add-button" type="button" id="addMealButton">
                            Add Item
                        </button>
                        <button class="add-button" type="button" id="refresh">
                            <a href="admin.php">Refresh</a>
                        </button>
                    </form>
                </div>

                <h1 class="menu-title">食品</h1>

                <div class="meal">
                    <div class="table">
                        <table>
                            <?php $SN = 1 ?>
                            <?php foreach($mealData as $row){ ?>
                                <tr>
                                    <td><?php echo $SN ?></td>
                                    <td><img src="assets/uploads/<?php echo $row['image_url'] ?>" height="60" alt=""></td>
                                    <td id="td_name_desc">
                                        <span id="span_desc_id"><?php echo $row['name'] ?></span>
                                        <span id="span_desc_id"><?php echo $row['description'] ?></span>
                                    </td>
                                    <td>¥ <?php echo $row['price'] ?></td>
                                    <td>
                                        <button class="view-button" type="button">
                                            <a href="admin.php?view_id=<?php echo $row['meal_id'] ?>">View</a>
                                        </button>
                                        <button class="delete-button" type="button">
                                            <a href="admin.php?delete_id=<?php echo $row['meal_id'] ?>">Remove</a>
                                        </button>
                                    </td>
                                </tr>
                                <?php $SN += 1 ?>
                            <?php } ?>
                        </table>
                    </div>
                    <div class="view">
                        <h2>プレビュー</h2>
                        <div class="food-menu-box">
                            <?php if(isset($_GET['view_id'])){ ?>
                                <div class="food-menu-img">
                                    <img src="assets/uploads/<?php echo $mealDetail['image_url'] ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                </div>
                
                                <div class="food-menu-desc">
                                    <h3><?php echo $mealDetail['name'] ?></h3>
                                    <p class="food-detail">
                                        <?php echo $mealDetail['description'] ?>
                                    </p>      
                                </div>
                            <?php }else{ echo "Preview" ;} ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-item-menu">
                <div class="recommended">
                    <h1 class="menu-title">食べ物を勧める</h1>
                    <div class="menu-wrapper">
                        <?php $recommendedData = $adminObj->getRecommended(); ?>
                        <?php foreach($recommendedData as $row){ ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <img src="assets/uploads/<?php echo $row['image_url'] ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                </div>
                
                                <div class="food-menu-desc">
                                    <h4><?php echo $row['name'] ?></h4>
                                    <p class="food-detail"><?php echo $row['description'] ?></p>
                                    <div class="price-button-wrapper">
                                        <p class="food-price"><?php echo $row['price'] ?>¥</p>
                                        <button class="btn-primary-food-menu-item">
                                            <a href="admin.php?unrec_id=<?php echo $row['meal_id'] ?>">Unrecomend</a>
                                        </button>
                                    </div>      
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="menu">
                    <div class="food">
                        <h1 class="menu-title">食べ物</h1>
                        <div class="table">
                            <table>
                                <?php $foodData = $adminObj->getMenuFood(); ?>
                                <?php $SN = 1 ?>
                                <?php foreach($foodData as $row){ ?>
                                    <tr>
                                        <td><?php echo $SN ?></td>
                                        <td><img src="assets/uploads/<?php echo $row['image_url'] ?>" height="60" alt=""></td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td>¥ <?php echo $row['price'] ?></td>
                                        <td>
                                            <button class="view-button" type="button">
                                                <a href="edit.php?edit_id=<?php echo $row['meal_id'] ?>">Edit</a>
                                            </button>
                                            <button class="delete-button" type="button">
                                                <a href="admin.php?delete_id=<?php echo $row['meal_id'] ?>">Remove</a>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php $SN += 1 ?>  
                                <?php } ?>                            
                            </table>
                        </div>
                    </div>
                    <div class="drink">
                        <h1 class="menu-title">飲み物</h1>
                        <div class="table">
                            <table>
                                <?php $drinkData = $adminObj->getMenuDrink(); ?>
                                <?php $SN = 1 ?>
                                <?php foreach($drinkData as $row){ ?>
                                    <tr>
                                        <td><?php echo $SN ?></td>
                                        <td><img src="assets/uploads/<?php echo $row['image_url'] ?>" height="60" alt=""></td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td>¥ <?php echo $row['price'] ?></td>
                                        <td>
                                            <button class="view-button" type="button">
                                                <a href="edit.php?edit_id=<?php echo $row['meal_id'] ?>">Edit</a>
                                            </button>
                                            <button class="delete-button" type="button">
                                                <a href="admin.php?delete_id=<?php echo $row['meal_id'] ?>">Remove</a>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php $SN += 1 ?>  
                                <?php } ?> 
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-item-categories">
                <button class="add-button" type="button" id="addCategoryButton">
                    Add Category
                </button>
                <button class="add-button" type="button" id="addSubCategoryButton">
                    Add Sub Category
                </button>
                <div class="table">
                    <b>Categories</b>
                    <table>
                        <?php $categoryData = $adminObj->getCategory(); ?>
                        <?php $SN = 1 ?>
                        <?php foreach($categoryData as $row){ ?>
                            <tr>
                                <td><?php echo $SN ?></td>
                                <td width="200px"><?php echo $row['category_name'] ?></td>
                                <td><?php echo $adminObj->getCategoryMealCount($row['category_id']); ?> Food Linked</td>
                                <td>
                                    <button class="delete-button" type="button">
                                        <a href="admin.php?delete_category_id=<?php echo $row['category_id'] ?>">Remove</a>
                                    </button>
                                    <button class="view-button" type="button">
                                        <a href="admin.php?view_category_list_id=<?php echo $row['category_id'] ?>">View All</a>
                                    </button>
                                </td>
                            </tr>
                            <?php $SN += 1 ?>
                        <?php } ?>
                    </table>
                    <b>Sub Categories</b>
                    <table>
                        <?php $subCategoryData = $adminObj->getSubCategory(); ?>
                        <?php $SN = 1 ?>
                        <?php foreach($subCategoryData as $row){ ?>
                            <tr>
                                <td><?php echo $SN ?></td>
                                <td width="200px"><?php echo $row['name'] ?></td>
                                <td><?php echo $adminObj->getSubCategoryMealCount($row['id']); ?> Food Linked</td>
                                <td>
                                    <button class="delete-button" type="button">
                                        <a href="admin.php?delete_sub_category_id=<?php echo $row['id'] ?>">Remove</a>
                                    </button>
                                    <button class="view-button" type="button">
                                        <a href="admin.php?view_sub_category_list_id=<?php echo $row['id'] ?>">View All</a>
                                    </button>
                                </td>
                            </tr>
                            <?php $SN += 1 ?>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section class="addCategory">
        <div class="title">
            <h4>Add Category</h4>
            <i class="fa-solid fa-xmark" id="addCategoryPromptClose"></i>
        </div>
        <form action="addCategory.php" method="post">
            <div class="addCategory-input">
                <input type="text" id="categoryName" name="categoryName" placeholder="Categorie Name">
            </div>
            <div class="addCategory-submit">
                <input type="submit" id="addCategory" name="addCategory" value="Add Category">
            </div>
        </form>
    </section>

    <section class="addSubCategory">
        <div class="title">
            <h4>Add Sub Category</h4>
            <i class="fa-solid fa-xmark" id="addSubCategoryPromptClose"></i>
        </div>
        <form action="addSubCategory.php" method="post">
            <div class="addSubCategory-input">
                <input type="text" id="subCategoryName" name="subCategoryName" placeholder="Categorie Name">
            </div>
            <div class="addMeal-input">
                <label for="mealCategory">Category</label>
                <select name="mealCategory" id="mealCategory" required>
                    <?php $dataCategory = $adminObj->getCategory(); ?>
                    <?php foreach($dataCategory as $row){ ?>
                        <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></option>
                    <?php }?>
                </select>
            </div>
            <div class="addSubCategory-submit">
                <input type="submit" id="addSubCategory" name="addSubCategory" value="Add Sub Category">
            </div>
        </form>
    </section>


    <section class="addMeal">
        <div class="title">
            <h4>Add Meal</h4>
            <i class="fa-solid fa-xmark" id="addMealPromptClose"></i>
        </div>
        <form action="addMeal.php" method="post" enctype="multipart/form-data">
            <div class="addMeal-input">
                <label for="MealName">Name</label>
                <input type="text" id="mealName" name="mealName" placeholder="Meal Name" required>
            </div>
            <div class="addMeal-input">
                <label for="mealImage">Image</label>
                <input type="file" name="mealImage" id="mealImage" placeholder="Upload" required>
            </div>
            <div class="addMeal-input">
                <label for="mealPrice">Price</label>
                <input type="number" id="mealPrice" name="mealPrice" placeholder="Meal Price" required>
            </div>

            <div class="addMeal-input">
                <label for="mealCategory">Category</label>
                <select name="mealCategory" id="mealCategory" required>
                    <?php $dataCategory = $adminObj->getCategory(); ?>
                    <?php foreach($dataCategory as $row){ ?>
                        <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></option>
                    <?php }?>
                </select>
            </div>
            <div class="addMeal-input">
                <label for="mealSubCategory">Sub Category</label>
                <select name="mealSubCategory" id="mealSubCategory" required>
                    <?php $dataSubCategory = $adminObj->getSubCategory(); ?>
                    <?php foreach($dataSubCategory as $row){ ?>
                        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                    <?php }?>
                </select>
            </div>

            <div class="addMeal-input">
                <label for="mealDesc">Description</label>
                <textarea name="mealDesc" id="mealDesc" cols="48" rows="8" required></textarea>
            </div>
            <div class="addMeal-submit">
                <input type="submit" id="addMeal" name="addMeal" value="Add Meal">
            </div>
        </form>
    </section>
    <script src="assets/js/admin.js"></script>
    <script src="assets/js/addPanel.js"></script>
</body>
</html>