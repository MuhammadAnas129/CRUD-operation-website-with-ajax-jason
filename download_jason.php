<?php
session_start();

if (!isset($_SESSION['valid'])) {
	header('Location: login.php');
	exit;
}

// including the database connection file
include_once("connection.php");

// fetching data in descending order (latest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM products WHERE login_id=" . $_SESSION['id'] . "
