<?php

    namespace App\Manager;

    use App\Manager\BaseManager;
	use App\Entity\Post;

	class PostManager extends BaseManager
	{
		public function __construct()
		{
			parent::__construct("post","App\Entity\Post");	
		}

		public function createPost(Post $post, string $pictureLink){
			$sql = "
			INSERT INTO post(user_id, title, header, content, creation_date, thumbnail) VALUES(:user_id, :title, :header, :content, :creation_date, :thumbnail)";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(':user_id', 1);
			$req->bindValue(':title', $post->getTitle());
			$req->bindValue(':header', $post->getHeader());
			$req->bindValue(':content', $post->getContent());
			$req->bindValue(':creation_date', $post->getCreationDate()->format('Y-m-d H:i:s'));
			$req->bindValue(':thumbnail', $pictureLink);
			
			$req->execute();
		}

		public function updatePost(Post $post, string $img)
		{
			$sql = "
			UPDATE post SET user_id=:user_id, title=:title, header=:header, content=:content, creation_date=:creation_date, modification_date=:modification_date, thumbnail=:thumbnail WHERE id=:id";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(':id', $post->getId());
			$req->bindValue(':user_id', 1);
			$req->bindValue(':title', $post->getTitle());
			$req->bindValue(':header', $post->getHeader());
			$req->bindValue(':content', $post->getContent());
			$req->bindValue(':creation_date', $post->getCreationDate()->format('Y-m-d H:i:s'));
			$req->bindValue(':modification_date', $post->getModificationDate()->format('Y-m-d H:i:s'));
			$req->bindValue(':thumbnail', $img);

			$req->execute();
		}

		public function deletePost($id)
		{
			$sql= "
			DELETE FROM post WHERE id = :id";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(":id", $id, \PDO::PARAM_INT);

			$req->execute();
		}
	}