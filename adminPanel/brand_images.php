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
<?php require_once "class/brandimg.class.php";
$brand = new Brand();
$brando = $brand->getAllBrands();
?>

<body class="sb-nav-fixed">
    <?php require_once('components/nav.php'); ?>
    <?php require_once('components/sidebar.php'); ?>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- for images enctype -->
                    <form id="addForm" method="POST" enctype="multipart/form-data">

                        <div class="input-group mb-3">
                            <div class="input-group-prepend ml-5">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Brand Image</span>
                            </div>
                            <input type="file" class="form-control input-control submit" placeholder="Images" aria-label="Images" name="images[]" aria-describedby="basic-addon3" multiple>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary submitButton" value="upload-image">Submit</button>

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
                    <li class="breadcrumb-item active">Brands</li>
                </ol>
                <div align="left" class="mb-3">
                    <button type="button" class="btn btn-primary close" data-toggle="modal" data-target="#addModal">Add a Brand</button>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Brands
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($brando as $brnd) { ?>
                                    <tr>

                                        <td><?php echo $brnd['id'] ?> </td>
                                        <td><img src="assets/img/brand/<?php echo $brnd['image_path'] ?>" height="100px" width="100px"></td>
                                        <td>
                                            <div style="display:flex; gap:5px">
                                                <button class="btn btn-danger deleteButton" id="<?php echo $brnd['id'] ?>">
                                                    <i class="fa fa-trash text-white"></i>
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
<script> $(document).ready(function() {

$('#datatablesSimple').on('click', '.deleteButton', function(e) {
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
                    test_id: id
                },
                url: 'actions/delete_brand.php',
                success: function(response) {
                    if (response == 0) {
                        Swal.fire(
                            'Deleted!',
                            'Brand has been deleted.',
                            'success'
                        ).then((result) => {
                            window.location.href = "brand_images.php";
                        })

                    } else {
                        Swal.fire(
                            'Error!',
                            'Brand Deletion failed',
                            'error'
                        )
                    }


                }

            });

        }
    })
})
});
$(document).ready(function() {
        $('#addForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this); // Use 'this' to refer to the form

            $.ajax({
                url: "actions/add_brand.php",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                data: formData,
                success: function(response) {
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
                            window.location.href = 'brand_images.php'; // Redirect after success
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
</script>
</html>