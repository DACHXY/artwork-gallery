<?php
session_start();
@require_once $_SERVER['DOCUMENT_ROOT'] . "/db/context.php";
@include $_SERVER['DOCUMENT_ROOT'] . "/db/dbConnect.php";

if ($_SESSION["logged_in"] == false) {
    header("Location: /login");
    exit();
}

$id = $_SESSION["id"];
$username = $_POST["username"];
$email = $_POST["email"];
$pattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

if (empty($username) || empty($email) || !preg_match($pattern, $email)) {
    $error_msg = "Modified User failed!";
    $error_msg .= empty($username) ? "\nUsername cannot be empty!" : null;
    $error_msg .= empty($email) ? "\nEmail cannot be empty!" : null;
    $error_msg .= !preg_match($pattern, $email) ? "\nEmail format not correct!" : null;
    $error_msg = urlencode($error_msg);
    header("location: /me?error=$error_msg");
    exit();
}

$newuser = [
    "username" => $username,
    "email" => strtolower($email)
];

$result = updateUser($pdo, $newuser, $id);

$users = getUserByEmail($pdo, $email);
$user = $users[0];
$_SESSION['username'] = $user["username"];
$_SESSION['email'] = $user["email"];
$_SESSION['avatar'] = $user["avatar"];
$_SESSION["id"] = $id;
$_SESSION['logged_in'] = true;

header("Location: /me?edit=success");
exit();
?>