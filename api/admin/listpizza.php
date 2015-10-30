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
            mysqli_set_charset("utf8");
            $sqlPizza = "SELECT pizza_id, pizza_name, price, image, visible FROM pizza WHERE pizza.pizza_id=" . $id;
            $resultPizza = $connection->query($sqlPizza);
            $rowPizza = mysqli_fetch_assoc($resultPizza);
            $sqlTopping = "SELECT topping_name FROM topping JOIN pizza_topping ON (topping.topping_id=pizza_topping.topping_id) WHERE pizza_id=" . $rowPizza["pizza_id"];
            $resultTopping = $connection->query($sqlTopping);
            $rowsTopping = array();
            while ($rowTopping = mysqli_fetch_assoc($resultTopping)) {
                $rowsTopping[] = $rowTopping;
            }
            echo("{\"pizza_id\":".$rowPizza["pizza_id"].",\"pizza_name\":\"".$rowPizza["pizza_name"]."\",\"price\":".$rowPizza["price"].",\"topping_sub\":".json_encode($rowsTopping).",\"image\":\"".$rowPizza["image"]."\",\"visible\":".$rowPizza["visible"]."}");
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