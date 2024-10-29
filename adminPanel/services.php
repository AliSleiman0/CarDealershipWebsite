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
    <?php require_once "class/services.class.php";
    $service = new service();
    $allServices = $service->getAllServices();
    ?>
    <?php require_once('components/nav.php'); ?>
    <?php require_once('components/sidebar.php'); ?>

    <!-- Update Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Entry</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="editForm" method="post" action="edit_entry.php" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
<br>
                        <button type="submit" class="btn btn-primary" id="confirmEdit">Save Changes</button>
                    </form>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
                    <li class="breadcrumb-item active">Services</li>
                </ol>
                <div class="row">

                </div>
                <div class="row">
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Services
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($allServices as $servicebb) { ?>
                                    <tr>
                                        <td><?php echo $servicebb['title'] ?></td>
                                        <td><?php echo $servicebb['description'] ?></td>
                                        <td>
                                            <button class="btn btn-primary edit" data-toggle="modal" data-target="#editModal" id="<?php echo $servicebb['id'] ?>" data-title="<?php echo $servicebb['title'] ?>" data-description="<?php echo $servicebb['description'] ?>">
                                                <i class="fa-solid fa-pen-to-square text-white"></i>
                                            </button>
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
        var id;
        $('#datatablesSimple').on('click', '.edit', function(e) {
            id = e.target.id;
            var title = $(this).data('title');
            var description = $(this).data('description');
           

            $('#id').val(id);
            $('#title').val(title);
            $('#description').val(description);
        });
        $('#editForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this); // Use 'this' to refer to the form

            $.ajax({
                url: "actions/edit_servvice.php",
                type: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
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
                            window.location.href = 'services.php';
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