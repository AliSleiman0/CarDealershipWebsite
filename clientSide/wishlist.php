<!doctype html>
<html lang="en">
<?php
require_once('components/header.php');
require_once "../adminPanel/class/index.class.php";
require_once "../adminPanel/class/wishinvent.class.php";


// Make sure the user is logged in
session_start();


if (!isset($_SESSION['user_id'])) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Not Logged In',
                text: 'You need to sign in or sign up to continue.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sign In/Up',
                cancelButtonText: 'Cancel',
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'SignINUP/signinup.php';
                } else {
                    // Optional: Handle the cancel action
                }
            });
        });
    </script>
    ";
    exit();
}


$dal = new DAL();
$wishlist = new Wishinvent();
$slider = new sliders();

$customerID = $_SESSION['user_id'];
$wishlistItems = $wishlist->getWishlist($customerID);
?>

<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php require_once('components/header.php'); ?>
    <?php require_once "../adminPanel/class/index.class.php"; ?>
    <?php require_once "../adminPanel/class/cars.class.php"; ?>

    <?php
    $slider = new sliders();
    $car = new Car();
    $allCars = $car->getAllCars();
    $allMake = $car->getAllMake();
    $allModals = $car->getAllModel();
    $allYears = $car->getAllYears();

    $brandImages = $slider->getAllBrandImages();

    ?>
    <link href="components/allCarsStyle.css" rel="stylesheet">
    <style>
        body {
            background-color: #555;
        }

        .custom-card:hover {
            transform: scale(1.025);
            box-shadow: 0 4px 8px black;
            transform: translateY(-10px);
        }

        .custom-card-img img {
            transition: transform 0.3s ease;
        }


        .custom-card:hover .custom-card-img img {
            transform: scale(1.025);
        }

        @media (max-width: 600px) {
            .grid-container {
                display: flex;
                flex-direction: column;
            }

            .grid-item {
                width: 100%;
            }

            .custom-card {
                display: flex;
                flex-direction: column;
            }

            .custom-card-img,
            .custom-card-body {
                width: 100%;
            }

            .custom-card-img img {
                width: 100%;
                height: auto;
            }

            .custom-card-body {
                padding: 10px;
            }
        }

        @media (max-width: 1092px) {
            .grid-container {
                display: flex;
                flex-direction: column;
            }

            .grid-item {
                width: 100%;
            }

            .custom-card {
                display: flex;
                flex-direction: column;
            }

            .custom-card-img,
            .custom-card-body {
                width: 100%;
            }

            .custom-card-img img {
                width: 100%;
                height: auto;
            }

            .custom-card-body {
                padding: 10px;
            }
        }



        .no-items-found {
            text-align: center;

            padding: 50px;
            font-size: 24px;
            color: white;
        }

        .no-items-found h2 {
            font-size: 36px;
            color: white;
        }

        .no-items-found .fa-car-side {
            font-size: 100px;
            color: white;
        }

        .textcontainer {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
        }

        .fancy-wipe {
            font-weight: 900;
            font-size: 6rem;
            position: relative;
            --duration: 2s;

        }

        .text {
            color: white;
            animation: text-in var(--duration) infinite linear;
            mask: linear-gradient(to right, white, black 30%, black);
            mask-composite: exclude;
            mask-mode: luminance;
            mask-size: 100% 100%;
            mask-position: 0 0px;
        }

        .wipe-in {
            position: absolute;
            left: 0;
            background-image: linear-gradient(90deg,
                    #fff89a,
                    #cdf2ca,
                    #a2cdcd,
                    #d1e8e4,
                    #cab8ff,
                    #ff7878,
                    #ffc898);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: wipe-in var(--duration) infinite linear;
            mask: linear-gradient(to right, black, white);
            mask-composite: exclude;
            mask-mode: luminance;
            mask-size: 50% 100%;
            mask-position: 0px 0px;
        }

        @keyframes text-in {
            0% {
                clip-path: polygon(0 0, 0 0, 0 100%, 0 100%);
            }

            50% {
                clip-path: polygon(50% 0, 0 0, 0 100%, 50% 100%);
            }

            100% {
                clip-path: polygon(100% 0, 0 0, 0 100%, 100% 100%);
                mask-size: 1000% 100%;
            }
        }

        @keyframes wipe-in {
            0% {
                clip-path: polygon(0 0, 0 0, 0 100%, 0 100%);
                filter: blur(5px);
            }

            70% {
                clip-path: polygon(50% 0, 100% 0, 100% 100%, 50% 100%);
                filter: blur(5px);
                mask-position: 100% 100%;
            }

            100% {
                clip-path: polygon(100% 0, 100% 0, 100% 100%, 100% 100%);
                filter: blur(0);
                mask-position: 100% 100%;
            }
        }
    </style>

</head>

<body>
    <?php require_once('components/navSubPages.php'); ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <br>

  
    <div class="textcontainer">
        <h1 class="fancy-wipe">
            <span class="text">
                My Wishlist
            </span>
            <span class="wipe-in">
                My Wishlist
            </span>
        </h1>
    </div>
    <br>
    <?php if (empty($wishlistItems)) { ?>

        <div class="no-items-found">
            <i class="fas fa-car-side"></i>
            <h1 style="color:white">No Cars found in wishlist</h1>
            <div style="text-align:center">
                <button class="btn btn-secondary" style=" margin-top:20px; font-size:large; background-color: black; color: white; margin-bottom:10px; width:150px; border-color:white" onclick="history.back()">Back</button>
            </div>
        </div>
    <?php } else { ?>
        <div class="container">
            <div id="contentContainer" class="grid-container">

                <?php foreach ($wishlistItems as $car) {
                    $image = $slider->getRandomImagesByID($car['CarID']);
                ?>
                    <div class="grid-item">
                        <div class="panel panel-default custom-card">
                            <div class="custom-card-img">
                                <img src='../adminPanel/assets/img/allCars/<?php echo $image[0]['ImageName']; ?>' class="imgg img-responsive" alt="<?php echo $car['Make'] ?>-<?php echo $car['Model'] ?>">
                            </div>
                            <div class="custom-card-body">
                                <div class="panel-body">
                                    <small><?php echo $car['Year'] ?> | <?php echo $car['gear'] ?></small>
                                    <h4><?php echo $car['Make'] ?> <?php echo $car['Model'] ?></h4>
                                    <p><?php echo $car['Description'] ?></p>
                                    <div class="custom-card-footer">
                                        <div class="price-mpg">
                                            <span class="price">$<?php echo number_format($car['Price']); ?></span>
                                        </div>
                                    </div>
                                    <div class="btn-group btn-group-justified" role="group">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="explore" onclick="window.location.href='car.php?id=<?php echo $car['CarID'] ?>'">Explore</button>
                                        </div>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="remove-from-wishlist explore" data-carid="<?php echo $car['CarID'] ?>">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
            </div>
        </div>


        <!-- gridItem.fadeOut(300, function() {
                                $(this).remove();
                            }); -->


        <?php require_once('components/footersub.php'); ?>
        <?php require_once('components/script.php'); ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.remove-from-wishlist').click(function() {
                    var carID = $(this).data('carid');
                    var gridItem = $(this).closest('.grid-item');

                    $.ajax({
                        url: 'actions/remove_from_wishlist.php',

                        method: 'POST',
                        data: {
                            carID: carID
                        },
                        success: function(response) {
                            if (response === 'success') {
                                gridItem.fadeOut(300, function() {
                                    $(this).remove();
                                });
                            } else {
                                alert('Failed to remove item from wishlist');
                            }
                        }
                    });
                });
            });
        </script>
</body>



</html>