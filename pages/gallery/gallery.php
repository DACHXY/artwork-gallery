<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" type="text/css" href="/pages/gallery/gallery.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    <?php
    session_start();
    @require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header/header.php";
    @require_once $_SERVER['DOCUMENT_ROOT'] . "/components/userAvatar/userAvatar.php";

    // 主頁 Header
    $HEADER = new Header();
    echo $HEADER->render();

    $USER_AVATAR = new UserAvatar();
    echo $USER_AVATAR->render();

    // 更換頁數的 button
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $page_last = $page - 1 == 0 ? 1 : $page - 1;
        $page_next = $page + 1;

        $currentURL = $_SERVER['REQUEST_URI'];
        $queryParams = $_GET;

        // last page
        $queryParams['page'] = $page_last;
        $previous_page_url = strtok($currentURL, '?') . '?' . http_build_query($queryParams);

        // next page
        $queryParams['page'] = $page_next;
        $next_page_url = strtok($currentURL, '?') . '?' . http_build_query($queryParams);

        echo <<<HTML
            <a href="$previous_page_url" id="left-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48"><path d="M400-80 0-480l400-400 56 57-343 343 343 343-56 57Z"/></svg>
            </a>
            <a href="$next_page_url" id="right-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48"><path d="m304-82-56-57 343-343-343-343 56-57 400 400L304-82Z"/></svg>
            </a>
        HTML;
    }

    ?>
    <div class="container">
        <div class="card-frame" id="card-frame">
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            }

            @require_once $_SERVER['DOCUMENT_ROOT'] . "/components/card/card.php";

            $jsonString = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/www/data/Artworks.json');
            $new_array = json_decode($jsonString, true);

            // 切頁數
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $item_per_page = 46;
            $start_index = ($page - 1) * $item_per_page;
            $endIndex = $start_index + $item_per_page - 1;

            $artworks = array_slice($new_array, $start_index, $item_per_page);

            $html = "";
            for ($i = 0; $i < count($artworks); $i++) {
                $artwork = $artworks[$i];
                $image_url = $artwork["images"][0];
                $arwork_title = $artwork["artworkName"];
                $artist_avatar = "https://d7hftxdivxxvm.cloudfront.net?height=45&quality=80&resize_to=fill&src=https%3A%2F%2Fd32dm0rphc51dk.cloudfront.net%2Fw6t9gJj4pPALkRbFnEpngQ%2Flarge.jpg&width=45";
                $artist_name = $artwork["artistName"];

                $card_porps = array(
                    "imageHref" => $image_url,
                    "artworkHref" => "",
                    "artworkTitle" => $arwork_title,
                    "artistAvatar" => $artist_avatar,
                    "artistName" => $artist_name
                );

                $CARD = new Card($card_porps);
                $html .= $CARD->render();
            }

            echo $html;
            ?>
        </div>
        <div class="page-change-container">

        </div>
    </div>
</body>

</html>