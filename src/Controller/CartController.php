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
// this is the payment function
    /**
     * @Route("/spa", name="spa")
     */
    public function order()
    {
        $Order = new Order();
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $user =  $em->getRepository(User::class)->find($user->getId());

        $Order->setUser($user);
        $Order->setSchool($this->session->get('school'));

//        $form = $this->createForm(OrderType::class, $Order);    //please check this again
//        $form->handleRequest($request);

        $em->persist($Order);
        $em->flush();

        return $this->render('order/new.html.twig', [

        ]);
    }
    /**
     * @Route("/check", name="school")
     */
    public function add(School $school){
            $this->session->set('School' , $school);
//kill me pls :C ----
    }

}
