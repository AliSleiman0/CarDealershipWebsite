<?php
session_start();
unset($_SESSION['email']);
unset($_SESSION['login']);
session_destroy();
echo "<script>window.location.href='SignINUP/signinup.php'</script>";
exit;
