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
<?php require_once('class/testimonials.class.php'); ?>
<?php
$test = new Testimonials();
$allTestimonials = $test->getAllTest();
?>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Testimonial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!-- for images enctype -->
                <form id="addForm" method="POST" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1" style="width: 150px;">Client Name</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Client Name" aria-label="name" name="name" id="name" aria-describedby="basic-addon1" size="20">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1" style="width: 150px;">Location</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Location" aria-label="location" name="location" id="location" aria-describedby="basic-addon1" size="20">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1" style="width: 150px;">Testimonial Text</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Testimonial Text" aria-label="text" name="text" id="text" aria-describedby="basic-addon1" size="20">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend ml-5">
                            <span class="input-group-text" id="basic-addon1" style="width: 150px;">Client Image</span>
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

<body class="sb-nav-fixed">
    <?php require_once('components/nav.php'); ?>
    <?php require_once('components/sidebar.php'); ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Testimonials</li>
                </ol>
                <div align="Right" class="mb-3">
                    <button type="button" class="btn btn-primary close" data-toggle="modal" data-target="#addModal">Add a Testimonials</button>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Testimonials
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Client Name</th>
                                    <th>Location</th>
                                    <th>Comment</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($allTestimonials as $testi) { ?>
                                    <tr>
                                        <td><?php echo $testi['client_name'] ?></td>
                                        <td><?php echo $testi['location'] ?></td>
                                        <td><?php echo $testi['testimonial_text'] ?></td>
                                        <td><img src="assets/img/clients/<?php echo $testi['client_image'] ?>" height="200px" width="200px" style="border-radius:50%"></td>
                                        <td>
                                            <div style="display:flex; gap:5px">
                                                <button class="btn btn-danger deleteButton" id="<?php echo $testi['id'] ?>" >
                                                    <i class="fa fa-trash text-white"></i>
                                                </button>
                                                <button class="btn btn-primary edit" id="<?php echo $testi['id'] ?>" onclick="window.location.href='edit_test_form.php?id=<?php echo $testi['id'] ?>'">
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
                        url: 'actions/delete_test.php',
                        success: function(response) {
                            if (response == 0) {
                                Swal.fire(
                                    'Deleted!',
                                    'Testimonial has been deleted.',
                                    'success'
                                ).then((result) => {
                                    window.location.href = "testimonials.php";
                                })

                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Testimonial Deletion failed',
                                    'error'
                                )
                            }


                        }

                    });

                }
            })
        })
    })
    $(document).ready(function() {
        $('#addForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this); // Use 'this' to refer to the form

            $.ajax({
                url: "actions/add_test.php",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Ensure response is parsed as JSON if needed
                    if (typeof response === 'string') {
                        try {
                            response = JSON.parse(response);
                        } catch (e) {
                            console.error('Failed to parse response:', e);
                            Swal.fire({
                                icon: 'error',
                                title: 'Invalid response format',
                                text: 'Unexpected response from the server',
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-primary app_style'
                                }
                            });
                            return;
                        }
                    }

                    console.log('Response:', response); // Debugging

                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: true,
                            customClass: {
                                confirmButton: 'button btn btn-primary app_style'
                            }
                        }).then(function() {
                            window.location.href = 'testimonials.php';
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
                },
                error: function(xhr, status, error) {
                    console.error('Error Response:', xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'An error occurred',
                        text: 'Please try again later',
                        showConfirmButton: true,
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