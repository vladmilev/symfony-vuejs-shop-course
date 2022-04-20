<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $productList = $em->getRepository(Product::class)->findAll();
        dd($productList);

        return $this->render('main/default/index.html.twig', []);
    }

    /**
     * @Route("/product-add", name="product_add")
     */
    public function productAdd(): Response
    {
        $product = new Product();
        $product->setTitle( "Product-".rand(1,100));
        $product->setDescription("smth");
        $product->setPrice(10);
        $product->setQuantity(1);

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return $this->redirectToRoute("homepage");
    }
}
