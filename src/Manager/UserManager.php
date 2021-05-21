<?php

    namespace App\Manager;

    use App\Manager\BaseManager;

	class UserManager extends BaseManager
	{
		public function __construct($datasource)
		{
			parent::__construct("user","User",$datasource);	
		}
	}