<?php
session_start();

echo $_SESSION['state'] = $_POST['State'];


$_SESSION['city'] = $_POST['City'];

?>