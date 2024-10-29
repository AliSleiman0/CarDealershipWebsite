<?php
require_once "../class/users.class.php";

if (isset($_POST['userId'])) {
    $user = new Users();
    $userDetails = $user->getUserById($_POST['userId']);

    if ($userDetails) {
        echo json_encode(['success' => true, 'user' => $userDetails]);
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
