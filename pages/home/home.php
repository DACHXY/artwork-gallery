<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="/pages/home/home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    <div class="frame-main">
        <section class="section-main-page">
            <?php
            @require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header/header.php";
            // 主頁 Header
            $HOME_PAGE_HEADER = new HomePageHeader();
            echo $HOME_PAGE_HEADER->render();
            ?>
            <div class="section-main-function">
                <?php
                @require_once $_SERVER['DOCUMENT_ROOT'] . "/components/searchBar/searchBar.php";
                @require_once $_SERVER['DOCUMENT_ROOT'] . "/components/recommendFrame/recommendFrame.php";

                // 主頁搜尋
                $SEARCH_BAR = new SearchBar();
                echo $SEARCH_BAR->render();

                // 推薦名單
                $RECOMMEND = new RecommendFrame();
                echo $RECOMMEND->render();

                ?>
            </div>
            <div class="placeholder">

            </div>
        </section>
        <?php
        @require_once $_SERVER['DOCUMENT_ROOT'] . "/components/hero/hero.php";
        @require_once $_SERVER['DOCUMENT_ROOT'] . "/components/userAvatar/userAvatar.php";

        $HERO = new Hero();
        echo $HERO->render();

        $USER_AVATAR = new UserAvatar();
        echo $USER_AVATAR->render();

        ?>
    </div>
</body>

</html>