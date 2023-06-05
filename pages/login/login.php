<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="/pages/login/login.css">
    <script src="/scripts/functions.js"></script>
</head>

<body>

    <div class="flex-container">
        <?php
        @require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header/header.php";
        @require_once $_SERVER['DOCUMENT_ROOT'] . "/components/userAvatar/userAvatar.php";

        // 主頁 Header
        $HEADER = new Header();
        echo $HEADER->render();
        ?>
        <div class="container">
            <?php
            $img_url = "https://d7hftxdivxxvm.cloudfront.net?height=800&quality=80&resize_to=fit&src=https%3A%2F%2Fd32dm0rphc51dk.cloudfront.net%2FZAhImh5sUknFpzM2g45kNw%2Fnormalized.jpg&width=800";
            echo <<<HTML
                <img src="$img_url" class="container-bg"/>
            HTML;
            ?>
            <div class="login-from">
                <?php
                @require_once $_SERVER['DOCUMENT_ROOT'] . "/components/button/actionButton/actionButton.php";

                function AuthForm($title, $auth_tag, $inputArray, $submit_button_text)
                {
                    $html = "";
                    foreach ($inputArray as $value) {
                        $name = $value["name"];
                        $type = $value["type"];
                        $text = $value["text"];
                        $defaultValue = isset($value["value"]) ? $value["value"] : "";
                        $hide = isset($value["hide"]) ? "none" : "general-input-section";

                        $html .= <<<HTML
                            <div class="$hide">
                                <input value="$defaultValue" oninput="handleInputChange('$name')" required placeholder="" class="general-input" id="$name" type="$type" name="$name"/>
                                <label for="$name">$text</label>
                            </div>
                        HTML;
                    }

                    $action_button_props = array(
                        "href" => "#",
                        "text" => $submit_button_text,
                        "onClick" => "document.getElementById('submit-button').click(); return false;",
                        "className" => "auth-submit"
                    );
                    $ACTION_BUTTON = new ActionButton($action_button_props);

                    return <<<HTML
                    <h1>$title</h1>
                    <form class="general-form" method="POST" action="/login">
                        <div class="general-input-container">
                            $html
                        </div>
                        <input class="none" id="submit-button" type="submit" name="$auth_tag" value=""/>
                        {$ACTION_BUTTON->render()}
                    </form>
                HTML;
                }

                $action_button_props = array(
                    "href" => "#",
                    "text" => "Submit",
                    "onClick" => "document.getElementById('submit-button').click(); return false;",
                    "className" => "auth-submit"
                );
                $ACTION_BUTTON = new ActionButton($action_button_props);

                //處理登入邏輯
                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    $input_array = [
                        array(
                            "name" => "email",
                            "type" => "text",
                            "text" => "Email"
                        )
                    ];
                    echo AuthForm("Hi, There!", "emailVerify", $input_array, "Submit");
                } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (isset($_POST['login'])) {
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

                            header("Location: /home");
                            exit();
                        }


                    } else if (isset($_POST['register'])) {
                        // 註冊 POST 請求處理邏輯
                        handleRegisterRequest();
                    }

                    // 驗證 Email
                    if (isset($_POST['emailVerify'])) {
                        $email = strtolower($_POST['email']);
                        $emails = ["danny10132024@gmail.com", "danny01161013@gmail.com"];

                        // Email 存在
                        if (in_array($email, $emails)) {
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
                            echo AuthForm("Welcome Back, $username!", "login", $input_array, "Log In");
                        } else {
                            // 註冊
                            $input_array = [
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
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <script>
        handleInputChange('email')
    </script>
</body>

</html>