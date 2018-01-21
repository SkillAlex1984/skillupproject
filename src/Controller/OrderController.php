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
use App\Form\OrderType;
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
     * @Route ("order/remove/{id}", name="delete_order_product")
     *
     */
    public function delProduct (OrderItem $item,
                                Orders $orders, Request $request)
    {
        $orders->deleteItem($item);
        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("order/complete", name="order_complete")
     */
    public function completeOrder(Orders $orders, Request $request,  \Swift_Mailer $mailer)
    {
        $order = $orders->getCurrentOrder();
        $form = $this->createForm(OrderType::class, $order);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->sendEmails($order, $mailer);
            $orders->makeOrder($order);

            return $this->redirectToRoute('order_success');
        }

        return $this->render('orders/completeForm.html.twig',[
            'order' => $order,
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("order/success", name="order_success")
     */
    public function successOrder (Orders $orders)
    {
        return $this->render('orders/success.html.twig', ['order' => $orders->getCurrentOrder()]);
    }

    private function sendEmails (Order $order, \Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Новый заказ на сайте'))
            ->setFrom([getenv('MAILER_FROM')=>getenv('MAILER_FROM_NAME')])
            ->setTo(getenv('ADMIN_EMAIL'))
            ->setBody(
                $this->renderView(
                    'orders/admin_message.html.twig',
                    array('order'=>$order)
                ),
                'text/html'
            );
        $mailer->send($message);

        $message = (new \Swift_Message('Ваш заказ'))
            ->setFrom([getenv('MAILER_FROM')=>getenv('MAILER_FROM_NAME')])
            ->setTo([$order->getEmail() => $order->getCostomerName()])
            ->setBody(
                $this->renderView(
                    'orders/customer_message.html.twig',
                    array('order'=>$order)
                ),
                'text/html'
            );
        $mailer->send($message);
    }

}