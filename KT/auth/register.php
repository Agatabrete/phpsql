<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    
    if (!preg_match('/^\d{11}$/', $_POST['personal_code'])) {
        $errors[] = "Invalid personal code format";
    }
    
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (empty($errors)) {
        $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, personal_code, email, password_hash) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['first_name'],
            $_POST['last_name'],
            $_POST['personal_code'],
            $_POST['email'],
            $passwordHash
        ]);
        
        header("Location: login.php?registered=1");
        exit();
    }
}
?>