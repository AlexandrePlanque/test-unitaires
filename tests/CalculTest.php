<?php

namespace App\Tests;

use App\Entity\Abonnement;
use App\Entity\Client;
use App\Entity\Tarif;
use App\Entity\Ticket;
use App\Entity\traitements\Calcul;
use App\Entity\Zone;
use DateTime;
use PHPUnit\Framework\TestCase;

class CalculTest extends TestCase
{   
    /**
     *
     * @var Calcul
     */
    public $calcul;
    
    /**
     *
     * @var Ticket
     */
    public $ticket;
    
    /**
     *
     * @var Client
     */
    public $client;
    
    /**
     * 
     * @var Zone
     */
    public $zone;
    
    /**
     * 
     * @var Tarif
     */
    public $tarif;
    
    /**
     *
     * @var Abonnement
     */
    public $abo;
    
    
    
    protected function setUp() {
        parent::setUp();
        
        $this->calcul = new Calcul();
        $this->client = new Client();
        $this->tarif = new Tarif();
        $this->zone = new Zone();
        $this->ticket = new Ticket();
        $this->calcul = new Calcul();
        $this->abo = new Abonnement();
        
        $this->client->setAge(new DateTime(date("Y:m:d H:i:s", mktime(0,0,0, date("m"),date("d"),date("Y")-20))));
        $this->client->setAbonnement($this->abo);
       
        $this->ticket->setClient($this->client);
        $this->ticket->setTarif($this->tarif);
        $this->ticket->setZone($this->zone);
        
    }

//    public function testSomething()
//    {
//        $this->assertTrue(true);
//    }
//    
    public function testsCalculPleinTarifSansAbo(){
        $this->tarif->setPrix(200);
        $this->zone->setMajoration(20);
        $test = $this->calcul->lambada($this->ticket);
//        $calcul->generate($this->ticket)
        $this->assertEquals(240, $this->ticket->getPrix());
    }
    
    public function testsCalculPleinTarifSansAboSansMajoration(){
        $this->tarif->setPrix(200);
        $this->zone->setMajoration(0);
        $test = $this->calcul->lambada($this->ticket);
//        $calcul->generate($this->ticket)
        $this->assertEquals(200, $this->ticket->getPrix());
    }
    
    public function testsCalculPleinTarifAvecAbo(){
        $this->tarif->setPrix(100);
        $this->zone->setMajoration(20);
        $this->abo->setReduction(20);
        $test = $this->calcul->lambada($this->ticket);
        $this->assertEquals(100, $this->ticket->getPrix());
        
    }
    
    public function testTarifEnfant(){
        $this->client->setAge(new DateTime(date("Y:m:d H:i:s", mktime(0,0,0, date("m"),date("d"),date("Y")-10))));
        $this->tarif->setPrix(100);
        $this->zone->setMajoration(20);
//        $this->abo->setReduction(20);
        $test = $this->calcul->lambada($this->ticket);
        $this->assertEquals(100, $this->ticket->getPrix());
    }
    
    public function testTarifEtudiant(){
        $this->tarif->setPrix(100);
        $this->zone->setMajoration(20);
        $this->client->setIsStudent(true);
        $test = $this->calcul->lambada($this->ticket);
        $this->assertEquals(100, $this->ticket->getPrix());
    }
}
