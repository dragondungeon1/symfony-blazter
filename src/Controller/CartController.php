<?php

namespace App\Controller;
use App\Entity\Order;
use App\Repository\SchoolRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\School;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{

    private  $session;
    private  $em;
    public function  __construct(SessionInterface $session , EntityManagerInterface $entityManager)
    {
        $this->session = $session;
        $this->em = $entityManager;

    }
    public function session(){
        $this->session->set('session', 'foo' );
        $foo = $this->session->get('session');
        $filters = $this ->session->get('filters',[]);
    }
    /**
     * @Route("/cart", name="cart")
     */
    public function index()
    {
        $this->session();
        $schools = $this->em->getRepository(School::class)->findAll();
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'schools' => $schools,

        ]);

    }

    public function order($schooldID) : \Symfony\Component\HttpFoundation\Response
    {
        $Order = new Order();
        $user = $this->getUser();
        $Order->setUser($user);

        $Order->setUser($user->getId());
        $Order->setSchool($schooldID);

        $em = $this->getDoctrine()->getManager();
        $em->persist($Order);
        $em->flush();

        return $this->render('order/new.html.twig');
    }
}
