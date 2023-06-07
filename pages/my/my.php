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
        $icon_props = array(
            "icon" => "remove-cart",
            "className" => "remove-cart-icon"
        );
        $ICON = new Icon($icon_props);

        $html = "";
        foreach ($array as $value) {
            $src = $value["image"];
            $artwork_slug = $value["artwork_slug"];
            $artwork_name = $value["artwork_name"];
            $artwork_price = number_format($value["price"], 2);
            $html .= <<<HTML
                <tr>
                    <td>
                        <img class="artwork-preview" src="$src">
                    </td>
                    <td>
                        $artwork_name 
                    </td>
                    <td>
                        $$artwork_price 
                    </td>
                    <td>
                        <a class="remove-cart" href="/remove-cart?artwork_slug=$artwork_slug">
                            {$ICON->render()}
                        </a>
                    </td>
                </tr>
            HTML;
        }
        return $html;
    }

    function mapOrder($array)
    {
        $html = "";
        foreach ($array as $value) {
            $order_id = $value["order_id"];
            $order_date = $value["create_at"];
            $total_price = number_format($value["total_price"], 2);
            $html .= <<<HTML
                <tr>
                    <td>
                        $order_id
                    </td>
                    <td>
                        $$total_price
                    </td>
                    <td>
                        $order_date 
                    </td>
                </tr>
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
                    <form action="/upload-avatar" enctype="multipart/form-data" method="POST">
                        <input id="icon-avatar-uploader" class="none" type="file" name="image"
                            onchange="updateImagePreview(event, 'avatar-preview')" />
                        <div class="upload-button">
                            <input id="submit-avatar-button" type="submit" value="">
                            <svg class="upload-icon" xmlns="http://www.w3.org/2000/svg" height="48"
                                viewBox="0 -960 960 960" width="48">
                                <path
                                    d="M220-160q-24 0-42-18t-18-42v-143h60v143h520v-143h60v143q0 24-18 42t-42 18H220Zm230-153v-371L330-564l-43-43 193-193 193 193-43 43-120-120v371h-60Z" />
                            </svg>
                        </div>
                    </form>
                    <img id="avatar-preview" onclick="Click('icon-avatar-uploader')" class="user-avatar"
                        src="<?php echo $user_avatar ?>">
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
                    $total_prices = number_format(array_sum(array_column($result, "price")), 2);
                    $cart_html = mapCart($result);

                    if ($result) {
                        echo <<<HTML
                            <table class="cart-table">
                                <thead>
                                    <tr>
                                        <th>Preview</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    $cart_html
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="total-price">Total Price:
                                            $$total_prices
                                        </td>
                                        <td></td>
                                    <tr>
                                </tfoot>
                            </table>
                            <div class="flex-container-row">
                                <div class="submit-button-container">
                                    <a href="/submit-cart" class="submit-button">
                                        Submit
                                    </a>
                                </div>
                            </div>
                        HTML;
                    } else {
                        echo "<div class=\"empty-frame\">Empty</div>";
                    }
                    ?>
                </div>
                <div class="order-container">
                    <h1>ORDERS</h1>
                    <?php
                    $result = getUserOrders($pdo, $id);
                    $order_html = mapOrder($result);

                    if ($result) {
                        echo <<<HTML
                            <table class="order-table">
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Total Price</th>
                                        <th>Order Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    $order_html
                                </tbody>
                            </table>
                        HTML;
                    } else {
                        echo "<div class=\"empty-frame\">Empty</div>";
                    }

                    ?>

                </div>
            </div>

        </div>
</body>

</html>