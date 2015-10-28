<?php
    header("Content-type: application/json; charset=utf-8");
    session_start();
    if ( isset($_SESSION["loginname"]) && $_SERVER["REQUEST_METHOD"] == "GET" ) {
        $id = $_GET['id'];
        if (!$id) {
        }
        else {
            header("Content-type: application/json");
            $connection = mysqli_connect("localhost", "root", "root", "pizzeria");
            $sqlTopping = "SELECT topping_id, topping_name FROM topping WHERE topping.topping_id=" . $id;
            $resultTopping = $connection->query($sqlTopping);
            echo(json_encode(mysqli_fetch_assoc($resultTopping)));
            $connection->close();
        }
    }
if ( isset($_SESSION["loginname"]) && $_SERVER["REQUEST_METHOD"] == "POST" ) {
    $pizza = json_decode(file_get_contents('php://input'), true);
        $connection = mysqli_connect("localhost", "root", "root", "pizzeria");
        $sqlPizza = "UPDATE pizza SET pizza_name='".$pizza["pizza_name"]."', price=".$pizza["price"].", image='".$pizza["image"]."', visible=".$pizza["visible"]." WHERE pizza_id=" . $pizza["pizza_id"] ;
        $connection->query($sqlPizza);
        $connection->close();


}
?>