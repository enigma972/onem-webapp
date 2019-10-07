<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\OffreRepository;
use App\Entity\Offre;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/offres/{page}/list", name="offres", defaults={"page": "1"})
     */
    public function offres(OffreRepository $offres, $page=1, $nombreParPage=15)
    {	
    	$offres = $offres->getAll($page, $nombreParPage);
    	return $this->render('home/offres.html.twig', [
            'offres'		=>	$offres,
            'page'			=>	$page,
            'nombreParPage'	=>	ceil(count($offres)/15)
        ]);
    }

    /**
     * @Route("/offres/{id}/voir", name="offre")
     */
    public function offre(Offre $offre)
    {   
        return $this->render('home/offre.html.twig', [
            'offre'        =>  $offre
        ]);
    }
}
