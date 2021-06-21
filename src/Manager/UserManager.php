<?php

    namespace App\Manager;

    use App\Manager\BaseManager;

	class UserManager extends BaseManager
	{
		public function __construct()
		{
			parent::__construct("user", "App\Entity\User");	
		}
	}