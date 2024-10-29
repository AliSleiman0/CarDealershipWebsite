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
    <?php require_once "class/index.class.php";
    $slider = new sliders();
    $slider = $slider->getAllSliders();
    ?>
    <?php require_once('components/nav.php'); ?>
    <?php require_once('components/sidebar.php'); ?>

    <!-- Update Modal -->
    <div class="modal" id="editModal">
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
                        <div class="form-group mb-3">
                            <label for="banner">Banner:</label>
                            <input type="file" class="form-control" id="banner" name="banner">
                        </div>
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
                    <li class="breadcrumb-item active">Sliders</li>
                </ol>
                <div class="row">

                </div>
                <div class="row">
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Categories
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td><?php echo $slider[0]['title'] ?></td>
                                    <td><img src="assets/img/welcome-hero/<?php echo $slider[0]['banner'] ?>" height="auto" width="200px"></td>
                                    <td><?php echo $slider[0]['description'] ?></td>
                                    <td>
                                        <button class="btn btn-primary edit" onclick="window.location.href='edit_sliders_form.php?id=<?php echo $slider[0]['id'] ?>'">
                                            <i class="fa-solid fa-pen-to-square text-white"></i>
                                        </button>
                                    </td>
                                </tr>


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

</html>