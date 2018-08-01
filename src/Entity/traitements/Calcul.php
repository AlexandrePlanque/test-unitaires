<?php


namespace App\Entity\traitements;

use App\Entity\Client;
use Doctrine\Common\Persistence\ObjectManager;
/**
 * Description of Calcul
 *
 * @author alexandreplanque
 */
class Calcul {
    
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
    
    public function generate(&$ticket){
        $tarif = $this->getTarif($ticket->getClient());
        
        $majoration = $ticket->getZone()->getMajoration();
        
        $prix = $tarif + ($tarif * $majoration / 100 );
        
        if($this->isAbo($ticket->getClient())){
            $prix = $prix - ($tarif * 20 /100);
        }
        
        $ticket->setPrix($prix);
        
        return $ticket;
        
        
    }
    
    public function getif(ObjectManager $manager, $client){
        if($client->getAge() < 15 ){
            $tarif = $manager->getRepository(Tarif::class)->findBy(array("designation" => "moins de 15ans"));
            return $tarif;
        }
        
        if($client->getIsEtudiant() === true){
            $tarif = $manager->getRepository(Tarif::class)->findBy(array("designation" => "etudiant"));
            return $tarif; 
        }else{
            $tarif = $manager->getRepository(Tarif::class)->findBy(array("designation" => "plein-tarif"));
            return $tarif;
            
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
