<?php

    namespace App\Manager;

    use App\Manager\BaseManager;

	class CommentManager extends BaseManager
	{
		public function __construct()
		{
			parent::__construct("comment", "App\Entity\Comment");	
		}
	}