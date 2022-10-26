<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\LogementRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;



class DefaultController extends AbstractController

{   

       public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }
    
    #[Route('/', name: 'app_default')]
    public function index(LogementRepository $logementRepository): Response
    {   
        if($this->getUser()){
         return new RedirectResponse($this->urlGenerator->generate('home'));

        }
        else{

          return $this->render('default/index.html.twig', [
            'app_name' => 'Villa Poitiers',
            'logements' => $logementRepository->findAll(),

            ]
            );

        }

        
           
      


        
      
        
        
    }
}
