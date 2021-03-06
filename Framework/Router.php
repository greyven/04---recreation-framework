<?php

namespace App\Framework;

class Router
{

	// Route une requete entrante: execute l'action associée
	public function routeRequest()
	{
		try
		{
			// Fusion des parametres GET et POST de la requete
			$request  = new Request(array_merge($_GET, $_POST));

			$controler = $this->createControler($request);
			$action = $this->createAction($request);

			$controler->executeAction($action);
		}
		catch(\Exception $e)
		{ $this->manageError($e); }
	}

	// Créer le controleur approprié en fonction de la requete reçue
	private function createControler(Request $request)
	{
		$controler = "Home"; // Controler par defaut
		if($request->existParameter('controler'))
		{
			$controler = $request->getParameter('controler');
			// Premiere lettre en majuscule
			$controler = ucfirst(strtolower($controler));
		}

		// Création du nom du fichier du controler
		$controlerClass = "App\Controler\Controler".$controler;
		if(class_exists($controlerClass,1)){
			$controler = new $controlerClass();
			$controler->setRequest($request);
			return $controler;
		} else{
			throw new \Exception("Page introuvable");
		}
	}

	// Détermine l'action à executer en fonction de la requete reçue
	private function createAction(Request $request)
	{
		$action = "index"; // Action par defaut
		if($request->existParameter('action')) $action = $request->getParameter('action');
		return $action;
	}

	// Gérer erreur d'execution
	private function manageError(\Exception $exception)
	{
		$view = new View("error");
		$view->generate(array('errorMsg' => $exception->getMessage()));
	}
}