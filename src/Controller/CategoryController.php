<?php
/**
 * Created by PhpStorm.
 * User: MY
 * Date: 05.12.2017
 * Time: 19:33
 */

namespace App\Controller;


use App\Entity\Category;
use App\Service\Catalogue;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Flex\Response;

class CategoryController extends Controller
{
    /**
     * @var Catalogue
     */
    private $catalogue;

    public function __construct(Catalogue $catalogue)
    {
        $this->catalogue = $catalogue;
    }


    /**
     * @Route("/category/{slug}/{page}", name="category_show", requirements={"page": "\d+"})
     *
     *@ParamConverter("slug", options={"mapping":{"slug": "slug"}})
     *
     * @param Category $category
     * @param $page
     * @param $session
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function show (Category $category, $page = 1, SessionInterface $session)
    {
        $session->set('lastVisitCtegory', $category->getSlug());

        return $this->render('category/show.html.twig', ['category'=>$category, 'page'=>$page]
        );
    }

    /**
     * @Route("/message", name = "category_message")
     */
    public function message (SessionInterface $session)
    {
        $this->addFlash('notice', 'Товар добавлен в корзину');
        $lastCategory = $session->get('lastVisitCtegory');

        return $this->redirectToRoute('category_show', ['slug' => $lastCategory]);
    }

    /**
     * @Route("download", name = "category_download")
     */
    public function fileDownload ()
    {
        $response = new \Symfony\Component\HttpFoundation\Response();
        $response->setContent('Test content');

        return$response;
    }

    /**
     * @Route("/category-all", name="category_list")
     */
    public function listCategoryAll()
    {
        $categories = $this->catalogue->getCategories();

        if (!$categories){
            throw $this->createNotFoundException('Category not found');
        }
        return $this->render('category/list.html.twig', ['categories'=>$categories]);
    }
}