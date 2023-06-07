<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" type="text/css" href="/pages/gallery/gallery.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="/scripts/hoverCard.js"></script>
</head>

<body>
    <?php
    session_start();
    @require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header/header.php";
    @require_once $_SERVER['DOCUMENT_ROOT'] . "/components/userAvatar/userAvatar.php";

    $search_condition = "";
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET["keyword"])) {
            $keywords = $_GET["keyword"];
            $search_condition = "artwork_name LIKE '%$keywords%' OR AT.name LIKE '%$keywords%'";
            echo "<h2 class=\"float-item\">Keywords: $keywords</h2>";
        }
        if (isset($_GET["artist"])) {
            $artist_slug = $_GET["artist"];
            $search_condition = "AK.artist_slug = '$artist_slug'";
            echo "<h2 class=\"float-item\">Artist: $artist_slug</h2>";

        }
        if (isset($_GET["artwork"])) {
            $artwork_slug = $_GET["artwork"];
            $search_condition = "AK.slug = '$artwork_slug'";
            echo "<h2 class=\"float-item\">Artwork: $artwork_slug</h2>";
        }
    }

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
            @require_once $_SERVER['DOCUMENT_ROOT'] . "/components/card/card.php";
            @require_once $_SERVER['DOCUMENT_ROOT'] . "/db/context.php";
            @include $_SERVER['DOCUMENT_ROOT'] . "/db/dbConnect.php";

            $user_cart = [];
            if ($_SESSION["logged_in"]) {
                $user_cart = getUserCart($pdo, $_SESSION["id"]);
            }

            $all_artwork_result = getALLArtwork($pdo, $search_condition);
            // 切頁數
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $item_per_page = 46;
            $start_index = ($page - 1) * $item_per_page;
            $endIndex = $start_index + $item_per_page - 1;

            $artworks = array_slice($all_artwork_result, $start_index, $item_per_page);
            if (count($artworks) == 0) {
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            }

            $html = "";
            foreach ($artworks as $artwork) {
                $image_url = $artwork["image"];
                $arwork_title = $artwork["artwork_name"];
                $artist_avatar = $artwork["avatar"];
                $artist_name = $artwork["artist_name"];
                $artwork_href = "/artwork?slug=" . $artwork["artwork_slug"];
                $artwork_price = $artwork["price"];
                $artwork_slug = $artwork["artwork_slug"];

                $card_porps = array(
                    "imageHref" => $image_url,
                    "artworkHref" => $artwork_href,
                    "artworkTitle" => $arwork_title,
                    "artistAvatar" => $artist_avatar,
                    "artistName" => $artist_name,
                    "artworkPrice" => $artwork_price,
                    "artworkSlug" => $artwork_slug,
                    "addedToCart" => in_array($artwork_slug, $user_cart)
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