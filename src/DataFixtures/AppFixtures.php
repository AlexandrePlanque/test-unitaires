<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Zone;
use App\Entity\Tarif;
use App\Entity\Stade;
use App\Entity\Client;
use App\Entity\Billeterie;
use App\Entity\Abonnement;
use App\Entity\Ticket;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->generateStade($manager);
        $this->generateZone($manager);
        $this->generateTarif($manager);
        $this->generateBilleterie($manager);
        $this->generateAbonnement($manager);
        $this->generateClient($manager);
        
    }
    
    
    
    
    public function generateStade($em){
        $stade = new Stade();
        $stade->setNom("NimeStadium");
        $stade->setNbPlaces(5000);
        $em->persist($stade);
        $em->flush();
        $stade2 = new Stade();
        $stade2->setNom("MontpellierStadium");
        $stade2->setNbPlaces(5000);
        $em->persist($stade2);
        $em->flush();
    }
        
    public function generateZone($em){
        for($j= 1; $j<= 2; $j++){
        $majo = 20;
        for($i = 1; $i<6; $i++){
        $zone = new Zone();
        $zone->setDesignation('zone'.$i);
        $zone->setMajoration($majo);
        $zone->setNbPlace(1000);
        $zone->setStade($em->find(Stade::class, $j));
        $em->persist($zone);
        $majo+=(-5);
        }
        
        }
        $em->flush();
    }
    
    public function generateTarif($em){
        $tarif = new Tarif();
        $tarif->setPrix(35);
        $tarif->setdesignation("plein-tarif");
        $em->persist($tarif);
        $tarif = new Tarif();
        $tarif->setPrix(20);
        $tarif->setdesignation("etudiant");
        $em->persist($tarif);
        $tarif = new Tarif();
        $tarif->setPrix(12);
        $tarif->setdesignation("moins de 15ans");
        $em->persist($tarif);
        $em->flush();
    }
    
    public function generateBilleterie($em){
        $bill = new Billeterie();
        $bill->setPlaceRestantes(3000);
        $em->persist($bill);
        $em->flush();
    }
    
    public function generateAbonnement($em){
        $abo = new Abonnement();
        $abo->setMontant(250);
        $abo->setReduction(20);
        $abo->setDesignation("Abonnement qui vous confere 20% de réduction sur l'achat des places en plein tarif");
        $em->persist($abo);
        $em->flush();
    }
    
    public function generateClient($em){
        for($i = 1;$i <= 2000;$i++){
            $cli = new Client();
            $cli->setNom('client'.$i);
            if($i%8 == 0){
                    $cli->setAbonnement($em->find(Abonnement::class, 1));
            }
            $em->persist($cli);
        }
        $em->flush();
    }
    
    public function generateTicket(){
        for($i = 1;$i <= 2000;$i++){
            $tick = new Ticket();
            $tick->setTarif('client'.$i);
            if($i%8 == 0){
                    $cli->setAbonnement($em->find(Abonnement::class, 1));
            }
            $em->persist($cli);
        }
        $em->flush();
    }
    
    
    
    
    
    
    
    
    public function generateClub($em){
        $club = new Club();
        $club->setNom("Nimes");
        $club->setStade($em->find(Stade::class,1));
        $em->persist($club);
        $em->flush();
    }
    
    public function generateBilleadterie($em){
        $billeterie = new Billeterie();
        $billeterie->setBilletDispo(2900);
        $billeterie->setBilletVendu(1909);
        $billeterie->setStade($em->find(Stade::class,1));
        $em->persist($billeterie);
        $em->flush();
    }
    
    public function generateSupporter($em){
        for($i = 1; $i<5000; $i++){
            $supp = new Supporter();
            $supp->setNom("supp".$i);
            $supp->setPrenom("prenom".$i);
            $supp->setAge(random_int(5,100));
            $em->persist($supp);
        }
        $em->flush();
    }
    
    public function generateBillet($em){
        for($i = 0; $i< 1909; $i++){
            $bill = new Billet();
            $bill->setPrix(random_int(1000, 50000));
            $bill->setZoneStade($this->getZoneStade());
            $bill->setForfait(random_int(1,3));
            $bill->setBilleterie($em->find(Billeterie::class, 1));
            $bill->setSupporter($em->find(Supporter::class, random_int(1,4999)));
            $em->persist($bill);
        }
        $em->flush();
    }
    
    private function getZoneStade(){
        $retour = "";
       
        switch(random_int(1,5)):
            case '1':
                $retour = "prestige";
                break;
            case '2':
                $retour = "sympa";
                break;
            case '3':
                $retour = "medium";
                break;
            case '4':
                $retour = "default";
                break;
            case '5':
                $retour = "demerde";
                break;
        endswitch;
        return $retour;
    }
}
