<?php require("class/cars.class.php");
$car = new Car();
$id = $_GET['id'];
$allCars = $car->getAllCars();
$caro = $car->getCar($id);
$allimages = $car->getAllImagesByID($id);
// var_dump($allimages);exit;

?>
<?php require('components/header.php') ?>
<?php require('components/nav.php') ?>
<?php require('components/sidebar.php') ?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</li></a>
                <li class="breadcrumb-item active">Products</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="modal-body">
                        <form id="updateForm">
                            <input type="text" class="form-control" aria-label="id" name="id" id="id" aria-describedby="basic-addon1" size="20" value="<?php echo $id; ?>" hidden>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1" style="width: 150px;">Make</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Make" aria-label="make" name="make" id="make" aria-describedby="basic-addon1" size="20" value="<?php echo $caro[0]['Make']; ?>">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1" style="width: 150px;">Model</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Model" aria-label="model" name="model" id="model" aria-describedby="basic-addon1" size="20" value="<?php echo $caro[0]['Model']; ?>">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1" style="width: 150px;">Year</span>
                                </div>
                                <input type="number" min="2000" class="form-control" placeholder="Year" aria-label="year" name="year" id="year" aria-describedby="basic-addon1" size="20" value="<?php echo $caro[0]['Year']; ?>">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1" style="width: 150px;">Description</span>
                                </div>
                                <input type="textarea" class="form-control" placeholder="Description" aria-label="description" name="description" id="description" aria-describedby="basic-addon1" size="20" value="<?php echo $caro[0]['Description']; ?>">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1" style="width: 150px;">Quantity</span>
                                </div>
                                <input type="number" min="1" class="form-control" placeholder="Quantity" aria-label="quantity" name="quantity" id="quantity" aria-describedby="basic-addon1" size="20" value="<?php echo $caro[0]['quantity']; ?>">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1" style="width: 150px;">Price</span>
                                </div>
                                <input type="number" min="500" class="form-control" placeholder="Price" aria-label="price" name="price" id="price" aria-describedby="basic-addon1" size="20" value="<?php echo $caro[0]['Price']; ?>">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1" style="width: 150px;">Type</span>
                                </div>
                                <input type="text" min="500" class="form-control" placeholder="Price" aria-label="price" name="type" id="type" aria-describedby="basic-addon1" size="20" value="<?php echo $caro[0]['type']; ?>">
                            </div>

                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1" style="width: 150px;">Type</span>
                                </div>
                                <select id="gear" name="gear" required style="width:68%">
                                    <option value="">Gear</option>
                                    <option value="Automatic" <?php if ($caro[0]['gear'] == 'Automatic') echo 'selected'; ?>>Automatic</option>
                                    <option value="Manual" <?php if ($caro[0]['gear'] == 'Manual') echo 'selected'; ?>>Manual</option>

                                </select>
                            </div>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend ml-5">
                                    <span class="input-group-text" id="basic-addon1" style="width: 150px;">Images:</span>
                                </div>
                                <input type="file" class="form-control input-control" placeholder="Images" aria-label="Images" name="images[]" aria-describedby="basic-addon3" multiple>

                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1" style="width: 150px;">Condition</span>
                                </div>
                                <select id="condition" name="condition" required style="width:87%">
                                    <option value="1" <?php if ($caro[0]['isNew'] == 1) echo 'selected'; ?>>New</option>
                                    <option value="0" <?php if ($caro[0]['isNew'] == 0) echo 'selected'; ?>>Used</option>
                                </select>
                            </div>


                    </div>
                </div>
            </div>



        </div>
        <div class="row">
            <?php foreach ($allimages as $k => $row) { ?>
                <div class="col-sm-4 text-center my-3 " style="display:flex">

                    <img src="assets/img/allCars/<?php echo $row['ImageName'] ?>" class="rounded" height="200px" width="200px" style="position:relative;">

                    <a class="text-white delete_img d-flex align-items-center justify-content-center rounded-circle bg-danger delete_img" id="<?php echo $row['ImageID'] ?>" style="position:absolute; margin-left:185px; width: 18px; height: 20px; text-decoration: none;">
                        <i class="fa-solid fa-xmark" style="font-size: 10px;"></i>
                    </a>

                </div>
            <?php } ?>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" value="submit"> Submit</button>
        </div>
        </form>
</div>
</div>
</div>
</div>

</div>
</div>

</main>
<?php require('components/footer.php') ?>

</body>

</html>


<?php require('components/script.php') ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

