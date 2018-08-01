<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Client;

class CalculController extends AbstractController
{
    /**
     * @Route("/calcul", name="calcul")
     */
    public function index()
    {
        return $this->render('calcul/index.html.twig', [
            'controller_name' => 'CalculController',
        ]);
    }
    
    public function lambada($ticket){
        if($this->isChildren($ticket->getClient()) || $ticket->getClient()->getIsStudent()){
            $ticket->setPrix($ticket->getTarif()->getPrix());
            return $ticket;
        }
        
        $base = $ticket->getTarif()->getPrix();
        $prix = $base + ($base * $ticket->getZone()->getMajoration() / 100);
        if($ticket->getClient()->getAbonnement() !== null){
            $prix = $prix - ($base * $ticket->getClient()->getAbonnement()->getReduction() / 100);
        }
        $ticket->setPrix($prix);
        return $ticket;
    }
    
    public function isChildren(Client $client): bool{
        if($client->getAge()->getTimestamp() > time() - 60 * 60 * 24 * 365 * 15){
            return true;
        }else{
            return false;
        }
    }

    public function isAbo($client){
        if($client->getAbonnement() !== null){
            return true;
        }else{
            return false;
        }
    }
}
