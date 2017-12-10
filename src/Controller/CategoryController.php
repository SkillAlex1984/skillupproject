<?php
/**
 * Created by PhpStorm.
 * User: MY
 * Date: 05.12.2017
 * Time: 19:33
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Flex\Response;

class CategoryController extends Controller
{
    /**
     * @Route("/category/{slug}/{page}", name="category_show", requirements={"page": "\d+"})
     *
     * @param $slug
     * @param $page
     * @param $session
     *
     * @return \Symfony\Component\HttpFoundation\Response|Response
     *
     */
    public function show ($slug, $page = 1, SessionInterface $session, Request $request)
    {
        $session->set('lastVisitCtegory', $slug);
        $param = $request->query->get('param');

        return $this->render('category/show.html.twig', ['slug'=>$slug, 'page'=>$page, 'param'=>$param]
        );
    }

    /**
     * @Route("/message", name = "category_message")
     */
    public function message (SessionInterface $session)
    {
        $this->addFlash('notice', 'You message');
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

}