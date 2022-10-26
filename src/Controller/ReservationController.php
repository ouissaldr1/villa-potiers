<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ReservationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Reservation;
use App\Repository\ReservationRepository;


class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation', methods: ['GET', 'POST'])]
    public function reservation(Request $request,Reservation $reservation,ReservationRepository $reservationRepo ): Response
    {   
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);

         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
            $reservationRepo->add($reservation, true);

        }

        return $this->renderForm('reservation/index.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);

        // return $this->render('reservation/index.html.twig', [
        //     'controller_name' => 'ReservationController',
        // ]);
    }
}
