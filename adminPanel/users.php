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
<?php require_once "class/users.class.php";
$user = new Users();
$allUsers = $user->getAllUsers();
?>

<body class="sb-nav-fixed">
    <?php require_once('components/nav.php'); ?>
    <?php require_once('components/sidebar.php'); ?>


    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
                <button id="addAdminBtn" class="btn btn-primary mb-3">Add New Admin</button>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        USERS
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>User Type</th>
                                    <th>Email</th>
                                    <th>Date Signed up</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <style>
                                .user-type.superadmin {
                                    color: gold !important;
                                    font-weight: bold !important;
                                }

                                .user-type.other {
                                    font-weight: bold !important;
                                }
                            </style>
                            <!-- class="user-type echo ($user['usertype'] == 'superadmin') ? 'superadmin' : 'other'; ?>" -->
                            <tbody>
                                <?php foreach ($allUsers as $index => $user) { ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user['Name']); ?></td>
                                        <td >
                                          <?php echo htmlspecialchars($user['usertype']); ?>
                                        </td>
                                        <td><a><?php echo htmlspecialchars($user['Email']); ?></a></td>
                                        <td><?php echo htmlspecialchars($user['DateSignedUp']); ?></td>
                                        <td>
                                            <div style="display:flex; gap:5px">
                                                <?php if ($user['usertype'] == 'superadmin') { ?>
                                                    <!-- Superadmins can only be edited -->
                                                    <button class="btn btn-primary editButton" id="<?php echo ($user['CustomerID']); ?>">
                                                        <i class="fa-solid fa-pen-to-square text-white"></i>
                                                    </button>
                                                <?php } elseif ($user['usertype'] == 'admin') { ?>
                                                    <!-- Admins can be deleted or edited -->
                                                    <button class="btn btn-danger deleteButton" id="<?php echo ($user['CustomerID']); ?>">
                                                        <i class="fa fa-trash text-white"></i>
                                                    </button>
                                                    <button class="btn btn-primary editButton" id="<?php echo ($user['CustomerID']); ?>">
                                                        <i class="fa-solid fa-pen-to-square text-white"></i>
                                                    </button>
                                                <?php } elseif ($user['usertype'] == 'customer') { ?>
                                                    <!-- Customers can only be deleted -->
                                                    <button class="btn btn-danger deleteButton" id="<?php echo ($user['CustomerID']); ?>">
                                                        <i class="fa fa-trash text-white"></i>
                                                    </button>
                                                <?php } ?>
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
    <script>
        $(document).ready(function() {
            // Edit button click handler
            $('.editButton').on('click', function() {
                var userId = $(this).attr('id');
                var userType = $(this).closest('tr').find('.user-type').text().trim();
                editUser(userId, userType);
            });

            // Delete button click handler
            $('.deleteButton').on('click', function() {
                var userId = $(this).attr('id');
                deleteUser(userId);
            });
        });

        function editUser(userId, userType) {
            // Fetch user details
            $.ajax({
                url: 'actions/get_user_details.php',
                method: 'POST',
                data: {
                    userId: userId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        showEditModal(response.user, userType);
                    } else {
                        Swal.fire('Error', 'Failed to fetch user details', 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'An error occurred while fetching user details', 'error');
                }
            });
        }

        function showEditModal(user, userType) {
            let html = `
        <form id="editUserForm">
            <input type="hidden" name="userId" value="${user.CustomerID}">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="${user.Name}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="${user.Email}" required ${userType === 'superadmin' ? 'readonly' : ''}>
            </div>
            <div class="mb-3">
                <label for="oldPassword" class="form-label">Old Password (leave blank if not changing)</label>
                <input type="password" class="form-control" id="oldPassword" name="oldPassword">
            </div>
            <div class="mb-3">
                <label for="newPassword" class="form-label">New Password (leave blank if not changing)</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword">
            </div>
    `;



            html += `</form>`;

            Swal.fire({
                title: 'Edit User',
                html: html,
                showCancelButton: true,
                confirmButtonText: 'Save Changes',
                cancelButtonText: 'Cancel',
                preConfirm: () => {
                    return $('#editUserForm').serialize();
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'actions/update_user.php',
                        method: 'POST',
                        data: result.value,
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Success', 'User updated successfully', 'success').then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error', response.message || 'Failed to update user', 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'An error occurred while updating the user', 'error');
                        }
                    });
                }
            });
        }

        function deleteUser(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'actions/delete_user.php',
                        method: 'POST',
                        data: {
                            userId: userId
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Deleted!', 'User has been deleted.', 'success').then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error', response.message || 'Failed to delete user', 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'An error occurred while deleting the user', 'error');
                        }
                    });
                }
            });
        }
        $(document).ready(function() {
                    // Add new admin button click
                    $('#addAdminBtn').on('click', function() {
                        showAdminModal();
                    });

                    // Edit admin button click (assuming each row has an edit button with class 'editAdminBtn')
                    $(document).on('click', '.editAdminBtn', function() {
                        var userId = $(this).data('userid');
                        showAdminModal(userId);
                    });

                    function showAdminModal(userId = null) {
                        var title = userId ? 'Edit Admin User' : 'Add New Admin';
                        var submitText = userId ? 'Update' : 'Add';

                        Swal.fire({
                            title: title,
                            html: '<input id="name" class="swal2-input" placeholder="Name">' +
                                '<input id="email" class="swal2-input" placeholder="Email">' +
                                '<input id="password" class="swal2-input" type="password" placeholder="Password">' +
                                (userId ? '<input id="userId" type="hidden" value="' + userId + '">' : ''),
                            focusConfirm: false,
                            showCancelButton: true,
                            confirmButtonText: submitText,
                            preConfirm: () => {
                                return {
                                    name: $('#name').val(),
                                    email: $('#email').val(),
                                    password: $('#password').val(),
                                    userId: userId
                                }
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                saveAdminUser(result.value);
                            }
                        });

                        // If editing, fetch and populate user data
                        if (userId) {
                            $.ajax({
                                url: 'actions/get_admin_user.php',
                                method: 'GET',
                                data: {
                                    userId: userId
                                },
                                dataType: 'json',
                                success: function(response) {
                                    $('#name').val(response.name);
                                    $('#email').val(response.email);
                                },
                                error: function() {
                                    Swal.fire('Error', 'Failed to fetch user data', 'error');
                                }
                            });
                        }
                    }

                    function saveAdminUser(userData) {
                        $.ajax({
                            url: 'actions/save_admin_user.php',
                            method: 'POST',
                            data: userData,
                            dataType: 'json',
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: response.message,
                                        confirmButtonText: 'OK',
                                        confirmButtonColor: '#3085d6',
                                        timer: 2500,
                                        timerProgressBar: true
                                    }).then(() => {
                                        // Reload table or update row
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: response.message,
                                        confirmButtonText: 'OK',
                                        confirmButtonColor: '#d33'
                                    });
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'An error occurred while saving the user',
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: '#d33'
                                });
                            }
                        });
                    }
        });
    </script>
</body>

</html>