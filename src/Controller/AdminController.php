<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\NewsRepository;
use Symfony\Component\HttpFoundation\JsonResponse;



use App\Entity\User;
use App\Form\UserType;
use App\Entity\Logement;
use App\Form\LogementType;

use App\Repository\UserRepository;
use App\Repository\LogementRepository;
use phpDocumentor\Reflection\Types\Integer;
use PhpParser\Node\Expr\Cast\String_;

#[Route('/admin/dashboard')]
class AdminController extends AbstractController{
       public function __construct(){
         
       }
    
       #[Route('/', name: 'admin_dashboard')]
        // checking admin rol
        // #[IsGranted('ROLE_ADMIN')]

        public function dashboard(): Response{

          return $this->render('admin/adminDashboard.html.twig');
        }




        #[Route('/new', name: 'admin_dashboardNew', methods: ['GET'])]
        #[IsGranted('ROLE_ADMIN')]
        public function dashboardNew(UserRepository $userRepository,LogementRepository $logementRepository,Request $request,NewsRepository $newsRepository,): Response{
                

          // ajouter un logement dans database
          $logement = new Logement();
          $form = $this->createForm(LogementType::class, $logement);


          $form->handleRequest($request);

          if ($form->isSubmitted() && $form->isValid()) {
              $logementRepository->add($logement, true);

              return $this->redirectToRoute('admin_dashboardNew', [], Response::HTTP_SEE_OTHER);
          }
           
         
          return $this->render('admin/adminDashboardNew.html.twig',[
            'users' => $userRepository->findAll(),
            'logements' => $logementRepository->findAll(),
            'news' => $newsRepository->findAll(),
            'form' => $form->createView(),
            'logement' => $logement,
            


          ]);

          
        }


      //  =======================================================
      #[Route('/edit/{id}/{type}/{prix}/{adresse}/{chambre}/{capacite}/{salleBain}/{jardin}', name: 'admin_dashboard_edit', methods: ['GET','POST'])]
      public function editAjax(Request $request,Logement $logement,string $type,string $prix,string $adresse,int $chambre,int $capacite,int $salleBain,bool $jardin,LogementRepository $logementRepository){
              
              $logement->setType($type);
              $logement->setPrix(floatval($prix));
              $logement->setAdresse($adresse);
              $logement->setChambre($chambre);
              $logement->setCapacite($capacite);
              $logement->setSalleBain($salleBain);
              $logement->setJardin($jardin);
               $logementRepository->add($logement, true);
               $rep = array();
               $rep['id'] = $logement->getId();
               $rep['type'] = $logement->getType();
               $rep['prix'] = $logement->getPrix();
               $rep['adresse'] = $logement->getAdresse();
               $rep['chambre'] = $logement->getChambre();
               $rep['capacite'] = $logement->getCapacite();
               $rep['salleBain'] = $logement->getSalleBain();
               $rep['jardin'] = $logement->isJardin();

               return new JsonResponse($rep);

             
           
      }

        // =========================================================

       #[Route('/editLogement/{id}/{type}/{prix}/{adresse}/{chambre}/{capacite}/{salleBain}/{jardin}', name: 'logement_edit', methods: ['GET','POST'])]

        public function editLogement(Request $request,Logement $logement, string $type,string $prix,string $adresse,int $chambre,int $capacite,int $salleBain,int $jardin,LogementRepository $logementRepository){
          $recu = array();
          $logement->setType($type);
          $logement->setPrix($prix);
          $logement->setAdresse($adresse);
          $logement->setChambre($chambre);
          $logement->setCapacite($capacite);
          $logement->setSalleBain($salleBain);
          $logement->setJardin($jardin);
          



          $logementRepository->add($logement, true);

          $recu['type'] = $logement->getType();
          $recu['prix'] = $logement->getPrix();
          $recu['adresse'] = $logement->getAdresse();
          $recu['chambre'] = $logement->getChambre();
          $recu['capacite'] = $logement->getCapacite();
          $recu['salleBain'] = $logement->getSalleBain();
          $recu['jardin'] = $logement->isJardin();


           return new JsonResponse($recu);


        }

        // =========================================================

       #[Route('/editUser/{id}', name: 'user_edit', methods: ['GET','POST'])]

        public function editUser(Request $request,User $user, UserRepository $userRepository){
          $recu['role'] = $request->getContent();
          if($recu['role'] == "Admin")
          { 
            $tab = array();
            $tab[] = 'ROLE_ADMIN';
            $user->setRoles($tab);
           $userRepository->add($user, true);
          }
          else{
            $tab = array();
            $tab[] = 'ROLE_USER';
            $user->setRoles($tab);
           $userRepository->add($user, true);
          }

          return new JsonResponse($recu);

          

        }
        // =========================================================
        #[Route('/deleteUser/{id}', name: 'user_delete', methods: ['GET','POST'])]
        
        public function delteUser(Request $request,User $user, UserRepository $userRepository){
          
          $userRepository->remove($user, true);
          $recu = array();
          $recu['essai'] = "utilisateur deleted";

          return new JsonResponse($recu);

          

        }
        // =========================================================
        // =========================================================
        #[Route('/deleteLogement/{id}', name: 'logement_delete', methods: ['GET','POST'])]
        
        public function deleteLogement(Logement $logement, LogementRepository $logementRepository){
          
          $logementRepository->remove($logement, true);
          $recu = array();
          $recu['essai'] = "Logement deleted";

          return new JsonResponse($recu);

          

        }
        // =========================================================
        

        #[Route('/{id}/edit', name: 'app_admin_logement_edit', methods: ['GET', 'POST'])]
    public function editAdmin(Request $request, Logement $logement, LogementRepository $logementRepository): Response
     {

        $form = $this->createForm(LogementType::class, $logement);

        $form->handleRequest($request);
        


        if ($form->isSubmitted() && $form->isValid()) {
            $logementRepository->add($logement, true);

            return $this->redirectToRoute('admin/adminDashboardNew.html.twig', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/adminDashboardNew.html.twig', [
            'logement' => $logement,
            'form' => $form,
            

        ]);
    }

       
}