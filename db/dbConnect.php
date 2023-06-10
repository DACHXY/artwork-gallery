<?php
$__DBsevername = "410050042-sql,1433";
$__DBMaster = "master";
$__DBname = "ArtworkDB";
$__DBusername = "sa";
$__DBpassword = "MyDefaultPassword...";

// 連線到 master 資料庫
$dsn = "sqlsrv:Server=$__DBsevername;Database=$__DBMaster;TrustServerCertificate=1";

try {
    $pdo = new PDO($dsn, $__DBusername, $__DBpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 檢查 ArtworkDB 是否存在
    $stmt = $pdo->query("SELECT COUNT(*) FROM sys.databases WHERE name = '$__DBname'");
    $count = $stmt->fetchColumn();

    // 如果 ArtworkDB 不存在
    if ($count == 0) {
        try {
            echo "建立資料表";
            // 建立資料庫與資料表
            $sql = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/scripts/ArtworkDB.sql");
            $pdo->exec($sql);

            // 新增資料
            $sql = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/scripts/insert_data.sql");
            $pdo->exec($sql);
        } catch (Exception $e) {
            die("ERROR: " . $e->getMessage());
        }

    }

    $dsn = "sqlsrv:Server=$__DBsevername;Database=$__DBname;TrustServerCertificate=1";
    $pdo = new PDO($dsn, $__DBusername, $__DBpassword);
    echo "Connected to ArtworkDB database.";

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>