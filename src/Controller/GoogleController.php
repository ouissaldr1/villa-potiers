<?php

# Controller/GoogleController
namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Symfony\Component\HttpFoundation\JsonResponse;



class GoogleController extends AbstractController
{  
    /**
     * Link to this controller to start the "connect" process
     *
     * @Route("/connect/google", name="connect_google")
     * @param ClientRegistry $clientRegistry
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function connectAction(ClientRegistry $clientRegistry)
    {
        return $clientRegistry
            ->getClient('google')
            ->redirect([],[]);
    }

    /**
     * Facebook redirects to back here afterward
     *
     * @Route("/connect/google/check", name="connect_google_check")
     * @param Request $request
     */
    public function connectCheckAction(Request $request)
    {
        // if (!$this->getUser()) {
        //     return new JsonResponse(array('status' => false, 'message' => "User not found!"));
        // } else {
        //     return $this->redirectToRoute('home');
        // }

    }

    

    // /**
    //  * After going to Google, you're redirected back here
    //  * because this is the "redirect_route" you configured
    //  * in config/packages/knpu_oauth2_client.yaml
    //  */
    // #[Route('/connect/google/check', name: 'connect_google_check')]
    // public function connectCheckAction(Request $request,ClientRegistry $clientRegistry)
    // {
    //     // ** if you want to *authenticate* the user, then
    //     // leave this method blank and create a Guard authenticator
    //       $client = $clientRegistry->getClient('google');

    //     try {
    //         // the exact class depends on which provider you're using
    //         $user = $client->fetchUser();

    //         // do something with all this new power!
    //         // e.g. $name = $user->getFirstName();
    //         var_dump($user); die;
    //         // ...
    //     } catch (IdentityProviderException $e) {
    //         // something went wrong!
    //         // probably you should return the reason to the user
    //         var_dump($e->getMessage()); die;
    //     }
    // }
}