<script>
    $(document).ready(function() {
        $('.delete_img').on('click', function(e) {
            var id = $(this).attr('id');
            alert(id);
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
                            image_id: id
                        },
                        url: 'actions/delete_image.php',
                        success: function(response) {
                            if (response == 0) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                ).then((result) => {
                                    window.location.href = "edit_form.php?id=<?php echo $id ?>";
                                })

                            } else {
                                Swal.fire('You can not deleted this category')
                            }


                        }

                    });

                }
            })
        })
    })

    // This code uses the FormData object directly to send the form data via AJAX. Also, note that I've set contentType: false and processData: false to ensure that jQuery doesn't process the data or set the content type, as it would with a standard form submission.

    // Make sure your server-side script ("actions/add_products.php") handles the FormData correctly, using $_POST for form fields and $_FILES for file uploads.

    $('#updateForm').submit(function(e) {
        e.preventDefault();

        // Create FormData object
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "actions/update_cars.php",
            type: 'POST',
            dataType: 'json',
            data: formData,
            contentType: false, // Set content type to false
            processData: false, // Prevent jQuery from processing the data
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: true,
                        customClass: {
                            confirmButton: 'button btn btn-primary app_style'
                        }
                    }).then(function() {
                        window.location.href = 'cars.php';
                    });
                } else if (response.status === 'error') {
                    Swal.fire({
                        icon: 'warning',
                        title: response.message,
                        showConfirmButton: true,
                        customClass: {
                            confirmButton: 'button btn btn-primary app_style'
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    });
                }
            }
        });
    });
</script>

<!-- $(document).ready(function() {
        var caroId;
        // Open the modal and set the category name

        $('#datatablesSimple').on('click', '.edit', function(e) {
            caroId = $(this).attr('id');
            var make = $(this).data('make');
            var model = $(this).data('model');
            var year = $(this).data('year');
            var description = $(this).data('description');

            var quantity = $(this).data('quantity');
            var price = $(this).data('price');
            console.log('hi');
            var condition = $(this).data('condition');
            var customizable = $(this).data('customizable');

            var trueStringCondition = (condition == 1) ? 'true' : 'false';
            var trueStringCustomizable = (customizable == 1) ? 'true' : 'false';

            console.log(trueStringCondition);
            console.log(trueStringCustomizable);

            // Set the category ID and name in the modal

            $('#id').val(caroId);
            $('#make').val(make);
            $('#model').val(model);
            $('#year').val(year);
            $('#description').val(description);

            $('#quantity').val(quantity);
            $('#price').val(price);

            $('#condition').val(trueStringCondition);
            $('#customizable').val(trueStringCustomizable);


        }); -->
<!-- // Perform the update action when the update button is clicked
        $('#updateCategoryForm').submit(function(e) { //confirmUpdateCategoryButton
            e.preventDefault();
            console.log('hi');
            // var form = $(this);
            var form = new FormData(this);
            $.ajax({
                url: 'actions/update_cars.php',
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: form, //.serialize()
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: true,
                            customClass: {
                                confirmButton: 'button btn btn-primary app_style'
                            }
                        }).then(function() {
                            window.location.href = 'cars.php';
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: response.message,
                            showConfirmButton: true,
                            customClass: {
                                confirmButton: 'button btn btn-primary app_style'
                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'An error occurred while updating the car.',
                        showConfirmButton: true,
                        customClass: {
                            confirmButton: 'button btn btn-primary app_style'
                        }
                    });
                }
            });

        }); -->


<!-- Update Category Modal
    <div class="modal fade" id="updateCategoryModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateCategoryForm">
                        <input type="text" class="form-control" placeholder="Make" aria-label="make" name="id" id="id" aria-describedby="basic-addon1" size="20" hidden>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Make</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Make" aria-label="make" name="make" id="make" aria-describedby="basic-addon1" size="20" required ">
                        </div>
                        <div class=" input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Model </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Model" aria-label="model" name="model" id="model" aria-describedby="basic-addon1" size="20" required ">
                        </div>
                        <div class=" input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Year</span>
                            </div>
                            <input type="number" min="2000" class="form-control" placeholder="Year" aria-label="year" name="year" id="year" aria-describedby="basic-addon1" size="20" required ">
                        </div>
                        <div class=" input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Description</span>
                            </div>
                            <input type="textarea" class="form-control" placeholder="Description" aria-label="description" name="description" id="description" aria-describedby="basic-addon1" size="20" required ">

                        </div>
                
                        <div class=" input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Quantity</span>
                            </div>
                            <input type="number" min="1" class="form-control" placeholder="Quantity" aria-label="quantity" name="quantity" id="quantity" aria-describedby="basic-addon1" size="20" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Price</span>
                            </div>
                            <input type="number" min="500" class="form-control" placeholder="Price" aria-label="price" name="price" id="price" aria-describedby="basic-addon1" size="20" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Condition</span>
                            </div>
                            <select id="condition" name="condition" required style="width:68%">

                                <option value="true">New</option>
                                <option value="false">Used</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Customizable?</span>
                            </div>
                            <select id="customizable" name="customizable" required style="width:68%">

                                <option value="true">Customizable</option>
                                <option value="false">Not Customizable</option>
                            </select>

                        </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="confirmUpdateCategoryButton">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div> -->