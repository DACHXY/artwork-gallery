<?php

class TableName
{
    public static $ARTWORK = 'artwork';
    public static $ARTIST = 'artist';
    public static $USER = 'users';
    public static $USER_LIKED_ARTIST = 'user_liked_artist';
    public static $USER_LIKED_ARTWORK = 'user_liked_artwork';
    public static $USER_ORDER = "user_order";
    public static $USER_ORDER_ITEM = "user_order_item";
    public static $USER_CART_ITEM = "user_cart_item";
}

function selectFromDatabase($pdo, $table, $columns = "*", $joinTable = "", $joinCondition = "", $condition = "", $params = [], $randomLimit = null)
{
    try {
        $query = "SELECT $columns FROM $table";

        if (!empty($joinTable) && !empty($joinCondition)) {
            $query .= " JOIN $joinTable ON $joinCondition";
        }

        if (!empty($condition)) {
            $query .= " WHERE $condition";
        }

        if ($randomLimit !== null) {
            if (is_numeric($randomLimit) && $randomLimit > 0) {
                $query .= " ORDER BY NEWID()";
                $query .= " OFFSET 0 ROWS FETCH NEXT $randomLimit ROWS ONLY";
            } else {
                throw new Exception("Invalid randomLimit value. Expected a positive numeric value.");
            }
        }
        $statement = $pdo->prepare($query);
        $statement->execute($params);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error executing SELECT query: " . $e->getMessage());
    }
}

function updateData($pdo, $table, $data, $condition)
{
    $sets = [];
    foreach ($data as $column => $value) {
        $sets[] = "$column = :$column";
    }
    $setClause = implode(', ', $sets);

    $query = "UPDATE $table SET $setClause WHERE $condition";

    try {
        $statement = $pdo->prepare($query);
        foreach ($data as $column => $value) {
            $statement->bindValue(":$column", $value);
        }
        $statement->execute();
        echo $statement->queryString;
        return $statement->rowCount();
    } catch (PDOException $e) {
        die("Error executing UPDATE query: " . $e->getMessage());
    }
}

function insertData($pdo, $table, $data)
{
    $columns = implode(', ', array_keys($data));
    $placeholders = ':' . implode(', :', array_keys($data));

    $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";

    try {
        $statement = $pdo->prepare($query);

        // 将数据绑定到参数
        foreach ($data as $column => $value) {
            if (strpos($value, 'SQL:') === 0) {
                $function = substr($value, 4);
                $statement->bindValue(":$column", null, PDO::PARAM_STR);
                $statement->bindParam(":$column", $function, PDO::PARAM_STR);
            } else {
                $statement->bindValue(":$column", $value);
            }
        }
        $statement->execute();

        return $statement->rowCount();
    } catch (PDOException $e) {
        die("Error executing INSERT query: " . $e->getMessage());
    }
}

function deleteData($pdo, $table, $condition, $params = [])
{
    $query = "DELETE FROM $table WHERE $condition";

    try {
        $statement = $pdo->prepare($query);
        $statement->execute($params);

        return $statement->rowCount();
    } catch (PDOException $e) {
        die("Error executing DELETE query: " . $e->getMessage());
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

function getUserByEmail($pdo, $email)
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
        "AK.slug as artwork_slug , image, artwork_name, avatar, AT.name as artist_name, price",
        TableName::$ARTIST . " as AT",
        "AK.artist_slug = AT.slug"
    );
    return $results;
}

function getRadArtwork($pdo, $number)
{
    $results = selectFromDatabase(
        $pdo,
        TableName::$ARTWORK . " as AK",
        "AK.slug as artwork_slug , AK.artist_slug, image, artwork_name, avatar, AT.name as artist_name, medium, material",
        TableName::$ARTIST . " as AT",
        "AK.artist_slug = AT.slug",
        "",
        [],
        $number
    );
    return $results;
}

function getRadArtist($pdo, $number)
{
    $results = selectFromDatabase(
        $pdo,
        TableName::$ARTIST,
        "*",
        "",
        "",
        "",
        [],
        $number
    );
    return $results;
}

function addUser($pdo, $user)
{
    $result = insertData($pdo, TableName::$USER, $user);
    return $result;
}

function deleteUser($pdo, $id)
{
    $result = deleteData($pdo, TableName::$USER, "id = :id", $id);
    return $result;
}

function updateUser($pdo, $user, $id)
{
    echo $id;
    $result = updateData($pdo, TableName::$USER, $user, "id = CONVERT(uniqueidentifier, '$id')");
    return $result;
}

function getUserCart($pdo, $id)
{
    $result = selectFromDatabase(
        $pdo,
        TableName::$USER_CART_ITEM,
        "artwork_slug",
        "",
        "",
        "user_id = :id",
        [$id],
    );
    return array_column($result, "artwork_slug");
}

function getUserCartIncludeAll($pdo, $id)
{
    $result = selectFromDatabase(
        $pdo,
        TableName::$USER_CART_ITEM . " as CART",
        "*",
        TableName::$ARTWORK . " as AK",
        "AK.slug = CART.artwork_slug",
        "user_id = :id",
        [$id],
    );
    return $result;
}

function addToUserCart($pdo, $artwork_slug, $id)
{
    $data = [
        "user_id" => $id,
        "artwork_slug" => $artwork_slug
    ];
    $result = insertData($pdo, TableName::$USER_CART_ITEM, $data);
    return $result;
}

function removeUserCart($pdo, $artwork_slug, $id)
{
    $result = deleteData($pdo, TableName::$USER_CART_ITEM, "user_id = '$id' AND artwork_slug = '$artwork_slug'");
    return $result;
}

?>