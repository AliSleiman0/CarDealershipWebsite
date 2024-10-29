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
<?php require_once "class/cars.class.php"; ?>
<?php require_once 'components/header.php'; ?>
<?php $car = new Car();
$allCars = $car->getAllCars();
?>

<class="sb-nav-fixed">
    <?php require_once('components/nav.php'); ?>
    <?php require_once('components/sidebar.php'); ?>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Cars</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- for images enctype -->
                    <form id="addForm" method="POST" enctype="multipart/form-data">
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Make</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Make" aria-label="make" name="make" aria-describedby="basic-addon1" size="20" required>
                        </div>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Model</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Model" aria-label="model" name="model" aria-describedby="basic-addon1" size="20" required>
                        </div>

                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Year</span>
                            </div>
                            <input type="number" min="2000" class="form-control" placeholder="Year" aria-label="year" name="year" aria-describedby="basic-addon1" size="20" required>
                        </div>

                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Car Price</span>
                            </div>
                            <input type="number" min="500" class="form-control" placeholder="Price" aria-label="price" name="price" aria-describedby="basic-addon1" size="20" required>
                        </div>

                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Description</span>
                            </div>
                            <input type="textarea" class="form-control" placeholder="Description" aria-label="description" name="description" aria-describedby="basic-addon1" size="20" required>
                        </div>



                        <div class="input-group mb-3">

                            <div class="input-group-prepend">

                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Car Condition</span>
                            </div>
                            <select id="ccondition" name="condition" required style="width:68%">
                                <option value="">Condition</option>
                                <option value="1">New</option>
                                <option value="0">Used</option>
                            </select>
                        </div>

                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Gear</span>
                            </div>
                            <select id="type" name="type" required style="width:68%">
                                <option value="">Type</option>
                                <option value="Cars and Minivans">Cars and Minivans</option>
                                <option value="Trucks">Trucks</option>
                                <option value="Crossovers and SUVs">Crossovers and SUVs</option>
                                <option value="Electrified">Electrified</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Type</span>
                            </div>
                            <select id="gear" name="gear" required style="width:68%">
                                <option value="">Gear</option>
                                <option value="Automatic">Automatic</option>
                                <option value="Manual">Manual</option>

                            </select>
                        </div>


                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Quantity Available</span>
                            </div>
                            <input type="number" min="1" class="form-control" placeholder="Quantity" aria-label="quantity" name="quantity" aria-describedby="basic-addon1" size="20" required>
                        </div>

                        <div class="input-group mb-3">

                            <div class="input-group-prepend ml-5">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Images:</span>
                            </div>
                            <input type="file" class="form-control input-control" placeholder="Images" aria-label="Images" name="images[]" aria-describedby="basic-addon3" multiple>

                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary submitButton" value="upload-image">Submit</button>

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
                    <li class="breadcrumb-item active"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Cars</li>
                </ol>
                <div align="right" class="mb-3">
                    <button type="button" class="btn btn-primary close" data-toggle="modal" data-target="#addModal">Add a Car</button>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Cars
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Car ID </th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Year</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Images</th>
                                    <th>Date Added</th>
                                    <th>Condition</th>
                                    <th>Type</th>
                                    <th>Gear</th>
                                    <th>Quantity</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($allCars as $caro) { ?>
                                    <tr>
                                        <td><?php echo $caro['CarID'] ?></td>
                                        <td><?php echo $caro['Make'] ?></td>
                                        <td><?php echo $caro['Model'] ?></td>
                                        <td><?php echo $caro['Year'] ?></td>
                                        <td><?php echo $caro['Price'] ?></td>
                                        <td><?php echo $caro['Description'] ?></td>
                                        <td>
                                            <?php
                                            $allimages = $car->getRandomImagesByID($caro['CarID']);
                                            if (!empty($allimages)) { ?>
                                                <div id="carousel_<?php echo $caro['CarID'] ?>" class="carousel slide" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        <?php $first = true;
                                                        foreach ($allimages as $index => $image) { ?>
                                                            <div class="carousel-item <?php echo $first ? 'active' : '' ?>">
                                                                <img height="100px" width="100px" src="assets/img/allCars/<?php echo $image['ImageName'] ?>" class="d-block w-100 " alt="<?php echo $caro['Make'] ?> - <?php echo $caro['Model']  ?> ">

                                                            </div>
                                                        <?php $first = false;
                                                        } ?>
                                                    </div>
                                                    <a class="carousel-control-prev" href="#carousel_<?php echo $caro['CarID'] ?>" role="button" data-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#carousel_<?php echo $caro['CarID'] ?>" role="button" data-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                            <?php } else { ?>
                                                <img src="assets/img/no-image-available.jpg" height="100px" width="100px" alt="No Image Available">
                                            <?php } ?>
                                        </td>
                                        <td><?php echo $caro['DateAdded'] ?></td>
                                        <td><?php echo $caro['isNew'] == 1 ? "New" : "Used" ?></td>
                                        <td><?php echo $caro['type']  ?></td>
                                        <td><?php echo $caro['gear']  ?></td>
                                        <td><?php echo $caro['quantity'] ?></td>
                                        <td>
                                            <div style="display:flex; gap:5px">
                                                <button class="btn btn-danger deleteButton" id="<?php echo $caro['CarID'] ?>">
                                                    <i class="fa fa-trash text-white"></i>
                                                </button>
                                                <button class="btn btn-primary edit" onclick="window.location.href='edit_form.php?id=<?php echo $caro['CarID'] ?>'">
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
        <?php require 'components/footer.php' ?>
    </div>
    </div>
    <?php require 'components/script.php' ?>
    </body>


</html>


<script>
    $(document).ready(function() {

        $('.submitButton').on('click', function(event) {
            event.preventDefault(); // Prevent default form submission
            var form = new FormData(document.querySelector("#addForm")); // Correctly get the form element
           
            $.ajax({
                url: "actions/add_car.php",
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: form,
                success: function(response) {
                    console.log('Success Response:', response); // Log the success response
                    alert('Success Response:', response); // Log the success response
                    Swal.fire({
                        icon: response.status === 'success' ? 'success' : (response.status === 'warning' ? 'warning' : 'error'),
                        title: response.message,
                        showConfirmButton: true,
                        timer: 3000,
                        timerProgressBar: true,
                        customClass: {
                            confirmButton: 'button btn btn-primary app_style'
                        }
                    }).then(function() {
                        if (response.status === 'success') {
                            window.location.href = 'cars.php'; // Redirect after success
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error Response:', xhr.responseText); // Log the error response
                    Swal.fire({
                        icon: 'error',
                        title: 'An error occurred',
                        text: 'Please try again later',
                        showConfirmButton: true,
                        timer: 3000,
                        timerProgressBar: true,
                        customClass: {
                            confirmButton: 'button btn btn-primary app_style'
                        }
                    });
                }
            });
        });
    });

    $(document).ready(function() {
        $('#datatablesSimple').on('click', '.deleteButton', function(e) {
            var id = $(this).attr("id");
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        cache: false,
                        type: 'POST',
                        data: {
                            carID: id
                        },
                        url: 'actions/delete_car.php',
                        success: function(response) {
                            console.log('Delete Success Response:', response); // Log the success response
                            if (response == 0) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                ).then((result) => {
                                    window.location.href = "cars.php";
                                });
                            } else {
                                Swal.fire('You cannot delete this category');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Delete Error Response:', xhr.responseText); // Log the error response
                            Swal.fire({
                                icon: 'error',
                                title: 'An error occurred',
                                text: 'Please try again later',
                                showConfirmButton: true,
                                timer: 3000,
                                timerProgressBar: true,
                                customClass: {
                                    confirmButton: 'button btn btn-primary app_style'
                                }
                            });
                        }
                    });
                }
            });
        });
    });
</script>