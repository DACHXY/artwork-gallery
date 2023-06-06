<?php
session_start();
@require_once $_SERVER['DOCUMENT_ROOT'] . "/db/context.php";
@include $_SERVER['DOCUMENT_ROOT'] . "/db/dbConnect.php";

// 未登入
if ($_SESSION["logged_in"] == false) {
    session_destroy();
    header("Location: /login");
    exit();
}
$id = $_SESSION["id"];
$artwork_slug = $_GET["artwork_slug"];
$artworks_in_cart = getUserCart($pdo, $id);

print_r($artworks_in_cart);
if (in_array($artwork_slug, $artworks_in_cart)) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

$result = addToUserCart($pdo, $artwork_slug, $id);

// 重新引導回頁面
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
?>