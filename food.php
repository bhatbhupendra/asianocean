<?php require_once "load.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food</title>
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/food.css">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <script src="https://kit.fontawesome.com/95de92f59b.js" crossorigin="anonymous"></script>
</head>
<body>

    <?php include "templates/header.php" ?>

    <!-- Food Menu Section Ends Here -->
    <section class="food-recomended">
        <div class="container">
            <h1 class="menu-title">食べ物を勧める</h1>
            
            <div class="menu-wrapper">
                <?php $recommendedData = $adminObj->getRecommended(); ?>
                <?php foreach($recommendedData as $row){ ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <img src="assets/uploads/<?php echo $row['image_url'] ?>" alt="<?php echo $row['name'] ?>" class="img-responsive img-curve">
                        </div>
        
                        <div class="food-menu-desc">
                            <h3><?php echo $row['name'] ?></h3>
                            <p class="food-detail">
                                <?php echo $row['description'] ?>
                            </p>
                            <div class="price-button-wrapper">
                                <p class="food-price"><?php echo $row['price'] ?>¥</p>
                                <button class="btn-primary-food-menu-item">
                                    <a href="#">今すぐ注文</a>
                                </button>
                            </div>      
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Food Menu Section Ends Here -->


    <section class="food-section">
        <div class="container">
            <h1 class="title">食べ物を勧める</h1>
            <div class="food-wrapper">
                <?php $subCategoryData = $adminObj->getSubCategoryFood(); ?>
                <?php foreach($subCategoryData as $row){ ?>
                    <?php $foodData = $adminObj->sub_category_meal_list($row['id']); ?>
                    <?php $SN = 1 ?>
                    <?php if($foodData){?>
                        <div class="food-box">
                            <h1 class="sub-title"><?php echo $row['name'] ?></h1>
                            <table>
                                <?php foreach($foodData as $row){ ?>
                                    <tr>
                                        <td id="td_sn"><?php echo $SN ?></td>
                                        <td id="td_image"><img src="assets/uploads/<?php echo $row['image_url'] ?>" height="60" alt=""></td>
                                        <td id="td_name_desc">
                                            <span id="span_name"><?php echo $row['name'] ?></span>
                                            <span id="span_desc"><?php echo $row['description'] ?></span>
                                        </td>
                                        <td id="td_price">¥ <?php echo $row['price'] ?></td>
                                    </tr>
                                    <?php $SN += 1 ?>
                                <?php } ?>
                            </table>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php include "templates/footer.php" ?>
    <script src="assets/js/main.js"></script>
</body>
</html>

