<?php
session_start();
require("../../adminPanel/class/DAL.class.php");
$dal = new DAL();



if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT usertype, PasswordHash FROM users WHERE email = ?";
    $params = array($email);
    $result = $dal->data($sql, $params);


    if ($result && count($result) > 0) {
        $storedPasswordHash = $result[0]['PasswordHash'];
        $user_type = $result[0]['usertype'];

        if (password_verify($password, $storedPasswordHash)) {
            // Execute the query
            $result = $dal->getdata("SELECT CustomerID FROM users WHERE Email = '$email';");
            $name = $dal->getdata("SELECT Name FROM users WHERE Email = '$email';");
            // Check if the result is not empty and extract the CustomerID
            if (!empty($result) && is_array($result)) {
                $id = $result[0]['CustomerID']; // Assuming getdata returns an array of associative arrays

                $_SESSION['user_id'] = (int)$id;
            } else {
                // Handle case where the query did not return a valid result
                $_SESSION['user_id'] = null;
            }
            $_SESSION['email'] = $email;
            $_SESSION['usertype'] = $user_type;
            $_SESSION['login'] = true;
            
            // Check if the user type is 'admin' or 'superadmin'
            $isAdminPanel = ($user_type === 'admin' || $user_type === 'superadmin');
            

            if ($isAdminPanel) {
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Successful ',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href='../../adminPanel/index.php';
                    });
                });
            </script>";
            } else {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Successful',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href='../index.php';
                        });
                    });
                </script>";
            }
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Password',
                        text: 'Please try again.'
                    }).then(() => {
                        window.location.href='signinup.php';
                    });
                });
            </script>";
        }
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Username',
                    text: 'Please try again.'
                }).then(() => {
                    window.location.href='signinup.php';
                });
            });
        </script>";
    }
}

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($password !== $password2) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Passwords do not match',
                    text: 'Please try again.'
                }).then(() => {
                    window.location.href='signinup.php';
                });
            });
        </script>";
    } else {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (Email, PasswordHash,Name) VALUES (?, ?, ?)";
        $params = [$email, $passwordHash, $name];


        try {
            $dal->data($sql, $params);
            $result = $dal->getdata("SELECT CustomerID FROM users WHERE Email = '$email'");
            $id = $result[0]['CustomerID']; 
            $_SESSION['user_id'] = (int)$id;
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
            $_SESSION['usertype'] = 'customer'; // Assuming new users have a default user_type 'customer'
            $_SESSION['login'] = true;

            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registration Successful',
                        showConfirmButton: false,
                        timer: 1500,
                         
                    }).then(() => {
                        window.location.href='../index.php';
                    });
                });
            </script>";
        } catch (Exception $e) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Registration Failed',
                        text: 'Please try again.'
                    }).then(() => {
                        window.location.href='signinup.php';
                    });
                });
            </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
</head>

<body>
    <div class="pp">
        <div class="container">
            <div class="login-wrap">
                <div class="login-html">
                    <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
                    <label for="tab-1" class="tab">Sign In</label>
                    <input id="tab-2" type="radio" name="tab" class="sign-up">
                    <label for="tab-2" class="tab">Sign Up</label>
                    <div class="login-form">
                        <div class="sign-in-htm">
                            <form id="signin" action="" method="post">
                                <div class="group">
                                    <label for="email" class="label">Email</label>
                                    <input id="email" name="email" type="email" class="input">
                                </div>
                                <div class="group">
                                    <label for="password" class="label">Password</label>
                                    <input id="password" name="password" type="password" class="input" data-type="password">
                                </div>
                                <br>
                                <div class="group">
                                    <input type="submit" name="signin" class="button" value="Sign In">
                                </div>
                                <div class="hr"></div>
                                <div class="foot-lnk">
                                    <label for="tab-2">No Account? Sign up Now!</label>
                                </div>
                            </form>
                        </div>
                        <div class="sign-up-htm">
                            <form id="signup" action="" method="post">
                                <div class="group">
                                    <label for="user" class="label">Full Name</label>
                                    <input id="user" name="name" type="text" class="input">
                                </div>
                                <div class="group">
                                    <label for="pass" class="label">Password</label>
                                    <input id="pass" type="password" name="password" class="input" data-type="password">
                                </div>
                                <div class="group">
                                    <label for="pass2" class="label">Repeat Password</label>
                                    <input id="pass2" name="password2" type="password" class="input" data-type="password">
                                </div>
                                <div class="group">
                                    <label for="email" class="label">Email</label>
                                    <input type="email" class="input" id="email" name="email" required>
                                </div>
                                <br>
                                <div class="group">
                                    <input type="submit" name="signup" class="button" value="Sign Up">
                                </div>
                                <div class="hr"></div>
                                <div class="foot-lnk">
                                    <label for="tab-1">Already Member?</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>