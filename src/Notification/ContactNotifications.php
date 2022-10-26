<?php
namespace App\Notification;

use App\Entity\Contact;
use Symfony\Component\Mailer\MailerInterface;
use Twig\Environment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;





class ContactNotifications{
     
    /**
     *  @var MailerInterface  
     */
    private $mailer;

    public function __construct(private EntityManagerInterface $entityManager,MailerInterface $mailer
)
    {
      $this->mailer= $mailer;   
    }

    public function notify(Contact $contact){
            $email = (new TemplatedEmail())
            ->from($contact->getEmail())
            ->to(new Address('admin@verifications.com', 'Security'))
            ->subject('Nous Contacter')
            ->htmlTemplate('emails/contact.html.twig')
            ->context(['contact'=>$contact])

           
        ;
      
        $this->mailer->send($email);

    }

     
         



    
}