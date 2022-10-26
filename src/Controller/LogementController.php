<?php

namespace App\Controller;
use App\Entity\Logement;
use App\Form\LogementType;
use App\Repository\DescriptionRepository;
use App\Repository\LogementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ReservationType;
use App\Entity\Reservation;
use App\Entity\User;

use App\Repository\ReservationRepository;

#[Route('/logement')]
class LogementController extends AbstractController

{

    
    #[Route('/', name: 'app_logement_list', methods: ['GET'])]
    public function index(LogementRepository $logementRepository): Response
    {
        // return $this->render('logement/index.html.twig', [
        //     'logements' => $logementRepository->findAll(),
            

        // ]);
        return $this->render('logement/list_logements.html.twig', [
            'logements' => $logementRepository->findAll(),
         

        ]);
    } 

    #[Route('details/{id<^[0-9]+$>}', name: 'app_logement_details', methods: ['GET'])]
    public function logementDetails(int $id,LogementRepository $logementRepository): Response
    {   $logement =  $logementRepository->findOneById($id);
        return $this->render('logement/logementDetails.html.twig', [
            'logement' => $logement,
        ]);
    }

    #[Route('/new', name: 'app_logement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LogementRepository $logementRepository): Response
    {
        $logement = new Logement();
        $form = $this->createForm(LogementType::class, $logement);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $logementRepository->add($logement, true);

            return $this->redirectToRoute('app_logement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('logement/new.html.twig', [
            'logement' => $logement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_logement_show', methods: ['GET'])]
    public function show(Logement $logement): Response
    {
        return $this->render('logement/show.html.twig', [
            'logement' => $logement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_logement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Logement $logement, LogementRepository $logementRepository,DescriptionRepository $descriptionRepository): Response
     {

        $form = $this->createForm(LogementType::class, $logement);

        $form->handleRequest($request);
        


        if ($form->isSubmitted() && $form->isValid()) {
            $logementRepository->add($logement, true);

            return $this->redirectToRoute('app_logement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('logement/edit.html.twig', [
            'logement' => $logement,
            'form' => $form,
            

        ]);
    }

    #[Route('/{id}', name: 'app_logement_delete', methods: ['POST'])]
    public function delete(Request $request, Logement $logement, LogementRepository $logementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$logement->getId(), $request->request->get('_token'))) {
            $logementRepository->remove($logement, true);
        }

        return $this->redirectToRoute('app_logement_index', [], Response::HTTP_SEE_OTHER);
    }

      
    #[Route('details/{id<^[0-9]+$>}/reserver', name: 'app_etape_reservation', methods: ['GET'])]

    public function etapeReservation(int $id,Request $request,LogementRepository $logementRepository,ReservationRepository $reservationRepo ) : Response{
       $logement =  $logementRepository->findOneById($id);
       $user = new User();
       $user->setEmail('kk@gmail.com');
       $user->setUsername('kkkkkk');
       $user->setPassword('123456');

       $reservation = new Reservation();
       $reservation->setIdLogement($logement);
       $reservation->setIdUser($user);


        $form = $this->createForm(ReservationType::class, $reservation);

         $form->handleRequest($request);
          
         if ($form->isSubmitted() && $form->isValid()) {
            
            $reservation->setDateDebut($form->get('arrive')->getData());
            $reservation->setDateFin($form->get('arrive')->getData());
            $reservationRepo->add($reservation, true);

        }

        return $this->render('logement/etapeReservation.html.twig',[
            "logement"=>$logement, 
            'reservation' => $reservation,
            'form' =>  $form->createView(),
        ]);

    }

}
