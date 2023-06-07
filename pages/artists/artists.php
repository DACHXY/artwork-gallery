<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" type="text/css" href="/pages/artists/artists.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="/scripts/hoverCard.js"></script>
</head>

<body>
    <?php
    session_start();
    @require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header/header.php";
    @require_once $_SERVER['DOCUMENT_ROOT'] . "/components/userAvatar/userAvatar.php";
    @require_once $_SERVER['DOCUMENT_ROOT'] . "/db/context.php";
    @include $_SERVER['DOCUMENT_ROOT'] . "/db/dbConnect.php";

    function MapArtist($artists)
    {
        $html = "";
        foreach ($artists as $artist) {
            $artist_href = "/gallery?artist=" . $artist["slug"];
            $artist_avatar = $artist["avatar"];
            $artist_name = $artist["name"];
            $artist_bio = $artist["biography"] == null ? "No biograhpy" : strip_tags($artist["biography"]);

            $html .= <<<HTML
                <div class="container-card">
                    <a class="container-link" href="$artist_href">
                        <div class="flex-row">
                            <img class="artist-avatar" src="$artist_avatar">
                        </div>
                        <div class="artist-info">
                            <span class="artist-name">$artist_name</span>
                            <span> Biograhpy </span>
                            <span class="artist-bio"> $artist_bio </span>
                        </div>
                    </a>
                </div>
            HTML;
        }
        return $html;
    }

    $search_condition = "";
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET["keyword"])) {
            $keywords = $_GET["keyword"];
            $search_condition = "name LIKE '%$keywords%'";
            echo "<h2 class=\"float-item\">Keywords: $keywords</h2>";
        }
        if (isset($_GET["slug"])) {
            $artist_slug = $_GET["slug"];
            $search_condition = "slug LIKE '%$artist_slug%'";
            echo "<h2 class=\"float-item\">Artist: $artist_slug</h2>";
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

    $artists = getALLArtist($pdo, $search_condition);

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $item_per_page = 21;
    $start_index = ($page - 1) * $item_per_page;
    $endIndex = $start_index + $item_per_page - 1;

    $artists = array_slice($artists, $start_index, $item_per_page);

    ?>
    <div class="container">
        <div class="card-frame" id="card-frame">
            <?php
            echo MapArtist($artists);
            ?>
        </div>
        <div class="page-change-container">

        </div>
    </div>
</body>

</html>