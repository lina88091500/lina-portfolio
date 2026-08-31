<?php
include_once "db.php";

// 後台登入驗證
if (isset($_POST['acc'])) {
    $acc = $_POST['acc'] ?? '';
    $pw  = $_POST['pw'] ?? '';
    $ok  = false;

    if (!$Admin->connected()) {
        // 展示模式（連不到資料庫）：接受預設示範帳密，讓後台仍可瀏覽
        $ok = ($acc === 'admin' && $pw === '1234');
    } else {
        // 正式模式：以 bcrypt 雜湊比對 admin 資料表
        $admin = $Admin->find(['acc' => $acc]);
        if ($admin) {
            if (password_verify($pw, $admin['pw'])) {
                $ok = true;
            } elseif (hash_equals((string) $admin['pw'], $pw)) {
                // 相容舊資料：資料庫若還存著明碼，驗證成功後自動升級成雜湊
                $ok = true;
                $admin['pw'] = password_hash($pw, PASSWORD_DEFAULT);
                $Admin->save($admin);
            }
        }
    }

    if ($ok) {
        $_SESSION['login'] = 1;
        $_SESSION['acc']   = $acc;
        to("../admin.php");
    } else {
        echo "<script>alert('帳號或密碼錯誤');location.href='../index.php?do=login';</script>";
    }
}
