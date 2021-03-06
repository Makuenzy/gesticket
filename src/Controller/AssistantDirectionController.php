<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Session;
use App\Form\SessionType;
use App\Entity\Referentiel;
use App\Form\ReferentielType;
use App\Repository\UserRepository;
use App\Repository\SessionRepository;
use App\Repository\ReferentielRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AssistantDirectionController extends AbstractController
{
    /**
     * @Route("/ad/referentiel", name="ad.referentiel.liste")
     */
    public function listeReferentiel(ReferentielRepository $repo)
    
    {
        $referentiels=$repo->findAll();
        return $this->render('assistant_direction/referentiel/liste.html.twig', [
            'referentiels' => $referentiels,
        ]);
    }

    /**
     * @Route("/ad/referentiel/add", name="ad.referentiel.add")
     */
    public function addReferentiel(Request $request)
    { 
        $referentiel=new Referentiel();
        $form = $this->createForm(ReferentielType::class, $referentiel);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($referentiel);
            $entityManager->flush();

            return $this->redirectToRoute('ad.referentiel.liste');
        }

        return $this->render('assistant_direction/referentiel/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/ad/referentiel/edit/{id}", name="ad.referentiel.edit")
     */
    public function editReferentiel($id,Request $request, ReferentielRepository $repo)
    {
        
        $referentiel=$repo->find($id);
        $form = $this->createForm(ReferentielType::class, $referentiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($referentiel);
            $entityManager->flush();

            return $this->redirectToRoute('ad.referentiel.liste');
        }     
         
        return $this->render('assistant_direction/referentiel/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/ad/referentiel/delete/{id}", name="ad.referentiel.delete")
     */
    public function deleteReferentiel($id, ReferentielRepository $repo)
    {

        $referentiel=$repo->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($referentiel);
        $entityManager->flush();

        return $this->redirectToRoute('ad.referentiel.liste');
    }


//GESTION SESSION

 /**
     * @Route("/ad/session", name="ad.session.liste")
     */
    public function listeSession(SessionRepository $repo)
    
    {
        $sessions = $repo->findAll();

    
        return $this->render('assistant_direction/session/liste_session.html.twig', [
            'sessions' => $sessions,
        ]);
    }

/**
     * @Route("/ad/session/add", name="ad.session.add")
     */
    public function addSesion(Request $request)
    { 
        $session=new Session();
        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($session);
            $entityManager->flush();

            return $this->redirectToRoute('ad.session.liste');
        }

        return $this->render('assistant_direction/session/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

/**
     * @Route("/ad/session/edit/{id}", name="ad.session.edit")
     */
    public function editSession($id,Request $request, SessionRepository $repo)
    {
        
        $session=$repo->find($id);
        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($session);
            $entityManager->flush();

            return $this->redirectToRoute('ad.session.liste');
        }     
         
        return $this->render('assistant_direction/referentiel/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/ad/session/delete/{id}", name="ad.session.delete")
     */
    public function deleteSession($id, SessionRepository $repo)
    {

        $session=$repo->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($session);
        $entityManager->flush();

        return $this->redirectToRoute('ad.session.liste');
    }


//GESTION USER



/**
     * @Route("/ad/user", name="ad.user.liste")
     */
    public function listeUser(UserRepository $repo)
    {
          $users=$repo->findAll();
          
            return $this->render('assistant_direction/user/liste.html.twig', [
                    'users' =>$users,
                ]);
    }

    /**
     * @Route("/ad/user/add", name="ad.user.add")
     */
    
    public function addUser(Request $request,UserPasswordEncoderInterface $passwordEncoder)
    {
       

        $user= new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(['ROLE_ASSISTANT_DIRECTION']);
             $password = $passwordEncoder->encodePassword($user, $user->getPassword());
             $user->setPassword($password);
            $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($user);
            $entityManager->flush();
    
           return $this->redirectToRoute('ad.user.liste');
     }


        return $this->render('assistant_direction/user/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

/**
     * @Route("/ad/user/edit/{id}", name="ad.user.edit")
     */
    public function editUser($id,Request $request,UserRepository $repo)
    {
        $user=$repo->find($id);
        $form = $this->createForm(UserType::class,  $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($user);
            $entityManager->flush();
    
            return $this->redirectToRoute('ad.user.liste');
        }


        return $this->render('assistant_direction/user/form.html.twig', [
            'form' => $form->createView(),
        ]);
       
    }


    /**
     * @Route("/ad/user/delete/{id}", name="ad.user.delete")
     */
    public function deleteUser($id,UserRepository $repo)
    {
        $user=$repo->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();
        return $this->redirectToRoute('ad.user.liste');
    }

//FIN GESTION USER



}


