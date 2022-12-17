<?php require_once "load.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drink</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/drink.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/95de92f59b.js" crossorigin="anonymous"></script>
</head>
<body>

    <!-- Header Section -->
    <?php include "templates/header.php" ?>

    <section class="menu-drinks">
        <div class="munu-drink-wrapper">
            <?php $subCategoryData = $adminObj->getSubCategoryDrink(); ?>
            <?php foreach($subCategoryData as $row){ ?>
                <?php $drinkData = $adminObj->sub_category_meal_list($row['id']); ?>
                <?php if($drinkData){?>
                    <div class="drink-box">
                        <div class="drink-box-item">
                            <h2><?php echo $row['name'] ?></h2>
                            <div class="wrapper">
                                <table>
                                    <?php foreach($drinkData as $row){ ?>
                                        <tr>
                                            <td>
                                                <span id="span_name"><?php echo $row['name'] ?></span>
                                                <span id="span_desc"><?php echo $row['description'] ?></span>
                                            </td>
                                            <td>¥ <?php echo $row['price'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                                <div class="owl-carousel-wrapper">
                                    <div class="owl-carousel owl-theme owl-loaded">
                                    <?php foreach($drinkData as $row){ ?>
                                        <div class="item">
                                            <img src="assets/uploads/<?php echo $row['image_url'] ?>" alt="">
                                        </div>
                                    <?php } ?>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </section>



    <?php include "templates/footer.php" ?>



    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js" integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js" integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:false,
            dots:false,
            autoplay:true,
            autoplayTimeout:5000,
            mouseDrag:false,
            // center:true,
            animateIn:'fadeIn',
            animateOut: 'fadeOut',
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        })
    </script>
    <script src="assets/js/main.js"></script>
</body>
</html>