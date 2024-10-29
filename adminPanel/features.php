<?php
// check_login.php

session_start();

// Define the page that requires login
$login_page = '../clientSide/SignINUP/signinup.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: $login_page");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('components/header.php'); ?>

<body class="sb-nav-fixed">
    <?php require_once('components/nav.php'); ?>
    <?php require_once('components/sidebar.php'); ?>
    <?php require_once('class/cars.class.php');
    $car = new Car();
    $features = $car->getFeatures();
    ?>
    <!-- Modal for Car Features -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFeatureModalLabel">Edit Car Feature</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editFeatureForm">
                        <input type="hidden" id="featureId" name="featureId">
                        <div class="form-group">
                            <label for="transmission">Transmission</label>
                            <input type="text" class="form-control" id="transmission" name="transmission">
                        </div>
                        <div class="form-group">
                            <label for="fuelEconomy">Fuel Economy</label>
                            <input type="text" class="form-control" id="fuelEconomy" name="fuelEconomy">
                        </div>
                        <div class="form-group">
                            <label for="engine">Engine</label>
                            <input type="text" class="form-control" id="engine" name="engine">
                        </div>
                        <div class="form-group">
                            <label for="driveType">Drive Type</label>
                            <input type="text" class="form-control" id="driveType" name="driveType">
                        </div>
                        <div class="form-group">
                            <label for="passengerCapacity">Passenger Capacity</label>
                            <input type="number" class="form-control" id="passengerCapacity" name="passengerCapacity">
                        </div>
                        <div class="form-group">
                            <label for="discountPrice">Discount Price</label>
                            <input type="number" step="0.01" class="form-control" id="discountPrice" name="discountPrice">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="saveFeatureChanges">Save changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Features</li>
                </ol>


                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Features
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Year</th>
                                    <th>Transmission</th>
                                    <th>Fuel Economy</th>
                                    <th>Engine</th>
                                    <th>Drive Type</th>
                                    <th>Passenger Capacity</th>
                                    <th>Discount Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($features as $feature) { ?>
                                    <?php

                                    // echo '<pre>';
                                    // print_r($feature);
                                    // echo '</pre>';
                                    ?>

                                    <tr>

                                        <td><?php echo $feature['Make']; ?></td>
                                        <td><?php echo $feature['Model']; ?></td>
                                        <td><?php echo $feature['Year']; ?></td>
                                        <td><?php echo $feature['Transmission']; ?></td>
                                        <td>
                                            <?php echo $feature['FuelEconomy']; ?>

                                        </td>
                                        <td><?php echo $feature['Engine']; ?></td>
                                        <td><?php echo $feature['DriveType']; ?></td>
                                        <td><?php echo $feature['PassengerCapacity']; ?></td>
                                        <td><?php echo $feature['DiscountPrice']; ?></td>

                                        <td>
                                            <div>

                                                <button class="btn btn-primary edit" data-toggle="modal" data-target="#editModal" id="<?php echo $feature['FeatureID']; ?>" data-fuel-economy="<?php echo $feature['FuelEconomy']; ?>" data-transmission="<?php echo $feature['Transmission']; ?>" data-engine="<?php echo $feature['Engine']; ?>" data-drive-type="<?php echo $feature['DriveType']; ?>" data-passenger-capacity="<?php echo $feature['PassengerCapacity']; ?>" data-discount-price="<?php echo $feature['DiscountPrice']; ?>">
                                                    <i class="fa-solid fa-pen-to-square text-white"></i>
                                                </button>


                                            </div>
                                        </td>





                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <?php require_once('components/footer.php'); ?>
    </div>
    </div>
    <?php require_once('components/script.php'); ?>
</body>
<script>
    $(document).ready(function() {
        // Car Features
        var featureId
        $('#datatablesSimple').on('click', '.edit', function(e) {
            featureId = $(this).attr('id');
            var fuelEconomy = $(this).data('fuel-economy');
            var transmission = $(this).data('transmission');
            var engine = $(this).data('engine');
            var driveType = $(this).data('drive-type');
            var passengerCapacity = $(this).data('passenger-capacity');
            var discountPrice = $(this).data('discount-price');

            // Populate modal hidden inputs
            $('#featureId').val(featureId);
            $('#fuelEconomy').val(fuelEconomy);
            $('#transmission').val(transmission);
            $('#engine').val(engine);
            $('#driveType').val(driveType);
            $('#passengerCapacity').val(passengerCapacity);
            $('#discountPrice').val(discountPrice);
        });
    });

    // AJAX function to submit feature form
    $('#editFeatureForm').submit(function(e) {
        e.preventDefault();
        var form = new FormData(this);
        $.ajax({
            url: 'actions/edit_feature.php',
            method: 'POST',
            contentType: false,
            processData: false,
            data: form,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire('Success', response.message, 'success').then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Failed to update feature', 'error');
            }
        });
    });
</script>

</html>