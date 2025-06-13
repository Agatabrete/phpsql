<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
requireAdmin();

$stmt = $pdo->query("
    SELECT b.*, u.first_name, u.last_name, r.room_number 
    FROM bookings b
    JOIN users u ON b.user_id = u.id
    JOIN rooms r ON b.room_id = r.id
    ORDER BY b.booking_date DESC
");
$bookings = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'update':
            $stmt = $pdo->prepare("UPDATE bookings SET check_in_date = ?, check_out_date = ?, total_price = ?, status = ? WHERE id = ?");
            $stmt->execute([
                $_POST['check_in_date'],
                $_POST['check_out_date'],
                $_POST['total_price'],
                $_POST['status'],
                $_POST['booking_id']
            ]);
            break;
        case 'delete':
            $stmt = $pdo->prepare("DELETE FROM bookings WHERE id = ?");
            $stmt->execute([$_POST['booking_id']]);
            break;
    }
    header("Location: bookings.php");
    exit();
}
?>