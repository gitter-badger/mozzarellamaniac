<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start();
        $order = json_decode(file_get_contents('php://input'), true);
        $connection = mysqli_connect("localhost", "root", "root", "pizzeria");
            $sqlPrice = "SELECT pizza_id, price FROM pizza WHERE pizza_id=" . $order["pizza_id"] . " AND pizza_name='" . $order["pizza_name"] . "' ";
            $resultPrice = $connection->query($sqlPrice);
            $rowPrice = mysqli_fetch_assoc($resultPrice);

            if ($_SESSION["id" . $rowPrice["pizza_id"]] >= 0) {
                $_SESSION["summaryPrice"] -= $_SESSION["id" . $rowPrice["pizza_id"]];
            }
            if ($order["quantity"] == 0) {
                unset($_SESSION["id".$rowPrice["pizza_id"]]);
            }
            $_SESSION["id" . $rowPrice["pizza_id"]] = $order["quantity"] * $rowPrice["price"];
            $_SESSION["summaryPrice"] += $_SESSION["id" . $rowPrice["pizza_id"]];
            $connection->close();


    }






    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        session_start();
        $order = json_decode(file_get_contents('php://input'), true);
        $connection = mysqli_connect("localhost", "root", "root", "pizzeria");
        $sqlPizza = "SELECT pizza_id, pizza_name, price FROM pizza";
        $resultPizza = $connection->query($sqlPizza);
        $rowsPizza = array();
        echo("[");
        $colon = false;
        while ($rowPizza = mysqli_fetch_assoc($resultPizza)) {
            if ($_SESSION[$rowPizza["pizza_id"]] > 0) {
                if ($colon == true) { echo(",");}
                echo("{\"pizza_id\":".$rowPizza["pizza_id"].",\"pizza_name\":\"".$rowPizza["pizza_name"]."\",\"quantity\":".$_SESSION["id".$rowPizza["pizza_id"]].",\"price_sub\":".($_SESSION["id".$rowPizza["pizza_id"]]/$rowPizza["price"] )."}");
                $colon = true;
            }
        }
        echo("]");
        $connection->close();
    }
?>