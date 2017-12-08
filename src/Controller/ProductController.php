<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * @Route("/product", name="product")
     */
    public function index(EntityManagerInterface $em)
    {
        $product = new Product();
        $product->setName('Notebook')->setPrice(8000.50)->setDescription('Cool notebooke PC');

        $em->persist($product);
        $em->flush();

        return new Response('Product created');
    }

    /**
     * @Route("/product/{id}", name="product_show")
     */
   /* public function show($id)
    {
        $repo = $this->getDoctrine()->getRepository(Product::class);
        $product = $repo->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Product not found');
        }

        return $this->render('product/show.html.twig', ['product'=>$product]);
    }*/


// дальше автоматический вывод. То же что и метод выше
    /**
     * @Route("/product/{id}", name="product_show")
     */
    public function show1(Product $product)
    {
       return $this->render('product/show.html.twig', ['product'=>$product]);
    }

    /**
     * @Route("/product-by-name/{name}", name="product_by_name_show")
     */
    public function showByName($name)
    {
        $repo = $this->getDoctrine()->getRepository(Product::class);
      //  $product = $repo->findOneBy(['name'=>$name]);
        $products = $repo->findBy(['name'=>$name]);

        if (!$products) {
            throw $this->createNotFoundException('Products not found');
        }

        return $this->render('product/show.html.twig', ['products'=>$products]);
    }

    /**
     * @Route("/products/{name}", name="product_list")
     */
    public function listProducts($name='')
    {
        $repo = $this->getDoctrine()->getRepository(Product::class);
        //  $product = $repo->findOneBy(['name'=>$name]);
        $products = $repo->findBy(['name'=>$name], ['price'=>'DESC']);

        if (!$products) {
            throw $this->createNotFoundException('Products not found');
        }

        return $this->render('product/list.html.twig', ['products'=>$products]);
    }

    /**
     * @Route("/product-update/{id}", name="product_update")
     */
    public function update(Product $product, EntityManagerInterface $em)
    {
        $product->setName('Laptop');
        $em->flush();

        return $this->render('product/show.html.twig', ['product'=>$product]);
    }

    /**
     * @Route("/product-delete/{id}", name="product_delete")
     */
    public function delete(Product $product, EntityManagerInterface $em)
    {
        $em->remove($product);
        $em->flush();

        return $this->render('product/show.html.twig', ['product'=>$product]);
    }

    /**
     * @Route("/products-all/{name}", name="product_list")
     */
    public function listProductsAll($name='')
    {
        $repo = $this->getDoctrine()->getRepository(Product::class);

        if ($name) {
            $products = $repo->findBy(['name'=>$name], ['price'=>'DESC']);
        } else {
            $products = $repo->findAll();
        }

        if (!$products){
            throw $this->createNotFoundException('Products not found');
        }
        return $this->render('product/list.html.twig', ['products'=>$products]);
    }
}
