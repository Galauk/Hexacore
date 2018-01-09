<?php
class DBASE{
    public $conn = null;
    public function __construct(){
        $host = "mysql785.umbler.com";
        $user = "hexacore";
        $password = "FK8{rGXzVG";
        $dbname = "hexacore_site";
        $dsn = "mysql:dbname=".$dbname.";host=".$host;
        try{
            $this->conn = new PDO($dns, $user, $password);
        }catch(PDOException $e){
            echo "Falha na conexao:".$e->getMessage();
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