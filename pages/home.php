<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="pages/home.css">
</head>

<body>
    <?php
    @require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header/header.php";
    // 主頁 Header
    $HOME_PAGE_HEADER = new HomePageHeader();
    echo $HOME_PAGE_HEADER->render();
    ?>
</body>

</html>