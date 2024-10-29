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
<?php 
require_once('components/header.php');
require_once "../adminPanel/class/index.class.php";
$slider = new sliders();
$socialLinks = $slider->getAllLinks();
$socialLinks = $socialLinks[0];
?>

<body class="sb-nav-fixed">
    <?php require_once('components/nav.php'); ?>
    <?php require_once('components/sidebar.php'); ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        LINKS
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Platform</th>
                                    <th>Link</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($socialLinks as $platform => $link): ?>
                                <tr>
                                    <td><?php echo ucfirst($platform); ?></td>
                                    <td><?php echo htmlspecialchars($link); ?></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm edit-link" data-platform="<?php echo $platform; ?>" data-link="<?php echo htmlspecialchars($link); ?>">Edit</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    $(document).ready(function() {
        $('.edit-link').on('click', function() {
            var platform = $(this).data('platform');
            var currentLink = $(this).data('link');

            Swal.fire({
                title: 'Edit ' + platform + ' Link',
                input: 'text',
                inputValue: currentLink,
                showCancelButton: true,
                confirmButtonText: 'Save',
                showLoaderOnConfirm: true,
                preConfirm: (newLink) => {
                    
                    return $.ajax({
                        url: 'actions/update_link.php',
                        method: 'POST',
                        data: {
                            platform: platform,
                            link: newLink
                        }
                    }).then(response => {
                        if (!response.success) {
                            throw new Error(response.message)
                        }
                        return response
                    }).catch(error => {
                        Swal.showValidationMessage(`Request failed: ${error}`)
                    })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Link updated successfully',
                        icon: 'success'
                    }).then(() => {
                        location.reload();
                    });
                }
            })
        });
    });
    </script>
</body>
</html>