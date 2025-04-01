<?php
session_start();
include "db_connect.php";

header("Content-Type: application/json");

// Clear previous session (Fixes issue when logging in after logout)
session_unset();
session_destroy();
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
    exit;
}

$email = trim($_POST["email"] ?? '');
$password = trim($_POST["password"] ?? '');

if (empty($email) || empty($password)) {
    echo json_encode(["status" => "error", "message" => "Email and password are required!"]);
    exit;
}

$stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $name, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        $_SESSION["user"] = ["id" => $id, "name" => $name, "email" => $email];

        echo json_encode(["status" => "success", "message" => "Login successful!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Incorrect password!"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "User not found!"]);
}
$stmt->close();
?>
