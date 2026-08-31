<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$sqlFile = 'db.sql';

if (!file_exists($sqlFile)) {
    die("❌ 找不到 {$sqlFile} 檔案，請確認已上傳至同目錄！");
}

try {
    // 直接建立連線，避開 DB 類別 protected 的限制
    $pdo = new PDO("mysql:host=localhost;charset=utf8;dbname=s1150101", "s1150101", "s1150101");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 讀取 SQL 內容
    $sqlContent = file_get_contents($sqlFile);

    // 過濾可能造成權限衝突的指令
    $sqlContent = preg_replace('/CREATE DATABASE.*?;/i', '', $sqlContent);
    $sqlContent = preg_replace('/USE .*?;/i', '', $sqlContent);

    // 執行匯入
    $pdo->exec($sqlContent);

    echo "<h2 style='color:green;'>🎉 所有資料庫與資料表（含全部帳密及設定）已成功匯入遠端伺服器！</h2>";
    echo "<p><a href='index.php'>點此回到網站首頁</a></p>";

} catch (PDOException $e) {
    echo "<h2 style='color:red;'>❌ 匯入失敗！</h2>";
    echo "<p>錯誤訊息：" . $e->getMessage() . "</p>";
}
?>