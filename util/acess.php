<?php
	class acess{
		var $host = "";
		var $user = "";
		var $pass = "";
		var $base = "";
		var $type = "mysql";

		var $con = "";
		function __autoload(){
		}
		private function conecta(){
			$this->con = new PDO($dsn);
		}

		private function desconecta(){
			unset($this);
		}

		public function queryBuilder(){
			$query = "";
			switch ($action) {
				case 'inserir':
					# code...
					break;
			}
			return $query;
		}

		public function inserir($tabela,$dados){
			$this->conecta();
		}

		public function selecionar($tabela,$dados){
			$this->conecta();
		}

		public function atualizar($tabela,$dados){
			$this->conecta();
		}

		public function deletar($tabela,$dados){
			$this->conecta();
		}

		public function fetch(){
			
		}
	}
?>