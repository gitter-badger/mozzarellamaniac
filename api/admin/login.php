<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $connection = mysqli_connect("localhost", "root", "root", "pizzeria");
        $credentials = json_decode(file_get_contents('php://input'), true);
        $sqlLogin = "SELECT password FROM account WHERE loginname='" . $credentials["loginname"] . "'";
        $resultLogin = $connection->query($loginSqlString);
        $rowLogin = mysqli_fetch_assoc($resultLogin);
        if ($rowLogin["password"] == $data["password"]) {
            session_start();
            $_SESSION['loginname'] = $credentials["loginname"];
        }
        $connection->close();
    }
?>