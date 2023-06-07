<?php
session_start();
@require_once $_SERVER['DOCUMENT_ROOT'] . "/db/context.php";
@include $_SERVER['DOCUMENT_ROOT'] . "/db/dbConnect.php";


if ($_SESSION["logged_in"] == false) {
    session_destroy();
    header("Location: /login");
    exit();
}
$id = $_SESSION["id"];
$items_in_cart = getUserCart($pdo, $id);

if (count($items_in_cart) == 0) {
    header("Location: /me?msg=Cart+empty!");
    exit();
}

$id = $_SESSION["id"];
$result = addToOrder($pdo, $id);
header("Location: /me");
?>