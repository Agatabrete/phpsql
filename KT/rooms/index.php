<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';

$checkIn = $_GET['check_in'] ?? date('Y-m-d');
$checkOut = $_GET['check_out'] ?? date('Y-m-d', strtotime('+1 day'));

// Server-side validation (Criteria 13)
if (!strtotime($checkIn) || !strtotime($checkOut) || $checkIn >= $checkOut) {
    $errors[] = "Invalid date selection";
}

// Get available rooms
$stmt = $pdo->prepare("
    SELECT r.* 
    FROM rooms r
    WHERE r.is_active = TRUE
    AND r.id NOT IN (
        SELECT b.room_id 
        FROM bookings b
        WHERE b.status = 'active'
        AND (
            (b.check_in_date < ? AND b.check_out_date > ?) OR
            (b.check_in_date >= ? AND b.check_in_date < ?) OR
            (b.check_out_date > ? AND b.check_out_date <= ?)
        )
    )
");
$stmt->execute([$checkOut, $checkIn, $checkIn, $checkOut, $checkIn, $checkOut]);
$rooms = $stmt->fetchAll();
?>