<?php
session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Ensure session is completely destroyed
setcookie(session_name(), '', time() - 3600, '/');

echo json_encode(["status" => "success", "message" => "Logged out successfully"]);
header("Location: ../index.html");
exit;
?>

