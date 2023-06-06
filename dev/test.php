<?php
@require_once $_SERVER['DOCUMENT_ROOT'] . "/db/context.php";

$results = getALLArtist($pdo);
foreach ($results as $row) {
    echo $row["name"];
}

?>