<?php
$request_uri = $_SERVER['REQUEST_URI'];


// 設定路由
$routes = array(
    "/" => "pages/home/home.php",
    "/home" => "pages/home/home.php",
    "/gallery" => "pages/gallery/gallery.php",
    "/login" => "pages/login/login.php",
    "/logout" => "controller/logout.php",
    "/me" => "pages/my/my.php",
    "/dev" => "dev/info.php",
    "/editUser" => "controller/editUser.php",
    "/add-to-cart" => "controller/addToCart.php",
    "/remove-cart" => "controller/removeCart.php",
    "/deleteUser" => "controller/deleteUser.php",
    "/submit-cart" => "controller/addToOrder.php",
    "/artist" => "pages/artists/artists.php",
    "/upload-avatar" => "controller/changeAvatar.php"
);

$route = parse_url($request_uri, PHP_URL_PATH);
$query_params = parse_url($request_uri, PHP_URL_QUERY);


if (isset($routes[$route])) {
    $file = $routes[$route];

    if (file_exists($file)) {

        include $file;
    } else {
        echo "404 Not Found";
    }
} else {
    echo "404 Not Found";
}

if ($query_params) {
    parse_str($query_params, $params);
    include $file . '?' . http_build_query($params);
}
?>