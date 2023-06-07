<?php
@require_once $_SERVER['DOCUMENT_ROOT'] . "/db/context.php";
echo file_exists($_SERVER['DOCUMENT_ROOT'] . "/www/images/avatars/3cf84af5-a76e-468c-ac08-250431cb2d6b.png");
unlink($_SERVER['DOCUMENT_ROOT'] . "/www/images/avatars/3cf84af5-a76e-468c-ac08-250431cb2d6b.png");

// $results = getALLArtist($pdo);
// foreach ($results as $row) {
//     echo $row["name"];
// }

?>