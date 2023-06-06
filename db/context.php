<?php

@require_once $_SERVER['DOCUMENT_ROOT'] . "/db/dbConnect.php";

function selectFromDatabase($pdo, $table, $columns = "*", $condition = "", $params = []) {
    try {
        $query = "SELECT $columns FROM $table";

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

function getAllUsers(){
    $results = selectFromDatabase($pdo, "users", "*");
    return $results;
}

function getUserByEmail($email){
    $result = selectFromDatabase($pdo, "users", "*", "email = $email");
    return $result;
}
?>