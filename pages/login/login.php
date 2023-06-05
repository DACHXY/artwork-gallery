<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="/pages/login/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
                //處理登入邏輯
                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    echo <<<HTML
                        <h1>Hi</h1>
                        <form method="POST" action="/login">
                            <input class="submit-button" type="submit" name="emailVerify" value="註冊">
                        </form>
                    HTML;
                } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (isset($_POST['login'])) {
                        // 登入 POST 請求處理邏輯
                        handleLoginRequest();
                    } elseif (isset($_POST['register'])) {
                        // 註冊 POST 請求處理邏輯
                        handleRegisterRequest();
                    }

                    // 驗證 Email
                    if (isset($_POST['emailVerify'])) {
                        $Emails = ["danny10132024@gmail.com", "danny01161013@gmail.com"];

                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>