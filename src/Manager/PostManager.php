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

		private const SLUGPARAM = ":slug";

		public function getBySlug(string $slug)
		{
			$sql = "
			SELECT * FROM post WHERE slug = :slug";
			$req = $this->_bdd->prepare($sql);
			$req->bindValue(self::SLUGPARAM, $slug);
			$req->execute();	
			$req->setFetchMode(\PDO::FETCH_CLASS, "App\Entity\Post");
			return $req->fetch();
		
		}

		public function createPost(Post $post, string $pictureLink, int $userId, string $slug){
			$sql = "
			INSERT INTO post(userId, title, header, content, creationDate, thumbnail, slug) VALUES(:userId, :title, :header, :content, :creationDate, :thumbnail, :slug)";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(':userId', $userId);
			$req->bindValue(':title', $post->getTitle());
			$req->bindValue(':header', $post->getHeader());
			$req->bindValue(':content', $post->getContent());
			$req->bindValue(':creationDate', $post->getCreationDate()->format('Y-m-d H:i:s'));
			$req->bindValue(':thumbnail', $pictureLink);
			$req->bindValue(self::SLUGPARAM, $slug);
			
			$req->execute();
		}

		public function updatePost(Post $post, string $img)
		{
			$sql = "
			UPDATE post SET userId = :userId, title = :title, header = :header, content = :content, creationDate=:creationDate, modificationDate = :modificationDate, thumbnail = :thumbnail, slug = :slug WHERE id = :id";
			$req = $this->_bdd->prepare($sql);

			$modificationDateUpdate = new \DateTime("now");

			$req->bindValue(':userId', 1);
			$req->bindValue(':title', $post->getTitle());
			$req->bindValue(':header', $post->getHeader());
			$req->bindValue(':content', $post->getContent());
			$req->bindValue(':creationDate', $post->getCreationDate()->format('Y-m-d H:i:s'));
			$req->bindValue(':modificationDate', $modificationDateUpdate->format('Y-m-d H:i:s'));
			$req->bindValue(':thumbnail', $img);
			$req->bindValue(':id', $post->getId());
			$req->bindValue(self::SLUGPARAM, $post->getSlug());

			$req->execute();
		}

		public function deletePost($slug)
		{
			$sql= "
			DELETE FROM post WHERE slug = :slug";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(self::SLUGPARAM, $slug);

			$req->execute();
		}
	}