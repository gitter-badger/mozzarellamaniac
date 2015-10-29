<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['loginname'])) {
        $connection = mysqli_connect("localhost", "root", "root", "pizzeria");
        $pizza = json_decode(file_get_contents('php://input'), true);
        $sqlNewPizza = "INSERT INTO pizza (pizza_name,price,image,visible) VALUES ('" . $pizza["pizza_name"] . "'," . $pizza["price"] . ",'null',0)";
        $connection->query($sqlNewPizza);
        $connection->close();
    }
?>