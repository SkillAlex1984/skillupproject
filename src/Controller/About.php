<?php
/**
 * Created by PhpStorm.
 * User: MY
 * Date: 04.12.2017
 * Time: 21:51
 */

namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class About extends Controller
{
    /**
     *  @Route("/about_web")
     */
    public function view () {

        return $this->render('about_web.html.twig');
    }
}