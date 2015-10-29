<?php
    session_start();
    if (isset($_SESSION['loginname']) && $_SERVER["REQUEST_METHOD"] == "GET") {
        header("Content-type: application/json");
        $connection = mysqli_connect("localhost", "root", "root", "pizzeria");

        $sqlPizza = "SELECT pizza_id, pizza_name, price, image, visible FROM pizza";
        $rowsPizza = array();
        $resultPizza = $connection->query($sqlPizza);
        print("[");
        $colon = false;
        while ($rowPizza = mysqli_fetch_assoc($resultPizza)) {
            if ($colon == true) { print(", ");}
            $sqlTopping = "SELECT topping_name FROM topping JOIN pizza_topping ON (topping.topping_id=pizza_topping.topping_id) WHERE pizza_id=".$rowPizza["pizza_id"];
            $resultTopping = $connection->query($sqlTopping);
            $rowsTopping = array();
            while ($rowTopping = mysqli_fetch_assoc($resultTopping)) {
                $rowsTopping[] = $rowTopping;
            }
            print("{\"pizza_id\":".$rowPizza["pizza_id"].",\"pizza_name\":\"".$rowPizza["pizza_name"]."\",\"price\":".$rowPizza["price"].",\"topping_sub\":".json_encode($rowsTopping).",\"image\":\"".$rowPizza["image"]."\",\"visible\":".$rowPizza["visible"]."}");
            $colon = true;

        }
        print("]");
        $connection->close();

    }
?>