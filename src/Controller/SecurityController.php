<?php

namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use App\Repository\LogementRepository;




class SecurityController extends AbstractController

{

    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }
    

     #[Route(path: '/home', name: 'home')]
     public function home(LogementRepository $logementRepository): Response
     {
          
        // return $this->render(('home/home.html.twig'));
        return $this->render('default/index.html.twig', [
            'app_name' => 'Villa Poitiers',
            'logements' => $logementRepository->findAll(),

            ]
            );
       

     }

    #[Route(path: '/loginAncien', name: 'app_login_ancien')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {   
         
        // rederiger vers la page home si il est connecté et ne plus avoir acces à la page login
        if($this->getUser()){
         return new RedirectResponse($this->urlGenerator->generate('home'));

        }
        
        else{
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
        }
    }

   
      
    #[Route(path: '/logout', name: 'app_logout')]

    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
