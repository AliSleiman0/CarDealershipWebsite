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
    $waranties = $car->getWarranties();
    ?>
    <!-- Modal for Car Warranties -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editWarrantyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editWarrantyModalLabel">Edit Car Warranty</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editWarrantyForm" method="post">
                        <input type="hidden" id="warrantyId" name="warrantyId">
                        <div class="form-group">
                            <label for="bumperToBumper">Bumper To Bumper</label>
                            <input type="text" class="form-control" id="bumperToBumperMonthsMiles" name="bumperToBumper">
                        </div>
                        <div class="form-group">
                            <label for="majorComponents">Major Components</label>
                            <input type="text" class="form-control" id="majorComponentsMonths" name="majorComponents">
                        </div>
                        <div class="form-group">
                            <label for="includedMaintenance">Included Maintenance</label>
                            <input type="text" class="form-control" id="includedMaintenanceMonths" name="includedMaintenance">
                        </div>
                        <div class="form-group">
                            <label for="roadsideAssistance">Roadside Assistance</label>
                            <input type="text" class="form-control" id="roadsideAssistanceMonths" name="roadsideAssistance">
                        </div>
                        <div class="form-group">
                            <label for="corrosionPerforation">Corrosion Perforation</label>
                            <input type="text" class="form-control" id="corrosionPerforation" name="corrosionPerforation">
                        </div>
                        <div class="form-group">
                            <label for="accessories">Accessories</label>
                            <input type="text" class="form-control" id="accessoriesMonths" name="accessories">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="saveWarrantyChanges">Save changes</button>
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
                    <li class="breadcrumb-item active">Warranties</li>
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
                                    <th>Bumper To Bumper</th>
                                    <th>Major Components</th>
                                    <th>Included Maintenance</th>
                                    <th>Roadside Assistance</th>
                                    <th>Corrosion Perforation</th>
                                    <th>Accessories</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($waranties as $waranty) { ?>
                                    <?php

                                    // echo '<pre>';
                                    // print_r($waranty);
                                    // echo '</pre>';
                                    ?>
                                    <tr>

                                        <td><?php echo $waranty['Make']; ?></td>
                                        <td><?php echo $waranty['Model']; ?></td>
                                        <td><?php echo $waranty['Year']; ?></td>
                                        <td><?php echo $waranty['BumperToBumperMonthsMiles']; ?></td>
                                        <td><?php echo $waranty['MajorComponentsMonths']; ?></td>
                                        <td><?php echo $waranty['IncludedMaintenanceMonths']; ?></td>
                                        <td><?php echo $waranty['RoadsideAssistanceMonths']; ?></td>
                                        <td><?php echo $waranty['CorrosionPerforation']; ?></td>
                                        <td><?php echo $waranty['AccessoriesMonths']; ?></td>
                                        <td>
                                            <div>
                                                <button class="btn btn-primary edit" data-toggle="modal" data-target="#editModal" id="<?php echo $waranty['WarrantyID']; ?>" data-bumperToBumperMonthsMiles="<?php echo $waranty['BumperToBumperMonthsMiles']; ?>" data-majorComponentsMonths="<?php echo $waranty['MajorComponentsMonths']; ?>" data-includedMaintenanceMonths="<?php echo $waranty['IncludedMaintenanceMonths']; ?>" data-roadsideAssistanceMonths="<?php echo $waranty['RoadsideAssistanceMonths']; ?>" data-corrosionPerforation="<?php echo $waranty['CorrosionPerforation']; ?>" data-accessoriesMonths="<?php echo $waranty['AccessoriesMonths']; ?>">
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
            warrantyID = $(this).attr('id');


            var bumperToBumperMonthsMiles = $(this).data('bumpertobumpermonthsmiles');
            var majorComponentsMonths = $(this).data('majorcomponentsmonths');
            var includedMaintenanceMonths = $(this).data('includedmaintenancemonths');
            var roadsideAssistanceMonths = $(this).data('roadsideassistancemonths');
            var corrosionPerforation = $(this).data('corrosionperforation');
            var accessoriesMonths = $(this).data('accessoriesmonths');

            // Populate modal hidden inputs
            $('#warrantyId').val(warrantyID);
            $('#bumperToBumperMonthsMiles').val(bumperToBumperMonthsMiles);
            $('#majorComponentsMonths').val(majorComponentsMonths);
            $('#includedMaintenanceMonths').val(includedMaintenanceMonths);
            $('#roadsideAssistanceMonths').val(roadsideAssistanceMonths);
            $('#corrosionPerforation').val(corrosionPerforation);
            $('#accessoriesMonths').val(accessoriesMonths);
        });
    });
    // AJAX function to submit warranty form
    $('#editWarrantyForm').on('submit', function(e) {
        e.preventDefault();
        var form = new FormData(this);
        $.ajax({
            url: 'actions/edit_warranty.php',
            method: 'POST',
            data: form,
            contentType: false,
            processData: false,
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
                Swal.fire('Error', 'Failed to update warranty', 'error');
            }
        });
    });
</script>

</html>