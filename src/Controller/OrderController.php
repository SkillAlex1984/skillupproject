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
use App\Entity\Product;
use App\Service\Orders;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller
{

    /**
     * @Route("cart", name="cart")
     */
    public function showCart(Orders $orders)
    {
        return $this->render('orders/show.html.twig',
                                  ['order'=>$orders->getCurrentOrder()]);
    }

    /**
     * @Route("order/add-product/{id}/{count}", name="order_add_product",
     *          requirements={"id": "\d+", "count": "\d+(\.\d+)?"})
     */
    public function addProduct (Product $product, float $count,
                                Orders $orders, Request $request)
    {
        $orders->addProduct($product, $count);

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route ("order/remove-item", name="delete_order_product")
     *
     */
    public function delProduct (OrderItem $item,
                                Orders $orders, Request $request)
    {
        $orders->deleteItem($item);

        return $this->redirect($request->headers->get('referer'));
    }





}