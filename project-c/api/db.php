<?php
session_start();

class DB{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=s1150101";
    protected $pdo;
    protected $table;

    function __construct($table){
        $this->table=$table;
        try {
            $this->pdo=new PDO($this->dsn,'s1150101','s1150101');
        } catch(PDOException $e) {
            $this->pdo=null;
        }
    }

    function all(...$arg){
        if(!$this->pdo) return [];
        $sql="SELECT * FROM $this->table ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                $tmp=$this->a2s($arg[0]);
                $sql .= " WHERE ".join(" AND ",$tmp);
            }else{
                $sql .= $arg[0];
            }
        }

        if(isset($arg[1])){
            $sql .= $arg[1];
        }

        $res=$this->pdo->query($sql);
        return $res ? $res->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    function count(...$arg){
        if(!$this->pdo) return 0;
        $sql="SELECT count(*) FROM $this->table ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                $tmp=$this->a2s($arg[0]);
                $sql .= " WHERE ".join(" AND ",$tmp);
            }else{
                $sql .= $arg[0];
            }
        }

        if(isset($arg[1])){
            $sql .= $arg[1];
        }

        $res=$this->pdo->query($sql);
        return $res ? $res->fetchColumn() : 0;
    }

    function find($arg){
        if(!$this->pdo) return null;
        $sql="SELECT * FROM $this->table ";
        
        if(is_array($arg)){
            $tmp=$this->a2s($arg);
            $sql .= " WHERE ".join(" AND ",$tmp);
        }else{
            $sql .= " WHERE `id`='$arg'";
        }
        
        $res=$this->pdo->query($sql);
        return $res ? $res->fetch(PDO::FETCH_ASSOC) : null;
    }

    function save($arg){
        if(isset($arg['id'])){
            //update

            $tmp=$this->a2s($arg);
            $sql="UPDATE $this->table SET ".join(" , ",$tmp);
            $sql .=" WHERE `id`='{$arg['id']}'";

        }else{
            //insert
            $keys=array_keys($arg);
            $sql="INSERT INTO $this->table (`".join("`,`",$keys)."`) VALUES('".join("','",$arg)."');";
        }
    //echo $sql;
        return $this->pdo->exec($sql);
    }

    function del($arg){
        $sql="DELETE FROM $this->table ";
        
        if(is_array($arg)){
            $tmp=$this->a2s($arg);
            $sql .= " WHERE ".join(" AND ",$tmp);
        }else{
            $sql .= " WHERE `id`='$arg'";
        }
        
        return $this->pdo->exec($sql);

    }

protected function a2s($array){
    $tmp=[];
    foreach($array as $key => $val){
        $tmp[]="`$key`='$val'";
               
    }

    return $tmp;
}

function q($sql){
    return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

}

function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function to($url){
    header("location:$url");
}


$Title=new DB('title');
$Ad=new DB('ad');
$Mvim=new DB('mvim');
$Image=new DB('image');
$News=new DB('news');
$Admin=new DB('admin');
$Menu=new DB('menu');
$Total=new DB('total');
$Bottom=new DB('bottom');


if(!isset($_SESSION['visit'])){
    $_SESSION['visit']=1;
    $visit=$Total->find(1);
    if (!empty($visit)) {
        $visit['total']++;
        $Total->save($visit);
    }
}