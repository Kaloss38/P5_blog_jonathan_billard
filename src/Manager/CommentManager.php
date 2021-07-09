<?php

    namespace App\Manager;

    use App\Manager\BaseManager;
	use App\Entity\Post;
	use App\Entity\Comment;
	class CommentManager extends BaseManager
	{
		public function __construct()
		{
			parent::__construct("comment", "App\Entity\Comment");	
		}

		public function createComment(Comment $comment, Post $post){
			//Récupérer utilisateur en session une fois que le système d'authentification sera fait
			$sql = "
			INSERT INTO comment(postId, userId, content, creationDate, isValidated, isWaiting, isDisapproved) VALUES(:postId, :userId, :content, :creationDate, :isValidated, :isWaiting, :isDisapproved)";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(':postId', $post->getId());
			$req->bindValue(':userId', 1);
			$req->bindValue(':content', $comment->getContent());
			$req->bindValue(':creationDate', $comment->getCreationDate()->format('Y-m-d H:i:s'));
			$req->bindValue(':isValidated', 0);
			$req->bindValue(':isWaiting', 1);
			$req->bindValue(':isDisapproved', 0);
			
			$req->execute();
		}

		public function getCommentsValidatedFromPost(Post $post)
		{
			$sql = "
			SELECT *, c.content AS commentContent FROM comment c INNER JOIN user u ON u.id = c.userId INNER JOIN post p ON p.id = c.postId WHERE c.postId = :id AND c.isValidated = 1";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(':id', $post->getId());

			$req->execute();
			$req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, "App\Entity\Comment");

			return $req->fetchAll();
		}
		
	}