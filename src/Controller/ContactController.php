<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotifications;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController{
  

        #[Route('/contact', name: 'contact_Us')]
        public function contact(Request $request,ContactNotifications $notification): Response{

        $contact = new Contact();
        $formContact = $this->createForm(ContactType::class, $contact);
        $formContact->handleRequest(($request));

        if ($formContact->isSubmitted() && $formContact->isValid()){
          $notification->notify($contact);
        $this->addFlash('successContact','Votre email a bien été envoyé');
        //  return $this->redirectToRoute(('app_default'));
        }
        
        return $this->render('contactUs.html.twig',[
            'formContact'=> $formContact->createView(),
          ]);
        }
    
    
}
