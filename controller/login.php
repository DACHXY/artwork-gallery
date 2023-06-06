<?php
// 登入 POST 請求處理邏輯
@require_once $_SERVER['DOCUMENT_ROOT'] . "/db/context.php";
@include $_SERVER['DOCUMENT_ROOT'] . "/db/dbConnect.php";

function ErrorForm($msg, $email)
{
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
    echo AuthForm($msg, "login", $input_array, "Log In");
}

// POST 資料
$password = $_POST["password"];
$email = $_POST["email"];

$results = getUserByEmail($pdo, $email);
if ($results == null || count($results) == 0) {
    header("Location: /login");
    exit();
}

$user = $results[0];
$username = $user["username"];
$DBpassword = $user["password"];

// 密碼錯誤
if ($password != $DBpassword) {
    // 獲取名字
    echo ErrorForm("Password is wrong!", $email);
} else if (($password == $DBpassword)) {
    session_start();

    // 獲取使用者資料
    $user_email = $user["email"];
    $user_avatar = $user["avatar"];
    $user_id = $user["id"];
    $user_liked_artworks = [];

    // 儲存資料
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $user_email;
    $_SESSION['avatar'] = $user_avatar;
    $_SESSION["id"] = $user_id;
    $_SESSION['logged_in'] = true;

    echo "<h1 class=\"under-line-animation\">Logged In, $username!</h1>";
    echo '<script>';
    echo 'setTimeout(function() {';
    echo '  window.location.href = "/home";'; // 在五秒後重定向到 /home
    echo '}, 2000);'; //  等待2秒
    echo '</script>';
    exit();
}
?>