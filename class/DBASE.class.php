<?php
class DBASE{
    public $conn = null;
    public function __construct(){
        $host = "mysql857.umbler.com";
        $user = "hexacore_my";
        $password = "FK8{rGXzVG";
        $database = "hexacore_my";
        $dsn = "mysql:host=".$host.";dbname=".$database;
        try{
            $this->conn = new PDO($dns, $user, $password);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function query($sql){
        return $this->conn->query($sql);
    }

    public function auth($login, $password){
        $n = $this->conn->exec("SELECT login, senha FROM admin WHERE login LIKE '$login' AND senha LIKE '$password'");

        if($n > 0){
            return true;
        }else{
            return false;
        }
    }
}
?>