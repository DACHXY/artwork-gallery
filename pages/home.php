<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Home</title>
</head>

<body>
    <?php
    @include $_SERVER['DOCUMENT_ROOT'] . "components/header/header.php";
    // 使用示例
    $helloWorld = new HomePageHeader();
    echo $helloWorld->render();
    ?>
</body>

</html>