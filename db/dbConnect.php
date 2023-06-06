<?php
function connectToDatabase($host, $dbname, $username, $password) {
    $dsn = "sqlsrv:Server=$host;Database=$dbname;TrustServerCertificate=1";

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}

$severname = "sql1";
$dbname = "ArtworkDB";
$username = "sa";
$password = "Danny10132024...";
$pdo = connectToDatabase($severname, $dbname, $username, $password);

?>