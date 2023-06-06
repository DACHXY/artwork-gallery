<?php
@require_once $_SERVER['DOCUMENT_ROOT'] . "/db/context.php";
@include $_SERVER['DOCUMENT_ROOT'] . "/db/dbConnect.php";

$email = strtolower($_POST['email']);
$users = getUserByEmail($pdo, $email);

// Email 存在
if ($users != null && count($users) != 0) {
    $user = $users[0];
    // 獲取名字 並登入
    $username = $user["username"];
    $input_array = [
        array(
            "name" => "password",
            "type" => "password",
            "text" => "Password"
        ),
        // hidden post value
        array(
            "name" => "email",
            "type" => "text",
            "text" => "email",
            "value" => $email,
            "hide" => true
        )
    ];
    echo AuthForm("Welcome Back, $username!", "login", $input_array, "Log In");
} else {
    // 註冊
    $input_array = [
        array(
            "name" => "username",
            "type" => "text",
            "text" => "Username"
        ),
        array(
            "name" => "password",
            "type" => "password",
            "text" => "Password"
        ),
        array(
            "name" => "re-password",
            "type" => "password",
            "text" => "Retype Password"
        ),
        // hidden post value
        array(
            "name" => "email",
            "type" => "text",
            "text" => "email",
            "value" => $email,
            "hide" => true
        )
    ];
    echo AuthForm("Join Us!", "register", $input_array, "Join");
}
?>