<?php
// 登入 POST 請求處理邏輯
$DBpassword = "danny2024";
$password = $_POST["password"];
$email = $_POST["email"];

// 密碼錯誤
if ($password != $DBpassword) {
    // 獲取名字
    $username = "DACHXY";
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
    echo AuthForm("Password is wrong!", "login", $input_array, "Log In");
} else if (($password == $DBpassword)) {
    session_start();

    // 獲取使用者資料
    $username = "DACHXY";
    $user_email = "danny10132024@gmail.com";
    $user_avatar = "/www/images/avatars/dachxy.jpg";
    $user_liked_artworks = [];

    // 儲存資料
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $user_email;
    $_SESSION['avatar'] = $user_avatar;
    $_SESSION['logged_in'] = true;

    echo "<h1 class=\"under-line-animation\">Welcome back, $username!</h1>";
    echo '<script>';
    echo 'setTimeout(function() {';
    echo '  window.location.href = "/home";'; // 在五秒後重定向到 /home
    echo '}, 5000);'; // 5000 毫秒等於五秒
    echo '</script>';
    exit();
}
?>