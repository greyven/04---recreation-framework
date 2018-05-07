<?php

require_once('Framework/Model.php');

class Comment extends Model
{
	// Renvoie la liste des commentaires d'un post
	public function getComments($postId)
	{
		$sql = 'SELECT comm_id AS id, comm_date AS date, comm_author AS author, comm_content AS content FROM comments WHERE post_id = ?';
		$comments = $this->executeRequest($sql, array($postId));
		return $comments;
	}

	// Ajoute un commentaire dans la bdd
	public function addComment($author, $content, $postId)
	{
		$sql = 'INSERT INTO comments(comm_date, comm_author, comm_content, post_id) VALUES(NOW(), ?, ?, ?)';
		$this->executeRequest($sql, array($author, $content, $postId));
	}

	// Renvoie le nb total de commentaires
	public function countComments()
	{
		$sql = 'SELECT COUNT(*) AS commentsNb FROM comments';
		$result = $this->executeRequest($sql);
		$row = $result->fetch();
		return $row['commentsNb'];
	}
}