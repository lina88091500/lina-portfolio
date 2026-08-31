<?php
session_start();

/**
 * 極簡資料庫存取類別 (Active Record 風格)
 *
 * 設計重點：
 * 1. 連不到 MySQL 時不會讓整個網站爆掉 —— $pdo 會是 null，
 *    all() / count() / find() 一律回傳空值，交由前台頁面顯示「範例資料」。
 *    （這是為了讓沒有架資料庫的人也能直接打開網站看畫面。）
 * 2. 所有寫進 SQL 的值都經過 PDO::quote() 逃逸，避免 SQL Injection。
 */
class DB
{
    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=s1150101";
    protected $pdo;
    protected $table;

    function __construct($table)
    {
        $this->table = $table;
        try {
            $this->pdo = new PDO($this->dsn, 's1150101', 's1150101');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        } catch (PDOException $e) {
            $this->pdo = null; // 進入「範例資料」展示模式
        }
    }

    function all(...$arg)
    {
        if (!$this->pdo) return [];
        $sql = "SELECT * FROM `$this->table` ";
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $sql .= " WHERE " . join(" AND ", $this->a2s($arg[0]));
            } else {
                $sql .= $arg[0];
            }
        }
        if (isset($arg[1])) {
            $sql .= $arg[1];
        }

        $res = $this->pdo->query($sql);
        return $res ? $res->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    function count(...$arg)
    {
        if (!$this->pdo) return 0;
        $sql = "SELECT count(*) FROM `$this->table` ";
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $sql .= " WHERE " . join(" AND ", $this->a2s($arg[0]));
            } else {
                $sql .= $arg[0];
            }
        }
        if (isset($arg[1])) {
            $sql .= $arg[1];
        }

        $res = $this->pdo->query($sql);
        return $res ? $res->fetchColumn() : 0;
    }

    function find($arg)
    {
        if (!$this->pdo) return null;
        $sql = "SELECT * FROM `$this->table` ";

        if (is_array($arg)) {
            $sql .= " WHERE " . join(" AND ", $this->a2s($arg));
        } else {
            $sql .= " WHERE `id`=" . $this->pdo->quote($arg);
        }

        $res = $this->pdo->query($sql);
        return $res ? $res->fetch(PDO::FETCH_ASSOC) : null;
    }

    function save($arg)
    {
        if (!$this->pdo) return 0;

        if (isset($arg['id'])) {
            // update
            $sql = "UPDATE `$this->table` SET " . join(" , ", $this->a2s($arg));
            $sql .= " WHERE `id`=" . $this->pdo->quote($arg['id']);
        } else {
            // insert
            $keys = array_keys($arg);
            $vals = array_map(fn($v) => $this->pdo->quote($v), array_values($arg));
            $sql = "INSERT INTO `$this->table` (`" . join("`,`", $keys) . "`) VALUES(" . join(",", $vals) . ")";
        }

        return $this->pdo->exec($sql);
    }

    function del($arg)
    {
        if (!$this->pdo) return 0;
        $sql = "DELETE FROM `$this->table` ";

        if (is_array($arg)) {
            $sql .= " WHERE " . join(" AND ", $this->a2s($arg));
        } else {
            $sql .= " WHERE `id`=" . $this->pdo->quote($arg);
        }

        return $this->pdo->exec($sql);
    }

    /** 把 ['key'=>'val'] 轉成安全的 "`key`='val'" 條件字串陣列 */
    protected function a2s($array)
    {
        $tmp = [];
        foreach ($array as $key => $val) {
            $tmp[] = "`$key`=" . $this->pdo->quote($val);
        }
        return $tmp;
    }

    function q($sql)
    {
        if (!$this->pdo) return [];
        $res = $this->pdo->query($sql);
        return $res ? $res->fetchAll(PDO::FETCH_ASSOC) : [];
    }
}

function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function to($url)
{
    header("location:$url");
    exit;
}


$Title  = new DB('title');
$Ad     = new DB('ad');
$Mvim   = new DB('mvim');
$Image  = new DB('image');
$News   = new DB('news');
$Admin  = new DB('admin');
$Menu   = new DB('menu');
$Total  = new DB('total');
$Bottom = new DB('bottom');


// 一個瀏覽階段只計一次訪客數
if (!isset($_SESSION['visit'])) {
    $_SESSION['visit'] = 1;
    $visit = $Total->find(1);
    if (!empty($visit)) {
        $visit['total']++;
        $Total->save($visit);
    }
}
