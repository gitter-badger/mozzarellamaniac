<?php
//Establishing Mysql connection
header("Content-type: application/json; charset=utf-8");
$connection = mysqli_connect("127.0.0.1","root","root","pizzeria");

    $sqlPizza = "SELECT pizza_id, pizza_name, price, image FROM pizza WHERe visible=1";
    $query = $connection->query($sqlPizza);
    $rowsPizza = array();
    while($res = mysqli_fetch_assoc($query)) {
        $rows[] = $res;
    }
    echo(json_encode($rows));
    $connection->close();
?>