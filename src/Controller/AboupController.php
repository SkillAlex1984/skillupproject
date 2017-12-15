<?php
/**
 * Created by PhpStorm.
 * User: MY
 * Date: 05.12.2017
 * Time: 20:03
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AboupController extends Controller
{
    /**
     * @Route("/about", name = "about_show")
     */
    public function show(SessionInterface $session)
    {
        $url = $this->generateUrl('category_show', [
            'slug' => 'dvd',
            'param'=>'getparam',
        ], UrlGeneratorInterface::ABSOLUTE_URL);

        return $this->render('about/show.html.twig', [
            'notebooksUrl'=>$url,
            'lastCategory'=>$session->get('lastVisitCtegory'),
        ]);
    }

    /**
     * @Route("to-about")
     */
    public function redirectToShow ()
    {
        return $this->redirectToRoute('about_show');
    }
}