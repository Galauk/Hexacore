<?php
class DBASE extends PDO {
    public $host = "mysql785.umbler.com";
    public $user = "hexacore";
    public $password = "FK8{rGXzVG";
    public $dbname = "hexacore_site";
    public $dns = "mysql:dbname=". $this->dbname .";host=". $this->host;

    public $conn = null;
    public function __construct(){
        try{
            $conn = new PDO($this->dns, $this->user, $this->password);
        }catch(PDOException $e){
            echo "Falha na conexao:".$e->getMessage();
        }
    }

    public function query($sql){
        return $this->conn->query($sql);
    }

    public function auth($login, $password){
        $n = $this->query("SELECT login, senha FROM admin WHERE login LIKE '".$login."' AND senha LIKE '".$password."'");

        if($n > 0){
            return true;
        }else{
            return false;
        }
    }
}
?>