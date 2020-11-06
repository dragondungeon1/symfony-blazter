<?php

namespace App\Controller;

use App\Entity\School;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ViewCartController extends AbstractController
{
    public function __construct(SessionInterface $session , EntityManagerInterface $entityManager){
        $this->session = $session;
        $this->em = $entityManager;
    }

    public function session(){
        $this->get('session');
    }

    /**
     * @Route("/view/cart", name="view_cart")
     */
    public function index()
    {
        $this->session();
        $schools = $this->em->getRepository(School::class)->findAll();
        return $this->render('view_cart/index.html.twig', [
            'controller_name' => 'ViewCartController',
            'schools' => $schools,
        ]);
    }


    public function getSchool($schools, $session)
    {
        $schoolDetails = $this->getSchool($schools, $session);
        while ($schools = $session->fetch($session)) {
            return $schoolDetails;
        }
    }
}
