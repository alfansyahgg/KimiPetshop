<?php
session_start();
include('connect.php');

if (!isset($_SESSION['username'])) {
    header("Location: ".$baseURL);
}
session_destroy();
header("Location: ".$baseURL);

?>