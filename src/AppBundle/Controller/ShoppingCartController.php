<?php
/**
 * Created by PhpStorm.
 * User: cezary
 * Date: 02.12.16
 * Time: 02:21
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShoppingCartController extends Controller
{
    /**
     *
     * @return \AppBundle\Entity\Products
     *
     * @Route("/shopping-basket",name="shopping_basket")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $items= $em->getRepository('AppBundle:ShoppingCart')->find(1)->getContaintProducts();


        return $this->render('cart/cartIndex.html.twig', array(
            'items' => $items,
        ));
    }

    /**
     *
     * @param int $productId
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/shopping-basket/add/{productId}",name="shopping_basket_add",requirements={"productId":"\d+"})
     */
    public function addToBasketAction($productId)
    {
        $em = $this->getDoctrine()->getManager();
        $productRepository = $em->getRepository('AppBundle:Products');

        if(!$product = $productRepository->find($productId)){
            throw $this->createNotFoundException();
        }

        $basket = $em->getRepository('AppBundle:ShoppingCart')->find(1);

        $basket->addProduct($product);

        $em->persist($basket);
        $em->flush();
        return $this->redirect($this->generateUrl('shopping_basket'));
    }
}