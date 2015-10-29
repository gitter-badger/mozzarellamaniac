<?php
function ViewOrder(){
	header("Content-type: application/json");
    $connection = mysqli_connect("127.0.0.1","root","root","pizzeria");
    $sqlPizza = "SELECT * FROM purchase";
    $query = $connection->query($sqlPizza);
    $rows = array();
    while($res = mysqli_fetch_assoc($query)) {
        $rows[] = $res;
    }
    echo json_encode($rows);
}
function ViewOrderDetails(){
	header("Content-type: application/json");
    $connection = mysqli_connect("127.0.0.1","root","root","pizzeria");
    $sqlPizza = "SELECT * FROM purchase_details";
    $query = $connection->query($sqlPizza);
    $rows = array();
    while($res = mysqli_fetch_assoc($query)) {
        $rows[] = $res;
    }
    echo json_encode($rows);
}
function PurchaseOrder($json){
	
}
ViewOrderDetails();
ViewOrder();
//PurchaseOrder();
?>