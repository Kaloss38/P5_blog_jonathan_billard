<?php

    namespace App\Manager;

    use App\Manager\BaseManager;

	class PostManager extends BaseManager
	{
		public function __construct($datasource)
		{
			parent::__construct("post","Post",$datasource);	
		}
	}