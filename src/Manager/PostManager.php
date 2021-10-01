<?php

    namespace App\Manager;

    use App\Manager\BaseManager;
	use App\Entity\Post;
	use App\Entity\User;

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

		public function createPost(Post $post, string $pictureLink, User $user, string $slug){
			$sql = "
			INSERT INTO post(author, title, header, content, creationDate, thumbnail, slug) VALUES(:author, :title, :header, :content, :creationDate, :thumbnail, :slug)";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(':author', $user->getPseudo());
			$req->bindValue(':title', $post->getTitle());
			$req->bindValue(':header', $post->getHeader());
			$req->bindValue(':content', $post->getContent());
			$req->bindValue(':creationDate', $post->getCreationDate()->format('Y-m-d H:i:s'));
			$req->bindValue(':thumbnail', $pictureLink);
			$req->bindValue(self::SLUGPARAM, $slug);
			
			$req->execute();
		}

		public function updatePost(Post $post, User $user, string $img)
		{
			$sql = "
			UPDATE post SET author = :author, title = :title, header = :header, content = :content, creationDate=:creationDate, modificationDate = :modificationDate, thumbnail = :thumbnail, slug = :slug WHERE id = :id";
			$req = $this->_bdd->prepare($sql);

			$modificationDateUpdate = new \DateTime("now");

			$req->bindValue(':author', $user->getPseudo());
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