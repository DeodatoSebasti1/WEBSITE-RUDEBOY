<?php

session_start(); 

unset($_SESSION["car"]);
//unset($_SESSION["car"])

header("location:../V/vendas.php");


?>