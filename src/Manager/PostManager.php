<?php

    namespace App\Manager;

    use App\Manager\BaseManager;

	class PostManager extends BaseManager
	{
		public function __construct()
		{
			parent::__construct("post","Post");	
		}
	}