<?php
class DBASE{
    private $host;
    private $user;
    private $password;
    private $database;
    private $dns;
    public $conn;
    public function __construct(){
        $this->host = "mysql857.umbler.com";
        $this->user = "hexacore_my";
        $this->password = "FK8{rGXzVG";
        $this->database = "hexacore_my";
        $this->dsn = 'mysql:dbname='.$this->database.';host='.$this->host;
    }

    private function query($sql){
        try{
            $this->conn = new PDO($this->dns,$this->user,$this->password);
        }catch(PDOException $e){
            $e->getMessage();
        }
        $pdo = $this->conn;
        var_dump($pdo);
        die();
        $select = $pdo->query($sql);
        return $select;
    }

    public function auth($login,$password){
        $sql = "SELECT login, senha FROM admin WHERE login LIKE '$login' AND senha LIKE '$password'";
        $select = $this->query($sql);
		$n = $select->rowCount();

        if($n > 0){
            return true;
        }else{
            return false;
        }
    }
}
?>