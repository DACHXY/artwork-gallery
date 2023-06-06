<?php
$request_uri = $_SERVER['REQUEST_URI'];

$routes = array(
    "/" => "pages/home/home.php",
    "/home" => "pages/home/home.php",
    "/gallery" => "pages/gallery/gallery.php",
    "/login" => "pages/login/login.php",
    "/logout" => "controller/logout.php",
    "/me" => "pages/my/my.php",
    "/test" => "dev/test.php",
    "/editUser" => "controller/editUser.php",
    "/add-to-cart" => "controller/addToCart.php",
    "/remove-cart" => "controller/removeCart.php",
    "/deleteUser" => "controller/deleteUser.php"
);

$route = parse_url($request_uri, PHP_URL_PATH);
$query_params = parse_url($request_uri, PHP_URL_QUERY);


// 設定路由
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