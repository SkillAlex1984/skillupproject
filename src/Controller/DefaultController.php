<?php
/**
 * Created by PhpStorm.
 * User: MY
 * Date: 02.01.2018
 * Time: 22:00
 */

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class DefaultController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function show(SessionInterface $session)
    {
        return $this->render('default/homepage.html.twig');
    }
}