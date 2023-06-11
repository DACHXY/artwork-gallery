<?php
$__DBsevername = "410530042-sql,1433";
$__DBMaster = "master";
$__DBname = "ArtworkDB";
$__DBusername = "sa";
$__DBpassword = "MyDefaultPassword...";

// 連線到 master 資料庫
$dsn = "sqlsrv:Server=$__DBsevername;Database=$__DBname;TrustServerCertificate=1";

try {
    $command = "python3 " . $_SERVER['DOCUMENT_ROOT'] . "/scripts/insert_db.py";
    exec($command, $output);

    $pdo = new PDO($dsn, $__DBusername, $__DBpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>