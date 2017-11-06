<?
$host='mysql857.umbler.com'; // Local do Servidor
$user='hexacore_my'; //Nome de usuario do Sql
$password='FK8{rGXzVG'; //Senha do servidor
$database='hexacore_my'; // Base de dados
$dsn = 'mysql:dbname='.$database.';host='.$host;
try {
  $conn = new PDO($dsn,$user,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
  echo $e->getMessage();
  die("Erro ao tentar se conectar");
}
?>
