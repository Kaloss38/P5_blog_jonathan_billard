<?php

    namespace App\Manager;

    use App\Manager\BaseManager;

	class CommentManager extends BaseManager
	{
		public function __construct($datasource)
		{
			parent::__construct("comment","Comment",$datasource);	
		}
	}