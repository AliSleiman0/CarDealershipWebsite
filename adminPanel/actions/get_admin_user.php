<?php
require_once '../class/users.class.php';

if (isset($_GET['userId'])) {
    $users = new Users();
    $userData = $users->getUserById($_GET['userId']);

    if ($userData && $userData['usertype'] == 'admin') {
        echo json_encode([
            'name' => $userData['Name'],
            'email' => $userData['Email']
        ]);
    } else {
        echo json_encode(['error' => 'User not found or not an admin']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
