<?php
    session_start();
    header("Content-type: application/json; charset=utf-8");
    if (isset($_SESSION['loginname'])) {
        echo("{\"valid\":\"true\"}");
    }
    else {
        echo("{\"valid\":\"false\"}");
    }
?>