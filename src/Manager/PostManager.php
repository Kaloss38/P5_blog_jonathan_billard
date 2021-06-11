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

		public function createPost(Post $post, string $pictureLink){
			$sql = "
			INSERT INTO post(user_id,title, header, content, creationDate, thumbnail) VALUES(:user_id, :title, :header, :content, :creationDate, :thumbnail)";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(':user_id', 1);
			$req->bindValue(':title', $post->getTitle());
			$req->bindValue(':header', $post->getHeader());
			$req->bindValue(':content', $post->getContent());
			$req->bindValue(':creationDate', $post->getCreationDate()->format('Y-m-d H:i:s'));
			$req->bindValue(':thumbnail', $pictureLink);
			
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

		public function getPostById($id){
			$sql= "
			SELECT * FROM post WHERE id = :id";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(":id", $id, \PDO::PARAM_INT);

			$req->execute();

			return $req->fetch();
		}
	}