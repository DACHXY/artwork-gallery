<?php
$request_uri = $_SERVER['REQUEST_URI'];

$routes = array(
    "/" => "pages/home.php",
    "/home" => "pages/home.php"
);


// 設定路由
if (isset($routes[$request_uri])) {
    $file = $routes[$request_uri];

    if (file_exists($file)) {
        include $file;
    } else {
        echo "404 Not Found";
    }
} else {
    echo "404 Not Found";
}
?>