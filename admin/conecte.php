<?
$host='localhost'; // Local do Servidor
$user='hexacore_my'; //Nome de usuario do Sql
$password='FK8{rGXzVG'; //Senha do servidor
$database='hexacore_my'; // Base de dados
$dsn = 'mysql:dbname='.$database.';host='.$host.';charset=UTF8';
try {
  $conexao = new PDO($dsn,$user,$password);
} catch (Exception $e) {
  die("Erro ao tentar se conectar");
}
?>
