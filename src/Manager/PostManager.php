<?php

    namespace App\Manager;

    use App\Manager\BaseManager;
	use App\Entity\Post;

	class PostManager extends BaseManager
	{
		public function __construct()
		{
			parent::__construct("post","Post");	
		}

		public function createPost(Post $post){
			$sql = "
			INSERT INTO post(user_id,title, header, content, creation_date, modification_date, thumbnail) VALUES(:user_id, :title, :header, :content, :creation_date, :modification_date, :thumbnail)";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(':title', $post->getTitle());
			$req->bindValue(':header', $post->getHeader());
			$req->bindValue(':content', $post->getContent());
			$req->bindValue(':creation_date', $post->getCreationDate()->format('Y-m-d H:i:s'));
			$req->bindValue(':modification_date', $post->getModificationDate()->format('Y-m-d H:i:s'));
			$req->bindValue(':thumbnail', $post->getThumbnail());
			$req->bindValue(':user_id', 1);

			$req->execute();
		}
	}