<?php 
    require("../C/cabe_sweetalert.php");
    session_start();
    session_destroy();
    header("location:index.php");
?>