<?php
class DBASE extends PDO {
    public $host;
    public $user;
    public $password;
    public $dbname;
    public $dial;
    public $conn;

    public function __construct(){
        $this->host = "mysql857.umbler.com";
        $this->user = "hexacore_my";
        $this->password = "FK8{rGXzVG";
        $this->dbname = "hexacore_my";
        $this->dial = "mysql:host=".$this->host.";dbname=".$dbname;
        try{
            $this->conn = new PDO($this->dial, $this->user, $this->password);
        }catch(PDOException $e){
            echo "Falha na conexao:".$e->getMessage();
        }
    }

    public function query($sql){
        return $this->conn->query($sql);
    }

    public function auth($login, $password){
        $res = $this->conn->query("SELECT login, senha FROM admin WHERE login LIKE '".$login."' AND senha LIKE '".$password."'");
        $n = $res->fetchColumn();
        if($n > 0){
            return true;
        }else{
            return false;
        }
    }
}
?>