<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\AuthenticationProviderManager;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class DefaultController extends AbstractController
{

    /**
     * @Route("/home", name="homepage")
     */
    public function homeAction()
    {
        return new Response('Un hibou est dans la place');
    }

    public function contact(Request $request)
    {
        $locale = $request->getLocale();
        return new Response($locale);
    }

    public function index()
    {
        // usually you'll want to make sure the user is authenticated first
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user in not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        // Call whatever methods you've added to your User class
        // For example, if you added a getFirstName() method, you can use that
        return new Response('Well hi there '.$user->getUsername());
    }

    public function authenticate()
    {
        // instances of Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface
        $providers = ['....'];

        $authenticationManager = new AuthenticationProviderManager($providers);

        try {
            $authenticatedToken = $authenticationManager->authenticate($unauthenticatedToken);
        } catch (AuthenticationException $exception){
            // authentication failed
        }
    }
}