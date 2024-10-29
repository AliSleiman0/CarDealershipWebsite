<?php
require_once '../class/users.class.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $users = new Users();
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userId = isset($_POST['userId']) ? $_POST['userId'] : null;

    // Validate input
    if (empty($name) || empty($email) || (empty($userId) && empty($password))) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format']);
        exit;
    }

    if ($userId) {
        // Editing existing user
        $currentUser = $users->getUserById($userId);
        if (!$currentUser || $currentUser['usertype'] != 'admin') {
            echo json_encode(['success' => false, 'message' => 'Invalid user']);
            exit;
        }

        $result = $users->updateUser(
            $userId,
            $name,
            $email,
            $password ? password_hash($password, PASSWORD_DEFAULT) : $currentUser['PasswordHash'],
            'admin'
        );

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Admin user updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update admin user']);
        }
    } else {
        // Adding new user
        if ($users->emailExists($email)) {
            echo json_encode(['success' => false, 'message' => 'Email already exists']);
            exit;
        }

        $result = $users->addUser($name, $email, password_hash($password, PASSWORD_DEFAULT), 'admin');

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'New admin user added successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add new admin user']);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
