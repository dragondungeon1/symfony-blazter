<?php

namespace App\Controller;
use App\Entity\Order;
use App\Entity\User;
use App\Form\OrderType;
use App\Repository\SchoolRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\School;
use Doctrine\ORM\Mapping\Id;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/drum/{id}", name="drum")
     * @param School $school
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function add(School $school){
        $this->session->set('school' , $school->getId());
        $schools[] = $school;
        return $this->render('order/jmr.html.twig' , [
            'schools' => $schools,
        ]);

    }

// this is the payment function
    /**
     * @Route("/spa", name="spa")
     */
    public function order()
    {
//        dd($this->session->get('School'));
        $Order = new Order();
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $user =  $em->getRepository(User::class)->find($user->getId());
        $school =  $em->getRepository(School::class)->find($this->session->get('school'));

        $Order->setUser($user);
//        $Order->setSchool($this->session->get('school'));
        $Order->setSchool($school);

//        $form = $this->createForm(OrderType::class, $Order);    //please check this again
//        $form->handleRequest($request);
        $em->persist($Order);
        $em->flush();

        return $this->render('order/spa.html.twig', [
            'order' => $Order
        ]);
    }

}
