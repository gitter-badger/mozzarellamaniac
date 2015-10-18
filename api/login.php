<?php

    //Establishing Mysql connection

    $conn = new PDO("mysql:host=localhost;dbname=pizzeria", 'root', 'root');
    $data = json_decode(file_get_contents('php://input'), true);

    $sql = "SELECT password FROM account WHERE loginname='".$data["loginname"]."'";
    $query = $conn->query($sql);
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if ($result["password"] == $data["password"]) {
        session_start();
        $_SESSION['loginname'] = $data["loginname"];//$data.username;
    }
?>