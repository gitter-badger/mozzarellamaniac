<?php
    session_start();
    if (isset($_SESSION['loginname'])) {
        include('api.php');
        GetAllPizza();
    }
?>