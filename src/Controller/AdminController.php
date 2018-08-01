<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\TicketType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
     // @Security("has_role('ROLE_ADMIN')")
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    
    /**
     * @Route("/")
     */
    public function getAchatBillet(Request $request){
        $form = $this->createForm(TicketType::class);
                
        $form->handleRequest($request);
        
         if($form->isSubmitted() && $form->isValid()){

            return $this->render('admin/tests.twig', [
                'controller_name' => 'AdminController',

            ]);
             
            
        }
        
            return $this->render('admin/tests.twig', [
                'controller_name' => 'AdminController',
                'form' => $form->createView(),
            ]);
    }
}
