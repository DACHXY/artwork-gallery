<?php
$__DBsevername = "410530042-sql,1433";
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
        // 創建 ArtworkDB 資料庫
        $pdo->exec("CREATE DATABASE $__DBname");
        $pdo = null;
        $dsn = "sqlsrv:Server=$__DBsevername;Database=$__DBname;TrustServerCertificate=1";
        $pdo = new PDO($dsn, $__DBusername, $__DBpassword);

        // 建立資料表
        $sql = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/scripts/ArtworkDB.sql");
        $result = $pdo->exec($sql);

        // 新增資料
        $filePath = $_SERVER['DOCUMENT_ROOT'] . "/scripts/insert_data.sql";
        $fileHandle = fopen($filePath, 'r');

        if ($fileHandle) {
            while (($line = fgets($fileHandle)) !== false) {
                // 執行每一行的 SQL 查詢
                $result = $pdo->exec($line);

                if ($result === false) {
                    echo "執行 SQL 查詢時發生錯誤：" . $pdo->errorInfo()[2];
                    break;
                }
            }

            fclose($fileHandle);
        } else {
            echo "無法開啟檔案：" . $filePath;
        }
    }

    $dsn = "sqlsrv:Server=$__DBsevername;Database=$__DBname;TrustServerCertificate=1";
    $pdo = new PDO($dsn, $__DBusername, $__DBpassword);

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>