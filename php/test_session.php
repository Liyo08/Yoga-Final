<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    $_SESSION["user_id"] = "TestUser";
    echo "Session Created!";
} else {
    echo "Session exists: " . $_SESSION["user_id"];
}
?>
