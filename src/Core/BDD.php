<?php
	namespace Core ;
	
	use PDO;

	class BDD extends PDO
	{
		private $database;
		private static $instance;
		
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
			return self::$instance->_bdd;
		}

		public function getDatabase(){
			return $this->database;
		}
		
	}