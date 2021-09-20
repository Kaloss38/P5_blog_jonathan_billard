<?php

    namespace App\Manager;

use App\Entity\User;
use App\Manager\BaseManager;

	class UserManager extends BaseManager
	{

		private const USERENTITY = "App\Entity\User";
		private const EMAILPARAM = ":email";
		private const TOKENPARAM = ":token";

		public function __construct()
		{
			parent::__construct("user", self::USERENTITY);	
		}

		public function getUsersFromEmail(User $user)
		{
			$sql = "
			SELECT * FROM user WHERE email = :email";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(self::EMAILPARAM, $user->getEmail());

			$req->execute();
			$req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::USERENTITY);

			return $req->fetchAll();
		}

		public function getUserFromEmail(string $email)
		{
			$sql = "
			SELECT * FROM user WHERE email = :email";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(self::EMAILPARAM, $email);

			$req->execute();
			$req->setFetchMode(\PDO::FETCH_CLASS, self::USERENTITY);

			return $req->fetch();
		}

		public function getUserByToken(string $token)
		{
			$sql = "
			SELECT * FROM user WHERE token = :token";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(self::TOKENPARAM, $token);

			$req->execute();
			$req->setFetchMode(\PDO::FETCH_CLASS, self::USERENTITY);

			return $req->fetch();
		}

		public function updateUserToken(User $user, string $token)
		{
			$sql = "
			UPDATE user SET token = :token WHERE email = :email";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(self::TOKENPARAM, $token);
			$req->bindValue(self::EMAILPARAM, $user->getEmail());

			$req->execute();	
		}

		public function getUserByPseudo(User $user)
		{
			$sql = "
			SELECT * FROM user WHERE pseudo = :pseudo";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(':pseudo', $user->getPseudo());

			$req->execute();
			$req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::USERENTITY);

			return $req->fetch();
		}

		public function searchUserByPseudo(string $pseudo)
		{
			$sql = "
			SELECT * FROM user WHERE pseudo = :pseudo";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(':pseudo', $pseudo);

			$req->execute();
			$req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::USERENTITY);

			return $req->fetch();
		}

		public function createUser(User $user, string $token)
		{
			$sql = "
			INSERT INTO user(pseudo, firstname, lastname, email, isActive, isAdmin, password, token) VALUES(:pseudo, :firstname, :lastname, :email, :isActive, :isAdmin, :password, :token)";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(':pseudo', $user->getPseudo());
			$req->bindValue(':firstname', $user->getFirstname());
			$req->bindValue(':lastname', $user->getLastname());
			$req->bindValue(self::EMAILPARAM, $user->getEmail());
			$req->bindValue(':isActive', 0);
			$req->bindValue(':isAdmin', 0);
			$req->bindValue(':password', password_hash($user->getPassword(), PASSWORD_BCRYPT));
			$req->bindValue(self::TOKENPARAM, $token);
			
			$req->execute();
		}

		public function validateUser(User $user, $newToken)
		{
			$sql = "
			UPDATE user SET isActive = :isActive, token = :token WHERE email = :email";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(':isActive', 1);
			$req->bindValue(self::TOKENPARAM, $newToken);
			$req->bindValue(self::EMAILPARAM, $user->getEmail());

			$req->execute();	
		}
		
		public function updatePassword(string $password, string $token)
		{
			$sql = "
			UPDATE user SET password = :password WHERE token = :token";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));
			$req->bindValue(self::TOKENPARAM, $token);

			$req->execute();		
		}

		public function updatePseudo(string $pseudo, string $newPseudo)
		{
			$sql = "
			UPDATE user SET pseudo = :newPseudo WHERE pseudo = :pseudo";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(':newPseudo', $newPseudo);
			$req->bindValue(':pseudo', $pseudo);
			$req->execute();	
		}

		public function UserUpdatePassword(string $newPassword, string $pseudo )
		{
			$sql = "
			UPDATE user SET password = :newPassword WHERE pseudo = :pseudo";
			$req = $this->_bdd->prepare($sql);

			$req->bindValue(':newPassword', password_hash($newPassword, PASSWORD_BCRYPT));
			$req->bindValue(':pseudo', $pseudo);
			$req->execute();	
		}
	}