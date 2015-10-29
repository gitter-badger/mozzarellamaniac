
<?php
    session_start();
    if (isset($_SESSION['loginname']) && $_SERVER["REQUEST_METHOD"] == "GET") {
        header("Content-type: application/json");
        $connection = mysqli_connect("localhost", "root", "root", "pizzeria");

        $sqlTopping = "SELECT topping_id, topping_name FROM topping";
        $rowsTopping = array();
        $resultTopping = $connection->query($sqlTopping);
        $rowsTopping = array();
        while ($rowTopping = mysqli_fetch_assoc($resultTopping)) {
            $rowsTopping[] = $rowTopping;
        }
        echo(json_encode($rowsTopping));
        $connection->close();
    }
?>