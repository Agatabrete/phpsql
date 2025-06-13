<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
}

function requireAuth() {
    if (!isLoggedIn()) {
        header("Location: /auth/login.php");
        exit();
    }
}
function requireAdmin() {
    requireAuth();
    if (!isAdmin()) {
        header("Location: /");
        exit();
    }
}
?>