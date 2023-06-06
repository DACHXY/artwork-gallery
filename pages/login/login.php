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
                    <h1 class="under-line-animation">$title</h1>
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
                        @include $_SERVER['DOCUMENT_ROOT'] . "/controller/login.php";

                    } else if (isset($_POST['register'])) {
                        // 註冊 POST 請求處理邏輯
                        @include $_SERVER['DOCUMENT_ROOT'] . "/controller/signup.php";
                    }

                    // 驗證 Email
                    if (isset($_POST['emailVerify'])) {
                        @include $_SERVER['DOCUMENT_ROOT'] . "/controller/emailVerify.php";
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <script>
        handleInputChange('email')
        handleInputChange('username')
        handleInputChange('password')
        handleInputChange('re-password')
    </script>
</body>

</html>