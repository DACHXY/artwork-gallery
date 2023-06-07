<?php
$__DBsevername = "sql-server-2,1433";
$__DBname = "ArtworkDB";
$__DBusername = "sa";
$__DBpassword = "Danny10132024...";

$dsn = "sqlsrv:Server=$__DBsevername;Database=$__DBname;TrustServerCertificate=1";

try {
    $pdo = new PDO($dsn, $__DBusername, $__DBpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>