<?php

namespace App\Controller;

use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/default", name="default2")
     */
    public function index2()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'jemoer',
        ]);
    }
//
//    public function test()
//    {
//        // usually you'll want to make sure the user is authenticated first
//        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
//
//        // returns your User object, or null if the user is not authenticated
//        // use inline documentation to tell your editor your exact User class
//        /** @var \App\Entity\User $user */
//        $user = $this->getUser();
//
//        // Call whatever methods you've added to your User class
//        // For example, if you added a getFirstName() method, you can use that.
//        return new Response('Well hi there '.$user->getFirstName());
//    }
}