<?php
require_once "../class/users.class.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new Users();
    $userId = $_POST['userId'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $userType = isset($_POST['userType']) ? $_POST['userType'] : null;

    $currentUser = $user->getUserById($userId);

    if (!$currentUser) {
        echo json_encode(['success' => false, 'message' => 'User not found']);
        exit;
    }

    // Check if password change is requested
    if (!empty($oldPassword) && !empty($newPassword)) {
        if (!password_verify($oldPassword, $currentUser['PasswordHash'])) {
            echo json_encode(['success' => false, 'message' => 'Incorrect old password']);
            exit;
        }
        $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
    } else {
        $passwordHash = $currentUser['PasswordHash'];
    }

    $result = $user->updateUser($userId, $name, $email, $passwordHash, $userType);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update user']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
