<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class RegistrationController extends AbstractController


{    
   
    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }

    #[Route(path: '/home', name: 'home')]
     public function home(): Response
     {
        // return new Response('Vous êtes connecté 😊!!');

        return $this->render('home/home.html.twig');

     }

    #[Route('/loginRegister', name: 'app_register')]
    public function logRegister(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager,AuthenticationUtils $authenticationUtils): Response{
        
        
       

 
        // ajouter**********************
        // rederiger vers la page home si il est connecté et ne plus avoir acces à la page login
        if($this->getUser()){
         return new RedirectResponse($this->urlGenerator->generate('home'));
        }

          
         else{
        $user = new User();
        
        // get the login error if there is one
         $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('home');
        }
        // else{
        //     $this->addFlash('problemeRegister','xxxxxx');
        // }

        return $this->render('security/loginRegister.html.twig', [
            'registrationForm' => $form->createView(),
            'last_username' => $lastUsername, 'error' => $error
        ]);}



    }



// ***********************************

    #[Route('/register/login', name: 'app_login_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager,AuthenticationUtils $authenticationUtils, string $option = null): Response
    {      
                
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        } 
         else{
            
        // ====Register===
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        // ===login====
        // get the login error if there is one
         $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )

            );        

            
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('home');
        }
        else if($form->isSubmitted()){
            $option = "erreurs";
            
        }
       

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'option' => $option,
            'last_username' => $lastUsername, 'error' => $error
         
        ]);}


    }

    // ===============================================
    #[Route('/login', name: 'app_login')]
    public function loginTouria(AuthenticationUtils $authenticationUtils,string $option = null){
        $option = "";
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('registration/register.html.twig', [
            'option' => $option,
            'registrationForm' => $form->createView(),
            'last_username' => $lastUsername, 'error' => $error
         
        ]);}

    
        

        
    // ===============================================
     #[Route(path: '/logout', name: 'app_logout')]

    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}