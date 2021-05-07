<?php
	namespace Core ;
	
	use PDO;

	class BDD extends PDO
	{
		private object $database;
		private static object $instance;
		
		private function __construct($datasource)
		{
			$this->_bdd = new PDO('mysql:dbname=' . $datasource->dbname . ';host=' . $datasource->host,
								  $datasource->user,
								  $datasource->password);
		}

		public static function getInstance($datasource)
		{
			if(empty(self::$instance))
			{
				self::$instance = new BDD($datasource);
			}
			return self::$instance->database;
		}

		public function getDatabase(){
			return $this->database;
		}
		
	}