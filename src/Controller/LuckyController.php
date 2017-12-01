<?php
/**
 * Created by PhpStorm.
 * User: SkillUP student
 * Date: 01.12.2017
 * Time: 22:46
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LuckyController extends Controller
{
    /**
     * @return Response
     *
     *  @Route("/lucky/number")
     */
    public function number() {
        $number = mt_rand (1,100);
        $response = new Response('<html><body>Lucky number: '.$number.'</body></html>');
       // return $response;
        return $this->render('lucky/number.html.twig', array(
            'number' => $number,
        ));
    }
}