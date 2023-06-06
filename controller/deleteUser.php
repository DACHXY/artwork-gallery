<?php
session_start();
@require_once $_SERVER['DOCUMENT_ROOT'] . "/db/context.php";
@include $_SERVER['DOCUMENT_ROOT'] . "/db/dbConnect.php";


if ($_SESSION["logged_in"] == false) {
    header("Location: /login");
    exit();
}

$id = $_SESSION["id"];

$result = deleteUser($pdo, $id);
header("Location: /login");
exit();
?>