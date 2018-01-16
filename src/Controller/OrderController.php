<?php
/**
 * Created by PhpStorm.
 * User: MY
 * Date: 14.01.2018
 * Time: 9:01
 */

namespace App\Controller;


use App\Entity\Order;
use App\Entity\OrderItem;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OrderController extends Controller
{

    /**
     * @Route("/cart/{id}", name="cart")
     */
    public function showCart()
    {
        $order = $this->getDoctrine()->getRepository(Order::class)->findAll();

        return $this->render('orders/show.html.twig', ['order'=>$order]);
    }



}