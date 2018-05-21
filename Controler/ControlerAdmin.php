<?php

require_once('Controler/ControlerSecured.php');
require_once('Model/Post.php');
require_once('Model/Comment.php');

// Controleur des actions d'administration
class ControlerAdmin extends ControlerSecured
{
	private $post;
	private $comment;

	// Constructeur
	public function __construct()
	{
		$this->post = new Post();
		$this->comment = new Comment();
	}

	public function index()
	{
		$postsNb = $this->post->countPosts();
		$commentsNb = $this->comment->countComments();
		$this->generateView(array('postsNb' => $postsNb, 'commentsNb' => $commentsNb));
	}
}