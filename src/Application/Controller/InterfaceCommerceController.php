<?php
	namespace Application\Controller;

	use Silex\Application;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response; 
	use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

	class InterfaceCommerceController
	{
	    public function accueilAction(Application $app)
	    {
	    	return $app['twig']->render('commerce/accueil.html.twig');
	    }

	    public function panierAction(Application $app)
	    {
	    	return $app['twig']->render('commerce/panier.html.twig');
	    }

	    public function addItemAction(Application $app, Request $request)
	    {
	    	return new Response($request->get('id'));
	    }
	}
	

?>