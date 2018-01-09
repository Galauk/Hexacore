<?php
class DBASE{
    public $host;
    public $user;
    public $password;
    public $database;
    public $dns;
    public $conn;
    public function __construct(){
        $this->host = "mysql857.umbler.com";
        $this->user = "hexacore_my";
        $this->password = "FK8{rGXzVG";
        $this->database = "hexacore_my";
        $this->dsn = "mysql:dbname=".$this->database.";host=".$this->host;
        try{
            $this->conn = new PDO($this->dns, $this->user, $this->password);
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