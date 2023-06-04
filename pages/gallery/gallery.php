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
    @require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header/header.php";
    // 主頁 Header
    $HEADER = new Header();
    echo $HEADER->render();
    ?>
    <div class="container">
        <div class="card-frame">
            <?php
            @require_once $_SERVER['DOCUMENT_ROOT'] . "/components/card/card.php";

            $jsonString = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/www/data/Artworks.json');
            $new_array = json_decode($jsonString, true);
            $artworks = array_slice($new_array, 0, 50);

            $html = "";
            for ($i = 0; $i < count($artworks); $i++) {
                $artwork = $artworks[$i];
                $image_url = $artwork["images"][0];
                $arwork_title = $artwork["artworkName"];
                $card_porps = array(
                    "imageHref" => $image_url,
                    "artworkHref" => "",
                    "artworkTitle" => $arwork_title
                );

                $CARD = new Card($card_porps);
                $html .= $CARD->render();
            }

            echo $html;
            ?>
        </div>
    </div>
</body>

</html>