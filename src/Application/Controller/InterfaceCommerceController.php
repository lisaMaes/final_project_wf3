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
        $products=$app['idiorm.db']->for_table('view_products')->order_by_desc()->limit(6)->find_result_set();
        $topics=$app['idiorm.db']->for_table('view_topics')->order_by_desc()->limit(6)->find_result_set();
        $events=$app['idiorm.db']->for_table('view_events')->order_by_desc()->limit(3)->find_result_set();

        return $app['twig']->render('commerce/accueil.html.twig',[
            'products' => $products,
            'topics' => $topics,       
            'events' => $events
        ]);

    }

    public function panierAction(Application $app)
    {
     return $app['twig']->render('commerce/panier.html.twig');
 }

 public function addItemAction(Application $app, Request $request)
 {
     return new Response($request->get('id'));
 }

 public function categorieAction($category_name,Application $app,$page = 1,$nbPerPage = 2)
 {
    $offset=(($page-1)*$nbPerPage);
    $totalProducts=$app['idiorm.db']->for_table('view_products')->where('category_name', $category_name)->find_result_set();
    $totalProducts=count($totalProducts);
    $products=$app['idiorm.db']->for_table('view_products')->where('category_name', $category_name)->limit($nbPerPage)->offset($offset)->find_result_set();


    return $app['twig']->render('commerce/categorie.html.twig',[
        'totalProducts' => $totalProducts,       
        'products' => $products,
        'page' => $page,       
        'nbPerPage' => $nbPerPage
    ]);
}


public function categoriePageAction($category_name,Application $app,$page = 1,$nbPerPage = 2)
{
    $offset=(($page-1)*$nbPerPage);
    $totalProducts=$app['idiorm.db']->for_table('view_products')->where('category_name', $category_name)->find_result_set();
    $totalProducts=count($totalProducts);
    $products=$app['idiorm.db']->for_table('view_products')->where('category_name', $category_name)->limit($nbPerPage)->offset( $offset)->find_result_set();


    return $app['twig']->render('commerce/categorie.html.twig',[
        'totalProducts' => $totalProducts,       
        'products' => $products,
        'page' => $page,       
        'nbPerPage' => $nbPerPage
    ]);
}




public function articleAction($category_name,$slugproduct,$ID_product,Application $app)
{
        #format index.php/business/une-formation-innovante-a-lyon_87943512.html
    $product = $app['idiorm.db']->for_table('view_products')->find_one($ID_product);
    $suggests = $app['idiorm.db']->for_table('view_products')->raw_query('SELECT * FROM view_products WHERE ID_category=' . $product->ID_category . ' AND ID_product<>' . $ID_product . ' ORDER BY RAND() LIMIT 3 ')->find_result_set();       

    return $app['twig']->render('commerce/article.html.twig',[
        'product' => $product,
        'suggests' => $suggests
    ]);

}



    #génération du menu dans le layout
public function menu($active, Application $app)
{
    $categories = $app['idiorm.db']->for_table('category')->find_result_set();
    return $app['twig']->render('menu.html.twig',[
        'active' => $active,
        'categories' => $categories
    ]);
}



}


?>