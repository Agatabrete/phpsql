<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';
requireAuth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate dates (Criteria 17, 18)
    $today = new DateTime();
    $checkIn = new DateTime($_POST['check_in_date']);
    $checkOut = new DateTime($_POST['check_out_date']);
    
    if ($checkIn < $today) {
        $errors[] = "Cannot book for past dates";
    }
    
    if ($checkIn >= $checkOut) {
        $errors[] = "Check-out date must be after check-in date";
    }
    
    if (empty($errors)) {
        // Check room availability again (concurrency check)
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM bookings WHERE room_id = ? AND status = 'active' AND ((check_in_date < ? AND check_out_date > ?) OR (check_in_date >= ? AND check_in_date < ?) OR (check_out_date > ? AND check_out_date <= ?))");
        $stmt->execute([$_POST['room_id'], $checkOut->format('Y-m-d'), $checkIn->format('Y-m-d'), $checkIn->format('Y-m-d'), $checkOut->format('Y-m-d'), $checkIn->format('Y-m-d'), $checkOut->format('Y-m-d')]);
        
        if ($stmt->fetchColumn() == 0) {
            // Calculate price
            $days = $checkOut->diff($checkIn)->days;
            $stmt = $pdo->prepare("SELECT price_per_night FROM rooms WHERE id = ?");
            $stmt->execute([$_POST['room_id']]);
            $price = $stmt->fetchColumn() * $days;
            
            // Create booking
            $stmt = $pdo->prepare("INSERT INTO bookings (user_id, room_id, check_in_date, check_out_date, total_price) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([
                $_SESSION['user_id'],
                $_POST['room_id'],
                $checkIn->format('Y-m-d'),
                $checkOut->format('Y-m-d'),
                $price
            ]);
            
            header("Location: /bookings/view.php");
            exit();
        } else {
            $errors[] = "Room is no longer available for selected dates";
        }
    }
}
?>