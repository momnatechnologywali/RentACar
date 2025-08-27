<?php
header("Content-Type: application/json");
require_once "db.php";
 
$data = json_decode(file_get_contents("php://input"), true);
 
try {
    $stmt = $pdo->prepare("INSERT INTO bookings (car_id, user_name, user_email, user_phone, start_date, end_date) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$data['carId'], $data['name'], $data['email'], $data['phone'], $data['startDate'], $data['endDate']]);
    echo json_encode(["success" => true]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>
