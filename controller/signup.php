<?php
session_start();

@require_once $_SERVER['DOCUMENT_ROOT'] . "/db/context.php";
@include $_SERVER['DOCUMENT_ROOT'] . "/db/dbConnect.php";
@require_once $_SERVER['DOCUMENT_ROOT'] . "/helper/helper.php";

$email = strtolower($_POST['email']);
$username = $_POST["username"];
$password = $_POST["password"];
$re_password = $_POST["re-password"];

// 初步驗證
if ($password !== $re_password) {
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
    echo AuthForm("The password not match!", "register", $input_array, "Join");
    exit();
}

echo "<h1>Welcome, $username!</h1>";

$default_avatar = "/www/images/avatars/default.jpg";
$user_id = generateUUID();
$user = [
    "id" => $user_id,
    "username" => $username,
    "email" => $email,
    "avatar" => $default_avatar,
    "password" => $password,
    "create_at" => date('Y-m-d H:i:s')
];

$result = addUser($pdo, $user);

if (!$result) {
    echo "<h1>註冊失敗</h1>";
    echo '<script>';
    echo 'setTimeout(function() {';
    echo '  window.location.href = "/login";'; // 在五秒後重定向到 /home
    echo '}, 3000);'; // 5000 毫秒等於五秒
    echo '</script>';
    exit();
}

// 儲存資料
$_SESSION['username'] = $username;
$_SESSION['email'] = $email;
$_SESSION['avatar'] = $default_avatar;
$_SESSION['logged_in'] = true;
$_SESSION["id"] = $user_id;

echo '<script>';
echo 'setTimeout(function() {';
echo '  window.location.href = "/home";'; // 在五秒後重定向到 /home
echo '}, 3000);'; // 5000 毫秒等於五秒
echo '</script>';
exit();
?>