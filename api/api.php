
<?php
function GetAllPizza(){
    //Establishing Mysql connection
    header("Content-type: application/json");
    $connection = mysqli_connect("127.0.0.1","root","root","pizzeria");
    $sqlPizza = "SELECT pizza_id, pizza_name, price, image FROM pizza";
    $query = $connection->query($sqlPizza);
    $rows = array();
    while($res = mysqli_fetch_assoc($query)) {
        $rows[] = $res;
    }
    echo json_encode($rows);
}

    function GetPizzaById($id=null){
        $id = $_GET['id'];
        if (!$id) {

        }
        else {
            header("Content-type: application/json");
            $connection = mysqli_connect("localhost", "root", "root", "pizzeria");
            $sqlPizza = "SELECT pizza_id, pizza_name, price, image FROM pizza WHERE pizza.pizza_id=" . $id;
            $resultPizza = $connection->query($sqlPizza);
            $rowPizza = mysqli_fetch_assoc($resultPizza);
                $sqlTopping = "SELECT topping_name FROM topping JOIN pizza_topping ON (topping.topping_id=pizza_topping.topping_id) WHERE pizza_id=" . $rowPizza["pizza_id"];
                $resultTopping = $connection->query($sqlTopping);
                $rowsTopping = array();
                while ($rowTopping = mysqli_fetch_assoc($resultTopping)) {
                    $rowsTopping[] = $rowTopping;
                }
                echo("{\"pizza_id\":".$rowPizza["pizza_id"].",\"pizza_name\":\"".$rowPizza["pizza_name"]."\",\"price\":".$rowPizza["price"].",\"topping_sub\":".json_encode($rowsTopping).",\"image\":\"".$rowPizza["image"]."\"}");

        }
    }
?>