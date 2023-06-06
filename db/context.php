<?php

@include $_SERVER['DOCUMENT_ROOT'] . "/db/dbConnect.php";

class TableName
{
    public static $ARTWORK = 'artwork';
    public static $ARTIST = 'artist';
    public static $USER = 'users';
    public static $USER_LIKED_ARTIST = 'user_liked_artist';
    public static $USER_LIKED_ARTWORK = 'user_liked_artwork';
    public static $USER_ORDER = "user_order";
    public static $USER_ORDER_ITEM = "user_order_item";
}


function selectFromDatabase($pdo, $table, $columns = "*", $joinTable = "", $joinCondition = "", $condition = "", $params = [])
{
    try {
        $query = "SELECT $columns FROM $table";

        if (!empty($joinTable) && !empty($joinCondition)) {
            $query .= " JOIN $joinTable ON $joinCondition";
        }

        if (!empty($condition)) {
            $query .= " WHERE $condition";
        }

        $statement = $pdo->prepare($query);
        $statement->execute($params);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error executing SELECT query: " . $e->getMessage());
    }
}

function getAll($pdo, $table)
{
    $results = selectFromDatabase($pdo, $table, "*");
    return $results;
}
function getAllUsers($pdo)
{
    $results = getAll($pdo, TableName::$USER);
    return $results;
}

function getUserByEmail($email, $pdo)
{
    $result = selectFromDatabase($pdo, TableName::$USER, "*", "email = $email");
    return $result;
}

function getALLArtist($pdo)
{
    $results = getAll($pdo, "artist");
    return $results;
}

function getALLArtwork($pdo)
{
    $results = selectFromDatabase(
        $pdo,
        TableName::$ARTWORK . " as AK",
        "AK.slug as artwork_slug , image, artwork_name, avatar, AT.name as artist_name",
        TableName::$ARTIST . " as AT",
        "AK.artist_slug = AT.slug"
    );
    return $results;
}

?>