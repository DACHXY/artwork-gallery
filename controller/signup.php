<?php
session_start();

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

// 儲存資料
$_SESSION['username'] = $username;
$_SESSION['email'] = $user_email;
$_SESSION['avatar'] = $user_avatar;
$_SESSION['logged_in'] = true;

echo '<script>';
echo 'setTimeout(function() {';
echo '  window.location.href = "/home";'; // 在五秒後重定向到 /home
echo '}, 5000);'; // 5000 毫秒等於五秒
echo '</script>';
exit();
?>