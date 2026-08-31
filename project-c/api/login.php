<?php
include_once "db.php";

// 後台登入驗證：以 bcrypt 雜湊比對 admin 資料表的密碼
if (isset($_POST['acc'])) {
    $acc = $_POST['acc'] ?? '';
    $pw  = $_POST['pw'] ?? '';
    $admin = $Admin->find(['acc' => $acc]);

    $ok = false;
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

    if ($ok) {
        $_SESSION['login'] = 1;
        $_SESSION['acc']   = $admin['acc'];
        to("../admin.php");
    } else {
        echo "<script>alert('帳號或密碼錯誤');location.href='../index.php?do=login';</script>";
    }
}
