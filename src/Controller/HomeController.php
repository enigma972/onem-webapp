<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\OffreRepository;
use App\Repository\CommentRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function offre(Offre $offre, CommentRepository $commentRepos)
    {   
        $comments = $commentRepos->findAll();
        $form = $this->createForm(CommentType::class, new Comment());

        return $this->render('home/offre.html.twig', [
            'offre'   => $offre,
            'comments' => $comments,

            'form' => $form->createView(),
        ]);
    }
}
