<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My</title>
    <link rel="stylesheet" type="text/css" href="/pages/my/my.css">
    <script src="/scripts/functions.js"></script>
</head>

<body>
    <?php
    session_start();

    function mapCart($array)
    {
        $html = "";
        foreach ($array as $value) {
            $src = $value["image"];
            $artwork_name = $value["artwork_name"];
            $html .= <<<HTML
                <div>
                    <img src="$src">
                    <div>
                        $artwork_name 
                    </div>
                </div>
            HTML;
        }
        return $html;
    }

    if ($_SESSION["logged_in"] == false) {
        Header("location: /login");
        exit();
    }

    if ($_GET["edit"] == "success") {
        echo "<script>
            var confirmMsg = 'Change user data success!';
            var confirmed = confirm(confirmMsg);
            if (confirmed) {
                window.location.href = '/me'; // 在确认后执行跳转
            }
        </script>";
        exit();
    } else if ($_GET["error"]) {
        $error_msg = urldecode($_GET["error"]);
        $confirmMsg = json_encode($error_msg);
        echo "<script>
            var confirmMsg = '$confirmMsg';
            var confirmed = confirm(confirmMsg);
            if (confirmed) {
                window.location.href = '/me'; // 在确认后执行跳转
            }
        </script>";
        exit();
    }

    $user_avatar = $_SESSION["avatar"];
    $username = $_SESSION["username"];
    $user_email = $_SESSION["email"];
    $id = $_SESSION["id"];

    @require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header/header.php";
    @require_once $_SERVER['DOCUMENT_ROOT'] . "/db/context.php";
    @require_once $_SERVER['DOCUMENT_ROOT'] . "/components/icons/icons.php";

    @include $_SERVER['DOCUMENT_ROOT'] . "/db/dbConnect.php";

    // 主頁 Header
    $HOME_PAGE_HEADER = new HomePageHeader();
    echo $HOME_PAGE_HEADER->render();

    // Edit Icon
    $icon_props = array(
        "icon" => "edit",
        "className" => "edit-icon"
    );
    $ICON = new Icon($icon_props);

    ?>
    <div class="container">
        <div class="frame">
            <div class="left-section section">
                <div class="user-avatar-conatiner">
                    <img class="user-avatar" src="<?php echo $user_avatar ?>">
                </div>
                <form class="user-info-form" action="/editUser" method="POST">
                    <div class="edit-section">
                        <div class="user-info-row primary">
                            <input name="username" required value="<?php echo $username ?>" class="editable"
                                oninput="checkValue(this)">
                            <?php echo $ICON->render() ?>
                        </div>
                        <div class="user-info-row">
                            <input name="email" required value="<?php echo $user_email ?>" class="editable"
                                oninput="checkValue(this)">
                            <?php echo $ICON->render() ?>
                        </div>
                    </div>
                    <div class="submit-button-container">
                        <input class="submit-button" type="submit" name="editUser" value="SAVE CHANGE">
                    </div>
                </form>

            </div>
            <div class="right-section section">
                <div class="cart-container">
                    <h1>CART</h1>
                    <?php
                    $result = getUserCartIncludeAll($pdo, $id);
                    echo mapCart($result);
                    ?>
                </div>
            </div>
        </div>

    </div>
</body>

</html>