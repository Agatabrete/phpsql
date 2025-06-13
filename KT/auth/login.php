<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($_POST['password'], $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_admin'] = $user['is_admin'];
        
        if (isset($_POST['remember_me'])) {
            $token = bin2hex(random_bytes(32));
            $expiry = time() + 4 * 60 * 60; 
            
            setcookie('remember_token', $token, $expiry, '/');
            
            $stmt = $pdo->prepare("UPDATE users SET remember_token = ?, token_expiry = ? WHERE id = ?");
            $stmt->execute([$token, date('Y-m-d H:i:s', $expiry), $user['id']]);
        }
        
        header("Location: /");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>