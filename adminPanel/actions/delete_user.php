<?php
require_once "../class/users.class.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userId'])) {
    $user = new Users();
    $userId = $_POST['userId'];

    $currentUser = $user->getUserById($userId);

    if (!$currentUser) {
        echo json_encode(['success' => false, 'message' => 'User not found']);
        exit;
    }

    if ($currentUser['usertype'] === 'superadmin') {
        echo json_encode(['success' => false, 'message' => 'Cannot delete superadmin users']);
        exit;
    }

    $result = $user->deleteUser($userId);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete user']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}