<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['loginname'])) {
        $connection = mysqli_connect("localhost", "root", "root", "pizzeria");
        $topping = json_decode(file_get_contents('php://input'), true);
        $sqlNewTopping = "INSERT INTO topping (topping_name) VALUES ('".$topping["topping_name"]."')";
        $connection->query($sqlNewTopping);
        $connection->close();
    }
?>