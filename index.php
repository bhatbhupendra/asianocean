<?php require_once "load.php"; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>アジアンオシャン</title>
        <link rel="stylesheet" href="assets/css/reset.css">
        <link rel="stylesheet" href="assets/css/header.css">
        <link rel="stylesheet" href="assets/css/main-carousel.css">
        <link rel="stylesheet" href="assets/css/service.css">
        <link rel="stylesheet" href="assets/css/food-menu.css">
        <link rel="stylesheet" href="assets/css/drink-menu.css">
        <link rel="stylesheet" href="assets/css/footer.css">
        <link rel="stylesheet" href="assets/css/2hrDrink.css">
        <script src="https://kit.fontawesome.com/95de92f59b.js" crossorigin="anonymous"></script>

</head>
<body>
    
    <?php include "templates/header.php" ?>

    <!-- Main carousel Section Starts Here -->
    <section class="main-carousel">
        <div class="carousel-wrapper">
            <div class="info">
                <p class="small">典型的な食べ物を楽しむ</p>
                <p class="large">いろいろな料理</p>
                <p class="large">経験</p>
                <button class="btn-explore">
                    <a href="menu.php">メニューを見る</a>
                </button>
            </div>
        </div>
    </section>
    <!-- Main carousel Section Ends Here -->

    <!-- Main service Section Starts Here -->
    <section class="service-section">
        <div class="service-wrapper">
            <div class="service-info">
                <h1>会って、食べて、楽しむ</h1>
                <span>どこにも存在しない最もクールな食べ物を作る食べ物を探る!!!</span>
                <div class="service-info-vector">
                    <figure></figure>
                    <figure></figure>
                </div>
                <div class="service-vector-info-link">
                    <a href="https://bit.ly/3ftz3BW" target="_blank"><span>お届け</span></a>
                    <a href="#"><span>お持ち帰り</span></a>
                </div>
            </div>
            <div class="service-image">
              <div class="service-image-wrapper">
                <figure></figure>
              </div>
            </div>
        </div>
    </section>
    <!-- Main service Section Starts Here -->

    <!-- 2hr Section Ends Here -->

    <section class="twohrDrink-secton">
        <h1>ノミホダイ</h1>
        <h5>ドリンクメニュー</h5>
        <div class="twohrDrink-wrapper">

        </div>
    </section>

    <!-- 2hr carousel Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h1 class="menu-title">フードメニュー</h1>
            
            <div class="menu-wrapper">
                <?php $foodData = $adminObj->getMenuFood(); ?> 
                <?php $SN = 1 ?>
                <?php foreach($foodData as $row){ ?>
                    <?php if($SN<=4){ ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <img src="assets/uploads/<?php echo $row['image_url'] ?>" alt="<?php echo $row['name'] ?>" >
                            </div>
            
                            <div class="food-menu-desc">
                                <h3><?php echo $row['name'] ?></h3>
                                <p class="food-price"><?php echo $row['price'] ?> ¥</p>
                                <p class="food-detail">
                                    <?php echo $row['description'] ?>
                                </p>
                                
            
                                <button class="btn-primary-food-menu-item">
                                    <a href="">今すぐ注文</a>
                                </button>
                            </div>
                        </div>
                    <?php } ?>
                    <?php $SN += 1 ?>  
                <?php } ?>
            </div>
            <div class="menu-view-more">
                <button class="btn-view-more-food">
                    <a href="food.php">より詳しい情報 &nbsp;<i class="fa-solid fa-forward"></i></a>
                </button>
            </div>
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- Drink Menu Section Ends Here -->
    <section class="drink-menu">
        <div class="container">
            <h1 class="menu-title">飲み物</h1>
            
            <div class="menu-wrapper">
                <?php $drinkData = $adminObj->getMenuDrink(); ?>
                <?php $SN = 1 ?>
                <?php foreach($drinkData as $row){ ?>
                    <?php if($SN<=4){ ?>
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
                                        <a href="">今すぐ注文</a>
                                    </button>
                                </div>      
                            </div>
                        </div>
                    <?php } ?> 
                    <?php $SN += 1 ?>  
                <?php } ?> 
            </div>
            <div class="menu-view-more">
                <button class="btn-view-more-drink">
                    <a href="drink.php">より詳しい情報 &nbsp;<i class="fa-solid fa-forward"></i></a>
                </button>
            </div>
        </div>

    </section>
    <!-- Drink Menu Section Ends Here -->


    <?php include "templates/footer.php" ?>


<script src="assets/js/main.js"></script>
</body>
</html>