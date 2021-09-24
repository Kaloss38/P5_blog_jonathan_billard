<?php

    namespace App\Manager;

    use App\Manager\BaseManager;
	use App\Entity\Post;
	use App\Entity\Comment;
	use App\Entity\User;

	class CommentManager extends BaseManager
	{
		public function __construct()
		{
			parent::__construct("comment", "App\Entity\Comment");	
		}

		public function createComment(Comment $comment, Post $post, int $userId){
			$sql = "
			INSERT INTO comment(postId, userId, content, creationDate, isValidated, isWaiting, isDisapproved) VALUES(:postId, :userId, :content, :creationDate, :isValidated, :isWaiting, :isDisapproved)";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(':postId', $post->getId());
			$req->bindValue(':userId', $userId);
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

		public function getAllValidatedComments()
		{
			$sql = "
			SELECT *, c.id AS commentId, c.content AS commentContent, c.creationDate AS commentCreationDate FROM comment c INNER JOIN user u ON u.id = c.userId INNER JOIN post p ON p.id = c.postId WHERE c.isValidated = 1 ORDER BY c.id DESC";
			$req = $this->_bdd->prepare($sql);

			$req->execute();
			$req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, "App\Entity\Comment");

			return $req->fetchAll();
		}
		
		public function getAllWaitingComments()
		{
			$sql = "
			SELECT *, c.id AS commentId, c.content AS commentContent, c.creationDate AS commentCreationDate FROM comment c INNER JOIN user u ON u.id = c.userId INNER JOIN post p ON p.id = c.postId WHERE c.isWaiting = 1 ORDER BY c.id DESC";
			$req = $this->_bdd->prepare($sql);

			$req->execute();
			$req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, "App\Entity\Comment");

			return $req->fetchAll();
		}

		public function getAllDisapprovedComments()
		{
			$sql = "
			SELECT *, c.id AS commentId, c.content AS commentContent, c.creationDate AS commentCreationDate FROM comment c INNER JOIN user u ON u.id = c.userId INNER JOIN post p ON p.id = c.postId WHERE c.isDisapproved = 1 ORDER BY c.id DESC";
			$req = $this->_bdd->prepare($sql);

			$req->execute();
			$req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, "App\Entity\Comment");

			return $req->fetchAll();
		}

		public function getCommentsValidatedFromUser(User $user)
		{
			$sql = "
			SELECT *, c.content AS commentContent FROM comment c INNER JOIN user u ON u.id = c.userId INNER JOIN post p ON p.id = c.postId WHERE c.userId = :id AND c.isValidated = 1";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(':id', $user->getId());

			$req->execute();
			$req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, "App\Entity\Comment");

			return $req->fetchAll();
		}

		public function validateComment(Comment $comment)
		{
			$sql = "
			UPDATE comment SET isValidated = 1, isWaiting = 0 WHERE id = :id";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(':id', $comment->getId());

			$req->execute();
		}

		public function disapproveComment(Comment $comment)
		{
			$sql = "
			UPDATE comment SET isDisapproved = 1, isWaiting = 0 WHERE id = :id";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(':id', $comment->getId());

			$req->execute();
		}

		public function deleteComment(Comment $comment)
		{
			$sql= "
			DELETE FROM comment WHERE id = :id";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(":id", $comment->getId(), \PDO::PARAM_INT);

			$req->execute();
		}
	}