<!doctype html>
<html lang="en">
<?php
require_once('components/header.php');
require_once "../adminPanel/class/index.class.php";
require_once "../adminPanel/class/wishinvent.class.php";
require_once "../adminPanel/class/CustomerCars.class.php";

// Make sure the user is logged in
session_start();


$slider = new sliders();
$caro = new CustomerCar();

// Fetch inventory data from session
$inventory = isset($_SESSION['inventory']) ? $_SESSION['inventory'] : [];

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

    <link href="components/allCarsStyle.css" rel="stylesheet">
    <style>
        body {
            background-color: #333333;
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

        .heado {
            text-align: center;
        }

        .headop {
            font-size: xx-large;
            color: white;
            font-weight: bold;
        }

        .headop:hover {
            transition: 500ms;
            color: black;
            font-size: 5vh;
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

        .badge {
            display: inline-block;
            padding: 0.35em 0.65em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.375rem;
        }

        .badge-red {
            background-color: #dc3545;
        }

        .badge-blue {
            background-color: #007bff;
        }

        .badge-brown {
            background-color: #8b4513;
        }

        .badge-black {
            background-color: #000000;
        }

        .badge {
            margin: 2px;
        }

        .icon-btn {
            color: white;
            background-color: black;
            border: 1px solid white;
            margin-bottom: 15px;
            margin-left: 10px;
            padding: 12px;

            border-radius: 6%;
        }

        .icon-btn:hover {
            color: black;
            background-color: white;
            border: 2px solid black;
            margin-bottom: 15px;
            margin-left: 10px
        }

       
    </style>

</head>

<body>
    <?php require_once('components/navSubPages.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <br>
    <div class="heado">
        <h1 class="headop">My Inventory</h1>
    </div>
    <br>

    <?php if (empty($inventory)) { ?>
        <div class="no-items-found">
            <i class="fas fa-car-side"></i>
            <h1 style="color:white">No Cars found in inventory</h1>
        </div>
    <?php } else { ?>
        <div class="container">
            <button class=" mt-3 icon-btn" onclick="window.location.href='checkout.php'">
                <i class="fas fa-credit-card"></i> Proceed to Checkout
            </button>
            <div id="contentContainer" class="grid-container">

                <?php foreach ($inventory as $carID => $colors) {
                    foreach ($colors as $color => $quantity) {
                        $carDetails = $caro->getCarById($carID);
                        $image = $slider->getRandomImagesByID($carID);
                ?>
                        <div class="grid-item">
                            <div class="panel panel-default custom-card">
                                <div class="custom-card-img">
                                    <img style="height:320px" src='../adminPanel/assets/img/allCars/<?php echo $image[0]['ImageName']; ?>' class="imgg img-responsive" alt="<?php echo $carDetails[0]['Make'] ?>-<?php echo $carDetails[0]['Model'] ?> ">
                                </div>
                                <div class="custom-card-body">
                                    <div class="panel-body">
                                        <small><?php echo $carDetails[0]['Year'] ?> | <?php echo $carDetails[0]['gear'] ?></small>
                                        <h4><?php echo $carDetails[0]['Make'] ?> <?php echo $carDetails[0]['Model'] ?></h4>
                                        <p><?php echo $carDetails[0]['Description'] ?></p>
                                        <div>
                                            <span class="badge badge-<?php echo strtolower($color); ?>"><?php echo $color; ?> </span>
                                        </div>
                                        <div class="custom-card-footer">
                                            <div class="price-mpg">
                                                <span class="price">$<?php echo number_format($carDetails[0]['Price']); ?></span>
                                            </div>
                                        </div>
                                        <div class="btn-group btn-group-justified" role="group">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="explore" onclick="window.location.href='car.php?id=<?php echo $carID ?>'">Explore</button>
                                            </div>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="remove-from-inventory explore" data-carid="<?php echo $carID ?>" data-color="<?php echo $color; ?>">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } ?>
            <?php } ?>
            </div>
        </div>

        <?php require_once('components/footersub.php'); ?>
        <?php require_once('components/script.php'); ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.remove-from-inventory').click(function() {
                    var carID = $(this).data('carid');
                    var color = $(this).data('color');
                    var gridItem = $(this).closest('.grid-item');

                    $.ajax({
                        url: 'actions/remove_item.php',
                        method: 'POST',
                        data: {
                            carId: carID,
                            color: color
                        },
                        success: function(response) {
                            var result = JSON.parse(response);
                            if (result.success) {
                                gridItem.fadeOut(300, function() {
                                    $(this).remove();
                                });
                            } else {
                                alert('Failed to remove item from inventory: ' + result.message);
                            }
                        }
                    });
                });
            });
        </script>


</body>

</html>