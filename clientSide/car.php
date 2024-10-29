<?php
session_start();
require_once "../adminPanel/class/CustomerCars.class.php";

$car = new CustomerCar();

// Assume you're getting the car ID from the URL parameter
$carId = isset($_GET['id']) ? $_GET['id'] : 1;

// Fetch car details
$carDetails = $car->getCarById($carId);
$carImages = $car->getCarImages($carId);
$carFeatures = $car->getCarFeatures($carId);
$carWarranty = $car->getCarWarranty($carId);
// Add this after fetching car details


// Check if the car is already in inventory
$isInInventory = isset($_SESSION['inventory']) && isset($_SESSION['inventory'][$carId]);

// Check added colors for the car
$addedColors = $isInInventory ? $_SESSION['inventory'][$carId] : [];
$colors = ['Red', 'Blue', 'Green', 'Black', 'White', 'Silver', 'Gray', 'Yellow', 'Orange', 'Brown'];

$carInfo = $carDetails[0];
$relatedCars = $car->getRelatedCars($carInfo['Make'], $carInfo['type'], $carId, 10);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
    <link rel="stylesheet" href="carousel.style.css">

    <style>

    </style>
</head>

<body>

    <div class="container mt-5 mb-5" style="width:100%">
        <h1 class="mb-4 text-center">Car Details</h1>
        <button class="btn btn-secondary" style="background-color: black; color: white; margin-bottom:10px; width:100px" onclick="history.back()">Back</button>


        <!-- Car Basic Info -->
        <div class="card mb-4">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="../adminPanel/assets/img/allCars/<?php echo $carImages[0]['ImageName']; ?>" alt="<?php echo $carInfo['Make'] . ' ' . $carInfo['Model']; ?>" class="img-fluid rounded-start h-100 w-100 car-image">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h2 class="card-title" style="color:white"><?php echo $carInfo['Year'] . ' ' . $carInfo['Make'] . ' ' . $carInfo['Model']; ?></h2>
                        <p class="card-text lead"><?php echo $carInfo['Description']; ?></p>
                        <p class="card-text"><strong>Price:</strong> $<?php echo number_format($carInfo['Price'], 2); ?></p>
                        <p class="card-text"><strong>Year:</strong> <?php echo $carInfo['Year']; ?> | <strong>Make:</strong> <?php echo $carInfo['Make']; ?> | <strong>Model:</strong> <?php echo $carInfo['Model']; ?></p>
                        <p class="card-text"><strong>Type:</strong> <?php echo $carInfo['type']; ?> | <strong>Gear:</strong> <?php echo $carInfo['gear']; ?></p>
                        <p class="card-text"> <strong>Condition:</strong> <?php echo $carInfo['isNew'] ? 'New' : 'Used'; ?></p>

                        <!-- Color Selection -->
                        <div class="mb-3">
                            <strong style="margin-bottom:10px; color:white">Select Color:</strong><br>
                            <?php foreach ($colors as $color) : ?>
                                <label class="color-box <?php echo isset($addedColors[$color]) ? 'disabled' : ''; ?>" style="background-color: <?php echo strtolower($color); ?>;">
                                    <input type="radio" name="color" value="<?php echo $color; ?>" <?php echo isset($addedColors[$color]) ? 'disabled' : ''; ?>>
                                </label>
                            <?php endforeach; ?>
                        </div>

                        <div class="button-group" style="display: flex; gap: 10px;">
                            <button id="add-to-inventory" data-car-id="<?php echo $carId; ?>" class="btn btn-secondary mt-3 icon-btn <?php echo $isInInventory ? 'added' : ''; ?>">
                                <i class="bi bi-box"></i> Add to Inventory
                            </button>

                            <button class="btn btn-secondary mt-3 icon-btn wishlist-btn" data-cusID="<?php echo $_SESSION['user_id']; ?>" data-id="<?php echo $carInfo['CarID']; ?>" data-in-wishlist="<?php echo in_array($carInfo['CarID'], $_SESSION['user_wishlist'] ?? []) ? 'true' : 'false'; ?>">
                                <i class="bi bi-heart"></i> Add to Wishlist
                            </button>

                            <button class="btn btn-primary mt-3 icon-btn" onclick="window.location.href='checkout.php'">
                                <i class="bi bi-credit-card"></i> Proceed to Checkout
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs for Images, Features, and Warranty -->
        <ul class="nav nav-tabs mb-0" id="carDetailsTabs" role="tablist">

            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="gallery-tab" data-bs-toggle="tab" data-bs-target="#gallery" type="button" role="tab">Gallery</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="features-tab" data-bs-toggle="tab" data-bs-target="#features" type="button" role="tab">Features</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="warranty-tab" data-bs-toggle="tab" data-bs-target="#warranty" type="button" role="tab">Warranty</button>
            </li>

        </ul>

        <div class="tab-content" id="carDetailsTabsContent">
            <!-- Car Images -->
            <div class="tab-pane fade show active" id="gallery" role="tabpanel">
                <div class="row">
                    <?php foreach ($carImages as $image) : ?>
                        <div class="col-md-4 mb-3">
                            <img src="../adminPanel/assets/img/allCars/<?php echo $image['ImageName']; ?>" alt="<?php echo $carInfo['Make'] . ' ' . $carInfo['Model']; ?>" class="img-fluid rounded car-image1">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Car Features -->
            <!-- Car Features -->
            <div class="tab-pane fade" id="features" role="tabpanel">
                <ul class="list-group">
                    <?php
                    $featureIcons = [
                        'Transmission' => 'bi-gear-fill',
                        'FuelEconomy' => 'bi-speedometer2', // Updated icon for Fuel Economy
                        'Engine' => 'bi-cpu', // Updated icon for Engine
                        'DriveType' => 'bi-gear', // Alternative icon for Drive Type
                        'PassengerCapacity' => 'bi-person-fill',
                        'DiscountPrice' => 'bi-tag-fill'
                    ];
                    foreach ($carFeatures[0] as $key => $value) :
                        if ($key !== 'FeatureID' && $key !== 'CarID') :
                    ?>
                            <li class="list-group-item"><i class="bi <?php echo $featureIcons[$key]; ?>"></i> <?php echo $key . ': ' . $value; ?></li>
                    <?php
                        endif;
                    endforeach;
                    ?>
                </ul>
            </div>

            <!-- Car Warranty -->
            <div class="tab-pane fade" id="warranty" role="tabpanel">
                <ul class="list-group">
                    <?php foreach ($carWarranty[0] as $key => $value) : ?>
                        <?php if ($key !== 'WarrantyID' && $key !== 'CarID') : ?>
                            <li class="list-group-item"><i class="bi bi-check-circle-fill"></i> <?php echo $key . ': ' . $value; ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <section class="game-section">
            <h1 class="line-title">Related Cars</h1>


            <div class="owl-carousel custom-carousel owl-theme">
                <?php foreach ($relatedCars as $index => $caro) :
                    $currentCarImages = $car->getCarImages($caro['CarID']);

                ?>
                    <div class="item<?php echo $index === 0 ? ' active' : ''; ?>" style="background-image: url('../adminPanel/assets/img/allCars/<?php echo $currentCarImages[0]['ImageName']; ?>');">
                        <div class="item-desc">
                            <h3><?php echo htmlspecialchars($caro['Make'] . ' ' . $caro['Model']); ?></h3>
                            <p><?php echo htmlspecialchars($caro['Description']); ?></p>
                            <p><button class="btn btn-secondary" style="background-color: blue; color: white; margin-bottom:10px; width:100px; border:none" onclick="window.location.href='car.php?id=<?php echo $caro['CarID'] ?>'">View Car</button></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </section>
    </div>





    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(".custom-carousel").owlCarousel({
            autoWidth: true,
            loop: true
        });
        $(document).ready(function() {
            $(".custom-carousel .item").click(function() {
                $(".custom-carousel .item").not($(this)).removeClass("active");
                $(this).toggleClass("active");
            });
        });
        $(document).ready(function() {
            // Function to update button state
            function updateButtonState(button, inWishlist) {
                if (inWishlist) {
                    button.removeClass('btn-secondary').addClass('btn-success');
                    button.find('i').removeClass('bi-heart').addClass('bi-heart-fill');
                    button.html('<i class="bi bi-heart-fill"></i> Remove from Wishlist');
                } else {
                    button.removeClass('btn-success').addClass('btn-secondary');
                    button.find('i').removeClass('bi-heart-fill').addClass('bi-heart');
                    button.html('<i class="bi bi-heart"></i> Add to Wishlist');
                }
            }

            // Initialize wishlist state
            $('.wishlist-btn').each(function() {
                var button = $(this);
                var inWishlist = button.data('in-wishlist') === true;
                updateButtonState(button, inWishlist);
            });

            // Wishlist button click handler
            $('.wishlist-btn').click(function() {
                var button = $(this);
                var carID = button.data('id');
                var cusID = button.data('cusID')

                $.ajax({
                    url: 'actions/add_to_wishlist.php',
                    method: 'POST',
                    data: {
                        carID: carID,
                        cusID: cusID
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            var inWishlist = response.action === 'added';
                            updateButtonState(button, inWishlist);
                            button.data('in-wishlist', inWishlist);

                            Swal.fire({
                                icon: inWishlist ? 'success' : 'info',
                                title: inWishlist ? 'Added to Wishlist' : 'Removed from Wishlist',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                        } else if (response.status === 'error' && response.message === 'User not logged in') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Not Logged In',
                                text: 'You need to log in to add items to your wishlist.',
                                showCancelButton: true,
                                confirmButtonText: 'Log In',
                                cancelButtonText: 'Cancel'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'SignINUP/signinup.php';
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'An error occurred. Please try again.'
                        });
                    }
                });
            });

        });
        $(document).ready(function() {
            // Handle color box clicks
            $('.color-box').click(function() {
                if ($(this).hasClass('disabled')) {
                    return;
                }

                // Remove selected state from all color boxes
                $('.color-box').removeClass('selected');

                // Add selected state to the clicked color box
                $(this).addClass('selected');

                // Check if the color is disabled
                let selectedColor = $(this).find('input').val();
                $('input[name="color"][value="' + selectedColor + '"]').prop('checked', true);
            });

            $('#add-to-inventory').click(function() {
                var carId = $(this).data('car-id');
                var selectedColor = $('input[name="color"]:checked').val();

                if (!selectedColor) {
                    Swal.fire('Error', 'Please select a color.', 'error');
                    return;
                }

                $.ajax({
                    url: 'actions/add_to_inventory.php',
                    type: 'POST',
                    data: {
                        carId: carId,
                        color: selectedColor
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Success', 'Car added to inventory.', 'success').then(function() {
                                // Disable the color box after successful addition
                                $('.color-box.selected').addClass('disabled');
                                $('#add-to-inventory').addClass('added').text('Added to Inventory');
                            });
                        } else if (response.message === 'User not logged in') {
                            Swal.fire({
                                title: 'Not Logged In',
                                text: "You need to log in to add items to the inventory. Do you want to go to the login/signup page?",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Yes, take me there',
                                cancelButtonText: 'No, stay here'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'Signinup/signinup.php'; // Adjust the URL as needed
                                }
                            });
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'There was a problem with your request.', 'error');
                    }
                });
            });


            // Initialize the UI based on already added colors
            <?php if ($isInInventory) : ?>
                $('.color-box').each(function() {
                    var color = $(this).find('input').val();
                    if (<?php echo json_encode($addedColors); ?>[color]) {
                        $(this).addClass('disabled');
                    }
                });
            <?php endif; ?>
        });
    </script>


</body>

</html>